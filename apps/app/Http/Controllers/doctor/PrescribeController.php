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

class PrescribeController extends BaseController
{
	public function prescribeForm()
	{
		return View::make('doctor.prescribe');
	}

	public function prescribeCreate()
	{
		$validator = Validator::make(Input::all(),array('HN'=>'min:8|hn_exist|have_appointment_with_me')
					,array('HN.min'=>'ท่านกรอก HN ของผู้ป่วยไม่ครบ'
							,'HN.hn_exist'=>'HN ที่ท่านกรอกไม่ตรงกับผู้ป่วยใดของโรงพยาบาล'
							,'HN.have_appointment_with_me'=>'ผู้ป่วยคนนี้ไม่ได้นัดกับท่านไว้ในช่วงเวลานี้'
							));

		if ($validator->passes()) 
		{
			$min = -1;
			$pharmacists = DB::table('users')->where('type','pharmacist')->get();
			foreach($pharmacists as $pharmacist)
			{
				$amount = count(DB::table('appointments')->where('pharmacistEmpID',$pharmacist->username)->whereNull('dispensedTime')->get());
				if($amount<$min || $min==-1)
				{
					$min = $amount; 
					$pharmacistEmpID = $pharmacist->username;
				}
			}

			date_default_timezone_set('Asia/Bangkok');
			$date = date("Y-m-d",time());
			$time = date("H:i:s",time());
			$morning = 1;
			if((int)date("H",time())<12)
			$morning = 0;
			DB::table('appointments')->where('HN',Input::get('HN'))
									 ->where('doctorEmpID',Session::get('username'))
									 ->where('appointmentDate',$date)
									 ->where('morning',$morning)
									 ->update(array('prescribedTime'=>$time,'pharmacistEmpID'=>$pharmacistEmpID));

			
			$Drugs = Input::get('D');
			if(count($Drugs)>0)
			foreach($Drugs as $Drug) 
			{
				$i=0;
				foreach($Drug as $D)
				{
					$i++;
						 if($i==1)$drugName = $D;
					else if($i==2)$quantity = $D;
					else if($i==3)$description = $D;
				}
				$addPrescribedDrug = new PrescribedDrug();
				$addPrescribedDrug->HN = Input::get('HN');
				$addPrescribedDrug->doctorEmpID = Session::get('username');
				date_default_timezone_set('Asia/Bangkok');
				$addPrescribedDrug->date = $date;
				$addPrescribedDrug->time = $time;
				$addPrescribedDrug->drugName = $drugName;
				$addPrescribedDrug->quantity = $quantity;	
				$addPrescribedDrug->description = $description;
 				$addPrescribedDrug->save();
			}
			return Redirect::to('doctor/prescribe')->with('flash_notice','ดำเนินการสั่งยาสำเร็จ');
		}else{return Redirect::to('doctor/prescribe')->withErrors($validator)->withInput();}
	}
}
			
?>