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
		$validator = Validator::make(Input::all()
			,array('HN'=>'required|min:8|max:8'
			,'symptom'=>'required|max:1000'
			,'ICD10'=>'required')
			
			,array('HN.required'=>'กรุณากรอก HN ของผู้ป่วย','HN.min'=>'กรุณากรอก HN ของผู้ป่วยให้ถูกต้อง','HN.max'=>'กรุณากรอก HN ของผู้ป่วยให้ถูกต้อง'
			,'symptom.required'=>'กรุณากรอกอาการเบื้องต้น','symptom.max'=>'อาการเบื้องต้นยาวเกินไป'
			,'ICD10.required'=>'กรุณาเลือกรหัสโรค')
		);

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