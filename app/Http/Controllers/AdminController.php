<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\StripeService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Construct : middleware (check role admin)
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function checkLastPayment(Request $request)
    {
        $user = User::find($request->user_id);
        $data = (new StripeService())->getPayments($user);

        $last_payment = $data[0];

        return redirect()->away($last_payment['receipt_url']);
    }
}
