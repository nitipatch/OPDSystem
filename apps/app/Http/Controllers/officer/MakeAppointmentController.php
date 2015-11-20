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
		Session::put('HN',Input::get('HN'));
		$validator = Validator::make(Input::all()
			,array('HN'=>'min:8|hn_exist'
			,'apptDate'=>'already_have_appointment'
			,'doctor'=>'required_without:department'
			,'department'=>'required_without:doctor')
			
			,array('HN.min'=>'ท่านกรอก HN ของผู้ป่วยไม่ครบ'
			,'HN.hn_exist'=>'HN ที่ท่านกรอกไม่ตรงกับผู้ป่วยใดของโรงพยาบาล'
			,'apptDate.already_have_appointment'=>'ผู้ป่วยคนนี้มีนัดแล้วในช่วงเวลาที่ท่านเลือก'
			,'doctor.required_without'=>'กรุณาเลือกแพทย์หรือแผนกที่ต้องการนัด'
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
			$addAppointment->HN = Input::get('HN');
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

			return Redirect::to('officer/makeAppointment')->with('flash_notice','ดำเนินการทำนัดสำเร็จ');
		}
		else{return Redirect::to('officer/makeAppointment')->withErrors($validator)->withInput();}
	}
}
			
?>