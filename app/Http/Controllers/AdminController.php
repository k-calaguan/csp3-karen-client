<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Session;

class AdminController extends Controller
{
	public function dashboard() {
		return view('admin.dashboard');
	}

	/*-------------------- CARS --------------------*/
	public function car_index() {
		$uri = config('constants.baseURI');

		$client = new Client(["base_uri" => "$uri"]);

		$response = $client->request("GET", "/admin/cars", [
			"headers" => [
				"Authorization" => Session::get("token")
			]
		]);

		$result = json_decode($response->getBody());

		Session::put("cars", $result);

		return view('admin.cars.index');
	}

	public function car_showForm() {
		return view('admin.cars.create');
	}

	public function car_store(Request $request) {
		$uri = config('constants.baseURI');

		$validator = Validator::make($request->all(), [
			'brandMod' => 'required|string',
			'plateNum' => 'required|string',
			'price' => 'required|numeric',
			'modYear' => 'required|string',
			'bodyType' => 'required|string',
			'transmission' => 'required|string',
			'fuelType' => 'required|string',
			'engine' => 'required|numeric',
			'seats' => 'required|numeric',
			'isActive' => 'required|string',
			'image' => 'required|file'
		]);
		
		if($validator->fails()) {
			$errors = $validator->errors();

			dd($errors);
			Session::flash("errors", $errors);
			return redirect('/admin/cars/create');
		}

		if($request->isActive == "Active") {
			$isActive = true;
		} else {
			$isActive = false;
		}

		$request->image->move(public_path('/img'), str_replace(' ', '_', $request->image->getClientOriginalName()));
		$image = '/img/'.str_replace(' ', '_', $request->image->getClientOriginalName());

		$client = new Client(['base_uri' => "$uri"]);

		$response = $client->request('post', '/admin/cars', [
			"http_errors" => false,
			"headers" => [
				"Authorization" => Session::get("token")
			],
			"json" => [
				"brandMod" => $request->brandMod,
				"plateNum" => $request->plateNum,
				"price" => $request->price,
				"modYear" => $request->modYear,
				"bodyType" => $request->bodyType,
				"transmission" => $request->transmission,
				"fuelType" => $request->fuelType,
				"engine" => $request->engine,
				"seats" => $request->seats,
				"isActive" => $isActive,
				"image" => $image
			]
		]);

		$result = json_decode($response->getBody());

		Session::flash("message", "Successfully added ".$request->brandMod);
		Session::flash("type", "success");
		return redirect('/admin/cars/create');
	}

	public function car_update(Request $request, $id) {
		$uri = config('constants.baseURI');

		$validator = Validator::make($request->all(), [
			'brandMod' => 'required|string',
			'plateNum' => 'required|string',
			'price' => 'required|numeric',
			'modYear' => 'required|string',
			'bodyType' => 'required|string',
			'transmission' => 'required|string',
			'fuelType' => 'required|string',
			'engine' => 'required|numeric',
			'seats' => 'required|numeric',
			'isActive' => 'required|string'
		]);
		
		if($validator->fails()) {
			$errors = $validator->errors();

			Session::flash("errors", $errors);
			return redirect('/admin/cars/create');
		}

		if($request->isActive == "true") {
			$isActive = true;
		} else {
			$isActive = false;
		}
		
		$client = new Client(['base_uri' => "$uri"]);
		
		$carRes = $client->request("GET", "/admin/cars", [
			"headers" => [
				"Authorization" => Session::get("token")
			]
		]);

		$cars = json_decode($carRes->getBody());

		foreach($cars as $car) {
			if($car->_id == $id) {
				$image = $car->image;
			}
		}

		if($request->image != null) {
			$request->image->move(public_path('/img'), str_replace(' ', '_', $request->image->getClientOriginalName()));
			$image = '/img/'.str_replace(' ', '_', $request->image->getClientOriginalName());
		} 

		$response = $client->request('put', '/admin/cars/'.$id, [
			"http_errors" => false,
			"headers" => [
				"Authorization" => Session::get("token")
			],
			"json" => [
				"brandMod" => $request->brandMod,
				"plateNum" => $request->plateNum,
				"price" => $request->price,
				"modYear" => $request->modYear,
				"bodyType" => $request->bodyType,
				"transmission" => $request->transmission,
				"fuelType" => $request->fuelType,
				"engine" => $request->engine,
				"seats" => $request->seats,
				"isActive" => $request->isActive,
				"image" => $image
			]
		]);

		$result = json_decode($response->getBody());

		Session::flash("message", "Successfully updated " . $request->brandMod. " - " .$request->plateNum);
		Session::flash("type", "success");
		return redirect('/admin/cars');
	}



	/*-------------------- USERS --------------------*/
	public function user_index() {
		$uri = config('constants.baseURI');

		$client = new Client(["base_uri" => "$uri"]);

		$response = $client->request("GET", "/admin/users", [
			"headers" => [
				"Authorization" => Session::get("token")
			]
		]);

		$result = json_decode($response->getBody());

		Session::put("users", $result);

		return view('admin.users.index');
	}



	/*-------------------- TRANSACTIONS -------------------- */
	public function trans_index() {
		$uri = config('constants.baseURI');

		$client = new Client(["base_uri" => "$uri"]);

		$response = $client->request("GET", "/admin/bookings", [
			"headers" => [
				"Authorization" => Session::get("token")
			]
		]);

		$result = json_decode($response->getBody());

		Session::put("results", $result);

		return view('admin.transactions.index');
	}
	
}
