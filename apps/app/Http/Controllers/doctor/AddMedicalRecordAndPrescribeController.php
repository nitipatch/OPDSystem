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
use App\PrescribedDrug;
use App\MedicalRecord;
use View;

class AddMedicalRecordAndPrescribeController extends BaseController
{
	public function addMedicalRecordAndPrescribeForm()
	{
		return View::make('doctor.addMedicalRecordAndPrescribe');
	}

	public function addMedicalRecordAndPrescribeCreate()
	{

		date_default_timezone_set('Asia/Bangkok');
		$date = date("Y-m-d",time());
		$time = date("H:i:s",time());
		$morning = 1;
		if((int)date("H",time())<12)
		$morning = 0;
			
		$Drugs = Input::get('D');
		if(count($Drugs)>0)
		foreach($Drugs as $Drug) 
		{
			$i=0;
			foreach($Drug as $D)
			{
				$i++;
					 if($i==1)$HN = $D;
				else if($i==6)$drugName = $D;
				else if($i==7)$quantity = $D;
				else if($i==8)$description = $D;
			}
			
			$addPrescribedDrug = new PrescribedDrug();
			$addPrescribedDrug->HN = $HN;
			$addPrescribedDrug->doctorEmpID = Session::get('username');
			$addPrescribedDrug->date = $date;
			$addPrescribedDrug->time = $time;
			$addPrescribedDrug->drugName = $drugName;
			$addPrescribedDrug->quantity = $quantity;	
			$addPrescribedDrug->description = $description;
 			$addPrescribedDrug->save();
		}

			DB::table('appointments')->where('HN',Input::get("patientHN"))
									 ->where('doctorEmpID',Session::get('username'))
									 ->where('appointmentDate',$date)
									 ->where('morning',$morning)
									 ->update(array('addMedicalRecordTime'=>$time,'prescribedTime'=>$time));

			$addMedicalRecord = new MedicalRecord();
			$addMedicalRecord->HN = Input::get("patientHN");
			$addMedicalRecord->doctorEmpID = Session::get('username');
			$addMedicalRecord->date = $date;
			$addMedicalRecord->time = $time;
			$addMedicalRecord->symptom = Input::get('symptom');
			$addMedicalRecord->ICD10 = substr(Input::get('ICD10'),0,strpos(Input::get('ICD10')," "));			
			$addMedicalRecord->save();

		return Redirect::to('doctor/addMedicalRecordAndPrescribe')->with('flash_notice','ดำเนินการบันทึกการรักษาและสั่งยาสำเร็จ');
	}
}
			
?>