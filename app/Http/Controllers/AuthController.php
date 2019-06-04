<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\MessageBag;
use Session;

class AuthController extends Controller
{
	public function regForm() {
		return view('auth.register.form');
	}

	public function regUser(Request $request) {
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
			$errors = $validator->errors();

			dd($errors);
			return redirect('/register')
				->withErrors($errors);
		}

		// $client = new Client(['base_uri' => "http://localhost:3000"]);
		$client = new Client(['base_uri' => "https://csp3-karen-api.herokuapp.com/"]);

		$response = $client->request('post', '/register', [
			"http_errors" => false,
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

		Session::flash("message", "You have successfully registered.");
		Session::flash("alert-type", "success");

		return redirect('/login');
	}

	public function loginForm() {
		return view('auth.login.form');
	}

	public function loginUser(Request $request) {
		// $client = new Client(['base_uri' => "http://localhost:3000"]);
		$client = new Client(['base_uri' => "https://csp3-karen-api.herokuapp.com/"]);

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
			Session::flash("message", "Welcome back ");
			return redirect('/admin/dashboard');
		} else {
			Session::flash("message", "Welcome back ");
			return redirect('/dashboard');
		}
	}

	public function logout() {
		Session::flush();
		Session::flash("message", "You have successfully logged out.");
		return redirect('login');
	}
}
