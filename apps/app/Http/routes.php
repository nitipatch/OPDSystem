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

Route::get('login/registerPatient','patient\RegisterController@registerForm');
Route::post('login/registerPatient/create', 'patient\RegisterController@registerCreate');
Route::get('appointment', 'patient\AppointmentController@appointmentForm');

Route::controller('login/loginframe','Admins\LoginController'); 
// Start Online Page
Route::group(['prefix'=>'login','middleware'=>'auth','namespace'=>'Admins'],function(){
	Route::get('index','LoginController@success');
	Route::get('logout','LoginController@getLogout');
});
