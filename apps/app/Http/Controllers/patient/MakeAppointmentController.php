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
			,array('cause'=>'required|max:1000'
			,'doctor'=>'required_without:department'
			,'department'=>'required_without:doctor'
			,'apptDate'=>'required'
			,'morning'=>'required')
			
			,array('cause.required'=>'กรุณากรอกสาเหตุหรืออาการ'
			,'cause.max'=>'สาเหตุหรืออาการยาวเกินไป'
			,'doctor.required_without'=>'กรุณาเลือกแพทย์หรือแผนกที่ต้องการนัด'
			,'department.required_without'=>'กรุณาเลือกแพทย์หรือแผนกที่ต้องการนัด'
			,'apptDate.required'=>'กรุณาเลือกวันนัด'
			,'morning.required'=>'กรุณาเลือกช่วงเวลานัด')
		);
		if ($validator->passes()) 
		{ 
			if(empty(Input::get('doctor')))
			{$depentOnDr=1; $doctor = DB::table('users')->where('name',Input::get('doctor'))->first();}
			//else if(!empty(Input::get('department')))
			else
			{$depentOnDr=0; $doctor = DB::table('users')->where('department',Input::get('department'))->first();}

			$addAppointment = new Appointment();
			$addAppointment->HN = Session::get('username');
			$addAppointment->doctorEmpID = $doctor->username;
			$addAppointment->appointmentDate = Input::get('apptDate');
			$addAppointment->morning = Input::get('morning');
			$addAppointment->symptomOrReason = Input::get('cause');
			$addAppointment->dependOnDr = $depentOnDr;
			$addAppointment->save();
			return Redirect::to('patient/makeAppointment')->with('flash_notice','ดำเนินการสำเร็จ');
		}
		else{return Redirect::to('patient/makeAppointment')->withErrors($validator)->withInput();}
	}
}
			
?>