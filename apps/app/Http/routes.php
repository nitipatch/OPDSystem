<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', 'Admins\LoginController@getIndexSlash');
Route::get('login', 'Admins\LoginController@getIndexSlash');

Route::get('login/register','Admins\RegisterController@registerForm');
Route::post('login/register/create', 'Admins\RegisterController@registerCreate');

Route::get('patient/loginsuccess', function(){return view('patient.success');});
Route::get('patient/logout','Admins\LoginController@getLogout');
Route::get('patient/make-appointment', 'patient\MakeAppointmentController@makeAppointmentForm');
Route::get('prescribe', 'doctor\PrescribeController@PrescribeForm');


Route::controller('login/loginframe','Admins\LoginController'); 
// Start Online Page
Route::group(['prefix'=>'login','middleware'=>'auth','namespace'=>'Admins'],function(){
	Route::get('index','LoginController@success');
});

