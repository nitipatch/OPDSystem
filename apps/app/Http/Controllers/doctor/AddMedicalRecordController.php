<?php

namespace App\Http\Controllers\doctor;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\MedicalRecord;
use View;

class AddMedicalRecordController extends BaseController
{
	public function addMedicalRecordForm()
	{
		return View::make('doctor.addMedicalRecord');
	}
	public function addMedicalRecordCreate()
	{
		$validator = Validator::make(Input::all(),array('HN'=>'min:8|hn_exist')
					,array('HN.min'=>'ท่านกรอก HN ของผู้ป่วยไม่ครบ','HN.hn_exist'=>'HN ที่ท่านกรอกไม่ตรงกับผู้ป่วยใดของโรงพยาบาล'));

		if ($validator->passes()) 
		{ 
				$n = Input::get('ICD10');
				$diseases = DB::table('ICD10_Disease')->get();
				$i = 0; 
				foreach($diseases as $disease)
					if(++$i==$n){ $ICD10 = $disease->ICD10; break; }

			$addMedicalRecord = new MedicalRecord();
			$addMedicalRecord->HN = Input::get('HN');
			$addMedicalRecord->doctorEmpID = Session::get('username');
			date_default_timezone_set('Asia/Bangkok');
			$addMedicalRecord->date = date("Y-m-d H:i:s",time());
			$addMedicalRecord->symptom = Input::get('symptom');
			$addMedicalRecord->ICD10 = $ICD10;			
			$addMedicalRecord->save();
			return Redirect::to('doctor/addMedicalRecord')->with('flash_notice','ดำเนินการบันทึกการรักษาสำเร็จ');
		}
		else{return Redirect::to('doctor/addMedicalRecord')->withErrors($validator)->withInput();}
	}
}
			
?>