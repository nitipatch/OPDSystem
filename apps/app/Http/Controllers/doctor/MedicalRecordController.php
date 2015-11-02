<?php

namespace App\Http\Controllers\doctor;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\App\doctor;
use View;

class MedicalRecordController extends BaseController
{
	public function addMedicalRecordForm()
	{
		return View::make('doctor.addMedicalRecord');
	}
}

?>