<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Support\MessageBag;
use Session;

class AuthController extends Controller
{
	public function regForm() {
		return view('auth.register.form');
	}

	public function regUser(Request $request) {
		$uri = config('constants.baseURI');

		$validator = Validator::make($request->all(), [
			'name' => 'required|string|max:255',
			'email' => 'required|email|max:255',
			'password' => 'required|min:8|confirmed',
			'dob' => 'required|date',
			'gender' => 'required|string|max:255',
			'contactNum' => 'required|numeric|min:11',
			'homeAddress' => 'required|string|max:255'
		]);

		if($validator->fails()) {
			$error = $validator->errors()->first();

			// dd($error);
			Session::flash("error", $error);
			return view('auth.register.form');
		}

		try {
			$client = new Client(['base_uri' => "$uri"]);

			$response = $client->request('post', '/register', [
				"json" => [
					"name" => $request->name,
					"email" => $request->email,
					"password" => $request->password,
					"dob" => $request->dob,
					"gender" => $request->gender,
					"contactNum" => $request->contactNum,
					"homeAddress" => $request->homeAddress
				]
			]);
			
			$result = json_decode($response->getBody());
		} catch(BadResponseException $e) {
			// dd($e->getRequest());
		    if ($e->hasResponse()) {
		    	$e = json_decode($e->getResponse()->getBody()->getContents(), true);
		    	// dd($e['error']);
		        Session::flash("error", $e['error']);
				return redirect('/register');
		    }
		}

		Session::flash("message", "You have successfully registered.");
		return redirect('/login');
	}

	public function loginForm() {
		return view('auth.login.form');
	}

	public function loginUser(Request $request) {
		$uri = config('constants.baseURI');

		try {
			$client = new Client(['base_uri' => "$uri"]);

			$response = $client->request('post', '/auth/login', [
				"json" => [
					"email" => $request->email,
					"password" => $request->password
				]
			]);

			$result = json_decode($response->getBody());
			Session::put("user", $result->data->user);
			Session::put("token", "Bearer ".$result->data->token);

			if($result->data->user->isAdmin == true) {
				Session::flash("message", "Welcome back ".$result->data->user->name);
				return redirect('/admin/cars');
			} else {
				Session::flash("message", "Welcome back ".$result->data->user->name);
				return redirect('/cars');
			}
		} catch(BadResponseException $e) {
			// dd($e->getRequest());
		    if ($e->hasResponse()) {
		    	// dd($e);
		    	$e = json_decode($e->getResponse()->getBody()->getContents(), true);
		    	// dd($e['error']);
		        Session::flash("error", $e['error']);
				return redirect('/login');
		    }
		}
	}

	public function logout() {
		Session::flush();
		Session::flash("message", "You have successfully logged out.");
		return redirect('login');
	}
}
