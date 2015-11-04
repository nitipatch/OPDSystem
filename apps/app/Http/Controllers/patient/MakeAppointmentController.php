<?php

namespace App\Http\Controllers\patient;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Appointment;
use View;

class MakeAppointmentController extends BaseController
{
	public function makeAppointmentForm()
	{
		return View::make('patient.makeAppointment');
	}
	public function makeAppointmentCreate()
	{
		$validator = Validator::make(Input::all()
			,array('cause'=>'max:1000'
			,'doctor'=>'required'
			,'apptDate'=>'required'
			,'morning'=>'required')
			
			,array('cause.max'=>'สาเหตุหรืออาการยาวเกินไป'
			,'doctor.required'=>'กรุณาเลือกแพทย์ที่ต้องการนัด'
			,'apptDate.required'=>'กรุณาเลือกวันนัด'
			,'morning.required'=>'กรุณาเลือกช่วงเวลานัด')
		);
		if ($validator->passes()) 
		{ 
			$user = DB::table('users')->where('name',Input::get('doctor'))->first();

			$addAppointment = new Appointment();
			$addAppointment->HN = Session::get('username');
			$addAppointment->doctorEmpID = $user->username;
			$addAppointment->appointmentDate = Input::get('apptDate');
			$addAppointment->morning = Input::get('morning');
			$addAppointment->symptomOrReason = Input::get('cause');
			$addAppointment->dependOnDr = isset($user);
			$addAppointment->save();
			return Redirect::to('patient/makeAppointment')->with('flash_notice','ดำเนินการสำเร็จ');
		}
		else{return Redirect::to('patient/makeAppointment')->withErrors($validator)->withInput();}
	}
}
			
?>