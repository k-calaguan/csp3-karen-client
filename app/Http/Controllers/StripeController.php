<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;

class StripeController extends Controller
{
	public function charge(Request $request) {
		// dd($request->all());

		try {
			Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

			$customer = Customer::create(array(
				'email' => $request->stripeEmail,
				'source' => $request->stripeToken
			));

			$charge = Charge::create(array(
				'customer' => $customer->id,
				'amount' => Session('totalCharge'),
				'currency' => 'php'
			));

			Session::flash("message", "Charge successful!");
			return redirect('/cars');

		} catch(\Exception $ex) {
			Session::flash("error", $ex->getMessage());
			return redirect('/bookings');
		}
	}
}
