<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * StripeService class.
 * 
 * Implements use-cases for system Stripe API usage.
 */

class StripeService
{
    protected $stripe;
    protected $products;

    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(config('stripe.credentials.secret'));
        $this->products = config('stripe.products');
    }

    /**
     * Generate checkout link for [user, product] pair.
     * 
     * @param User $user
     * @param string $product_id
     * 
     * @return string
     */
    public function getCheckoutLink(User $user, string $product_id) : string
    {
        $user_id = $user->id;
        $product = $this->products[$product_id];
        $session_token = Hash::make($user_id . $product_id . time());

        // save session_token
        $user->update(['payment_session_token' => $session_token]);

        // buy product
        $session = $this->stripe->checkout->sessions->create([
            'mode' => 'payment',

            'line_items' => [[
                'price' => $product['price_id'],
                'quantity' => 1,
            ]],

            'customer' => $user->stripe_id,
            // 'customer_email' => $user->email,

            'locale' => 'en',

            'payment_method_types' => ['card', /* other payment methods */],

            // callback
            'success_url' => route('stripe.success') . '?product_id=' . $product_id . '&user_id=' . $user_id . '&payment_session_token=' . $session_token,
            'cancel_url' => route('stripe.cancel'),
        ]);

        // Return link
        return $session->url;
    }

    /**
     * Reveal all purchases from stripe by user.
     */
    public function getPayments(User $user)
    {
        // get last 4 digits of card
        $charges = $this->stripe->charges->all(['customer' => $user->stripe_id]);

        // return receipt_urls
        return collect($charges->data)->map(function ($charge) {
            return collect($charge)->only('receipt_url', 'id');
        })->toArray();
    }
}