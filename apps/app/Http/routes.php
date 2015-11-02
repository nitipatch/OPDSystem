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


Route::controller('login/loginframe','Admins\LoginController'); 
// Start Online Page
Route::group(['prefix'=>'login','middleware'=>'auth','namespace'=>'Admins'],function(){
	Route::get('patient','LoginController@patient');
	Route::get('doctor','LoginController@doctor');
	Route::get('nurse','LoginController@nurse');
});


Route::get('doctor/logout','Admins\LoginController@getLogout');
Route::group(['prefix'=>'doctor','middleware'=>'auth','namespace'=>'doctor'],function(){
	Route::get('loginsuccess', function(){return view('doctor.success');});
	Route::get('prescribe', 'PrescribeController@prescribeForm');
	Route::get('addMedicalRecord', 'MedicalRecordController@addMedicalRecordForm');
});


Route::get('nurse/logout','Admins\LoginController@getLogout');
Route::group(['prefix'=>'nurse','middleware'=>'auth','namespace'=>'nurse'],function(){
	Route::get('loginsuccess', function(){return view('nurse.success');});
	Route::get('addScreeningRecord', 'AddScreeningRecordController@addScreeningRecordForm');
});


Route::get('patient/logout','Admins\LoginController@getLogout');
Route::group(['prefix'=>'patient','middleware'=>'auth','namespace'=>'patient'],function(){
	Route::get('loginsuccess', function(){return view('patient.success');});
	Route::get('make-appointment', 'MakeAppointmentController@makeAppointmentForm');
});