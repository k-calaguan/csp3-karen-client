<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Session;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
	public function dashboard() {
		return view('user.dashboard');
	}

	public function cars() {
		// $client = new Client(["base_uri" => "http://localhost:3000"]);
		$client = new Client(['base_uri' => "https://csp3-karen-api.herokuapp.com/"]);

		$response = $client->request("GET", "/cars", [
			"headers" => [
				"Authorization" => Session::get("token")
			]
		]);

		$result = json_decode($response->getBody());

		Session::put("cars", $result);

		return view('user.cars');
	}


	public function showBookingForm(Request $request) {
		$validator = Validator::make($request->all(), [
			'startDate' => 'required|date',
			'endDate' => 'required|date'
		]);

		if($validator->fails()) {
			$errors = $validator->errors();
			
			Session::flash("errors", $errors);
			return redirect('/cars');
		}

		// $client = new Client(["base_uri" => "http://localhost:3000"]);
		$client = new Client(['base_uri' => "https://csp3-karen-api.herokuapp.com/"]);

		$response = $client->request("GET", "/cars/".$request->carId, [
			"headers" => [
				"Authorization" => Session::get("token")
			]
		]);

		$car = json_decode($response->getBody());

		$startDate = Carbon::parse($request->startDate);
		$endDate = Carbon::parse($request->endtDate);
		$diffInDays = $startDate->diffInDays($endDate);
		$totalCharge = $car->data->price * $diffInDays;

		Session::put('startDate', $request->startDate);
		Session::put('endDate', $request->endDate);
		Session::put('carId', $request->carId);
		Session::put('carName', $car->data->brandMod);
		Session::put('carImage', $car->data->image);
		Session::put('bookedDays', $diffInDays);
		Session::put('totalCharge', $totalCharge);

		return view('user.bookingForm');
	}

	public function trans_index() {
		// $client = new Client(["base_uri" => "http://localhost:3000"]);
		$client = new Client(['base_uri' => "https://csp3-karen-api.herokuapp.com/"]);

		$response = $client->request("GET", "/bookings", [
			"headers" => [
				"Authorization" => Session::get("token")
			]
		]);

		$result = json_decode($response->getBody());

		Session::put("trans", $result);

		return view('user.transactions');	
	}
}
