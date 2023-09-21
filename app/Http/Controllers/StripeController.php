<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\StripeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * checkout, success, cancel, webhook
 */
class StripeController extends Controller
{
    /**
     * checkout
     * 
     * Returns checkout link
     */
    public function checkout(Request $request) : string
    {
        return redirect((new StripeService())->getCheckoutLink(auth()->user(), $request->product));
    }

    /**
     * success
     */
    public function success(Request $request) : RedirectResponse
    {
        // reveal request() data
        $user_id = request()->input('user_id');
        $product_id = request()->input('product_id');
        $session_token = request()->input('session_token');

        // Get user
        $user = User::find($user_id);

        // Check session_token is valid
        if ($user->payment_session_token != $session_token) {
            // something went wrong
            return redirect(route('stripe.cancel'));
        }

        $user->update([
            'role' => $product_id,
            'payment_session_token' => null,
        ]);

        return redirect(
            route('dashboard', ['checkout_success' => 1])
        );
    }

    /**
     * cancel
     */
    public function cancel() : RedirectResponse
    {
        return redirect(
            route('dashboard', ['checkout_failed' => 1])
        );
    }

    /**
     * webhook
     */
    public function webhook(Request $request) : void
    {
        // send email
        // last 4 digits
        // save to payments table
    }
}
