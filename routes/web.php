<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', function () {
    return view('landingPage');
});

Route::get('/register', 'AuthController@regForm');
Route::post('/register', 'AuthController@regUser');
Route::get('/login', 'AuthController@loginForm');
Route::post('/login', 'AuthController@loginUser');
Route::get('/logout', 'AuthController@logout');

/* Admin */
Route::get('/admin/dashboard', 'AdminController@dashboard');
Route::get('/admin/cars', 'AdminController@car_index');
Route::get('/admin/cars/create', 'AdminController@car_showForm');
Route::post('/admin/cars/', 'AdminController@car_store');
Route::put('/admin/cars/{id}', 'AdminController@car_update');

Route::get('/admin/users', 'AdminController@user_index');
Route::get('/admin/transactions', 'AdminController@trans_index');

/* User */
Route::get('/cars', 'UserController@cars');
Route::get('/bookings', 'UserController@showBookingForm');
Route::get('/transactions', 'UserController@trans_index');

/* Stripe */
Route::post('charge', 'StripeController@charge');