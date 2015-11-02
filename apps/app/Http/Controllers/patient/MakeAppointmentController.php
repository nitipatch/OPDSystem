<?php

namespace App\Http\Controllers\patient;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\App\patient;
use View;

class MakeAppointmentController extends BaseController
{
	public function makeAppointmentForm()
	{
		return View::make('patient.makeAppt');
	}
}

?>