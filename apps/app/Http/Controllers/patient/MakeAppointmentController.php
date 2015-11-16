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
			,array('doctor'=>'required_without:department'
			,'department'=>'required_without:doctor')
			
			,array('doctor.required_without'=>'กรุณาเลือกแพทย์หรือแผนกที่ต้องการนัด'
			,'department.required_without'=>'กรุณาเลือกแพทย์หรือแผนกที่ต้องการนัด')
		);

		if ($validator->passes()) 
		{ 
			if(Input::get('doctor')>=0)
			{	
				$depentOnDr = 1;
				$n = Input::get('doctor');
				$doctors = DB::table('users')->where('type','doctor')->get();
				$i = 0; 
				foreach($doctors as $doctor)
					if($i++==$n){ $doctorEmpID = $doctor->username; break; }
			}
			else if(Input::get('department')>=0)
			{
				$depentOnDr = 0; 
				$d = Input::get('department');
				$departmentsList = ['อายุรกรรม','ศัลยกรรม','ออร์โธปีดิกส์','กุมารเวชกรรม','สูตินรีเวช','ทันตกรรม','เวชปฏิบัติ','แพทย์เฉพาะทางอื่นๆ'];
				$department = $departmentsList[$d];
				$doctorEmpID = DB::table('users')->where('department',$department)->first()->username;
			}

			$addAppointment = new Appointment();
			$addAppointment->HN = Session::get('username');
			$addAppointment->dependOnDr = $depentOnDr;
			$addAppointment->doctorEmpID = $doctorEmpID;			
			
			$str = Input::get('apptDate');
			$cut = strpos($str," ");
			$len = strlen($str);
			$date = substr($str,0,$cut);
			$addAppointment->appointmentDate = $date;
			if(strcmp(substr($str,$cut+1,$len-$cut-1),"เช้า")==0)$morning = 0; else $morning = 1; 
			$addAppointment->morning = $morning;
			
			$addAppointment->symptomOrReason = Input::get('cause');
			$addAppointment->save();

			DB::table('ondutySchedule')->where('doctorEmpID',$doctorEmpID)
										->where('date',$date)
										->where('morning',$morning)
										->update(array('appointed'=>1));	

			return Redirect::to('patient/makeAppointment')->with('flash_notice','ดำเนินการทำนัดสำเร็จ');
		}
		else{return Redirect::to('patient/makeAppointment')->withErrors($validator)->withInput();}
	}
}
			
?>