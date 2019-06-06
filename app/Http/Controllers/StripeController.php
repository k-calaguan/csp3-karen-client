<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Session;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use GuzzleHttp\Exception\BadResponseException;

class StripeController extends Controller
{
	public function charge(Request $request) {
		$uri = config('constants.baseURI');
		// dd($request->all());
		// dd(Session('booking'));

		$stripeToken = $request->stripeToken;
		$stripeTokenType = $request->stripeTokenType;
		$stripeEmail = $request->stripeEmail;

		$carId = Session('booking')['carId'];
		$startDate = Session('booking')['startDate'];
		$endDate = Session('booking')['endDate'];
		$bookedDays = Session('booking')['bookedDays'];
		$excessHours = Session('booking')['excessHours'];
		$excessHoursPrice = Session('booking')['excessHoursPrice'];
		$totalCharge = Session('booking')['totalCharge'];

		try {
			$client = new Client(['base_uri' => "$uri"]);

			$response = $client->request('post', '/bookings', [
				"headers" => [
					"Authorization" => Session::get("token")
				],
				"json" => [
					"carId" => $carId,
					"startDate" => $startDate,
					"endDate" => $endDate,
					"rentedDays" => $bookedDays,
					"excessHours" => $excessHours,
					"stripeToken" => $stripeToken,
					"stripeTokenType" => $stripeTokenType,
					"stripeEmail" => $stripeEmail,
					"source" => $stripeTokenType
				]
			]);

			$result = json_decode($response->getBody());

			// dd($response);
			// dd($result);
			Session::flash("message", "Payment successful. Visit Transactions page for details.");
			return redirect('/cars');

		} catch(BadResponseException $e) {
			if ($e->hasResponse()) {
				$e = json_decode($e->getResponse()->getBody()->getContents(), true);
				// dd($e['error']);
				Session::flash("error", $e['error']);
				return view('user.transactions');
			}
		}
	}

	public function refund(Request $request, $id) {
		$uri = config('constants.baseURI');
		// dd($id);
		try {
			// $client = new Client(["base_uri" => "http://localhost:3000"]);
			$client = new Client(['base_uri' => "$uri"]);

			$response = $client->request('delete', '/bookings/'.$id, [
				"headers" => [
					"Authorization" => Session::get("token")
				]
			]);	

			$result = json_decode($response->getBody());

			// dd($result);
			Session::flash("message", "Succesffully refunded " . $id);
			return redirect('/Transactions');
		} catch(BadResponseException $e) {
			if ($e->hasResponse()) {
				$e = json_decode($e->getResponse()->getBody()->getContents(), true);
				// dd($e['error']);
				Session::flash("error", $e['error']);
				return redirect('/cars');
			}
		}
	}
}
