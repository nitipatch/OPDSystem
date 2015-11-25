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
use View;

class ChangePrescribedDrugsController extends BaseController
{
	public function changePrescribedDrugsForm()
	{
		return View::make('doctor.changePrescribedDrugs');
	}

	public function changePrescribedDrugsCreate()
	{

		date_default_timezone_set('Asia/Bangkok');
		$date = date("Y-m-d",time());
		$time = date("H:i:s",time());
		$morning = 1;
		if((int)date("H",time())<12)
		$morning = 0;

		DB::table('prescribeddrugs')->where('HN',Input::get("patientHN"))
									->where('doctorEmpID',Session::get('username'))
								 	->where('date',$date)
								 	->where('time',$_POST['prescribedTime'])
								 	->delete();
			
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
								 ->update(array('prescribedTime'=>$time,'dispensedStatus'=>0));

		return Redirect::to('doctor/changePrescribedDrugs')->with('flash_notice','ดำเนินการสั่งยาใหม่สำเร็จ');
	}
}
			
?>