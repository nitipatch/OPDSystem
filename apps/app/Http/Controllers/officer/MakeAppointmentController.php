<?php

namespace App\Http\Controllers\officer;
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
		return View::make('officer.makeAppointment');
	}
	public function makeAppointmentCreate()
	{
		$validator = Validator::make(Input::all()
			,array('HN'=>'required|min:8|max:8'
			,'cause'=>'required|max:1000'
			,'doctor'=>'required_without:department'
			,'department'=>'required_without:doctor'
			,'apptDate'=>'required'
			,'morning'=>'required')
			
			,array('HN'=>'กรุณากรอกHNของผู้ปว่ย'
			,'HN.min'=>'กรอกHNของผู้ป่วยไม่ครบ'
			,'HN.max'=>'กรอกHNของผู้ป่วยเกิน'
			,'cause.required'=>'กรุณากรอกสาเหตุหรืออาการ'
			,'cause.max'=>'สาเหตุหรืออาการยาวเกินไป'
			,'doctor.required_without'=>'กรุณาเลือกแพทย์หรือแผนกที่ต้องการนัด'
			,'department.required_without'=>'กรุณาเลือกแพทย์หรือแผนกที่ต้องการนัด'
			,'apptDate.required'=>'กรุณาเลือกวันนัด'
			,'morning.required'=>'กรุณาเลือกช่วงเวลานัด')
		);

		if ($validator->passes()) 
		{ 
			if(Input::get('doctor')>0)
			{	
				$depentOnDr = 1;
				$n = Input::get('doctor');
				$doctors = DB::table('users')->where('type','doctor')->get();
				$i = 0; 
				foreach($doctors as $doctor)
					if(++$i==$n){ $doctorEmpID = $doctor->username; break; }
			}
			else if(Input::get('department')>0)
			{
				$depentOnDr = 0; 
				$d = Input::get('department');
				$departmentsList = ['','อายุรกรรม','ศัลยกรรม','ออร์โธปีดิกส์','กุมารเวชกรรม','สูตินรีเวช','ทันตกรรม','เวชปฏิบัติ','แพทย์เฉพาะทางอื่นๆ'];
				$department = $departmentsList[$d];
				$doctorEmpID = DB::table('users')->where('department',$department)->first()->username;
			}

			$addAppointment = new Appointment();
			$addAppointment->HN = Input::get('HN');
			$addAppointment->dependOnDr = $depentOnDr;
			$addAppointment->doctorEmpID = $doctorEmpID;
			$addAppointment->appointmentDate = Input::get('apptDate');
			$addAppointment->morning = Input::get('morning');
			$addAppointment->symptomOrReason = Input::get('cause');
			$addAppointment->save();
			return Redirect::to('officer/makeAppointment')->with('flash_notice','ดำเนินการทำนัดสำเร็จ');
		}
		else{return Redirect::to('officer/makeAppointment')->withErrors($validator)->withInput();}
	}
}
			
?>