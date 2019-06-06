<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Session;
use Illuminate\Support\Carbon;
use GuzzleHttp\Exception\BadResponseException;

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
		// dd($request);
		$validator = Validator::make($request->all(), [
			'startDate' => 'required|date',
			'endDate' => 'required|date'
		]);

		if($validator->fails()) {
			$errors = $validator->errors();
			
			Session::flash("errors", $errors);
			return redirect('/cars');
		}

		$startDate = new Carbon($request->startDate);
		$endDate = new Carbon($request->endDate);
		$diffInDays = ($endDate->diffInDays($startDate));
		$excessHours =($endDate->diffInHours($startDate)) % 24;
		// dd($startDate->toDateTimeString());
		// dd($diffInDays);

		try {
			// $client = new Client(["base_uri" => "http://localhost:3000"]);
			$client = new Client(['base_uri' => "https://csp3-karen-api.herokuapp.com/"]);

			$response = $client->request("GET", "/cars/".$request->carId, [
				"headers" => [
					"Authorization" => Session::get("token")
				]
			]);

			$car = json_decode($response->getBody())->data;

			/* counter for excess hours currently 0 */
			$excessHoursPrice = 0;

			if($excessHours >= 12) {
				$diffInDays += 1;
			} elseif($excessHours < 12 && $excessHours > 0) {
				$hourlyRate = ($car->price) / 24;
				$excessHoursPrice = $excessHours * $hourlyRate;
			}

			$totalCharge = (($car->price) * $diffInDays) + $excessHoursPrice;
			// dd($totalCharge);
			Session::pull('booking');

			Session::put('booking', [
				'startDate' => $startDate,
				'endDate' => $endDate,
				'carId' => $request->carId,
				'carName' => $car->brandMod,
				'carImage' => $car->image,
				'carPrice' => $car->price,
				'bookedDays' => $endDate->diffInDays($startDate),
				'excessHours' => $excessHours,
				'excessHoursPrice' => $excessHoursPrice,
				'totalCharge'=> $totalCharge
			]);

			return view('user.bookingForm');
		} catch(BadResponseException $e) {
			// dd($e->getRequest());
		    if ($e->hasResponse()) {
		    	$e = json_decode($e->getResponse()->getBody()->getContents(), true);
		    	// dd($e['error']);
		        Session::flash("error", $e['error']);
				return redirect('/cars');
		    }
		}
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
