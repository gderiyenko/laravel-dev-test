<?php

/**
 * Stripe service class.
 * 
 * Implements the Stripe API.
 */

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\User;

class StripeService
{
    protected $key;
    protected $plans;

    public function __construct()
    {
        $this->key = config('stripe.secret');
        $this->key = config('stripe.plans');
    }

    /**
     * Redirect user to Stripe checkout page.
     * 
     */
    public function checkout(User $user, string $plan)
    {
        
    }

}