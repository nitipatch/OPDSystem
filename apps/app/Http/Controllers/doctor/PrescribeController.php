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

	//create foo validation rule

	public function prescribeCreate()
	{
		$v1 = array('HN'=>'min:8|hn_exist');
		$v2 = array('HN.min'=>'ท่านกรอก HN ของผู้ป่วยไม่ครบ','HN.hn_exist'=>'HN ที่ท่านกรอกไม่ตรงกับผู้ป่วยใดของโรงพยาบาล');
		$validator = Validator::make(Input::all(),$v1,$v2);

		if ($validator->passes()) 
		{
			$min = -1;
			$pharmacists = DB::table('users')->where('type','pharmacist')->get();
			foreach($pharmacists as $pharmacist)
			{
				$amount = count(DB::table('prescribedDrugs')->where('pharmacistEmpID',$pharmacist->username)->where('checked',0)->get());
				if($amount<$min || $min==-1)
				{
					$min = $amount; 
					$pharmacistEmpID = $pharmacist->username;
				}
			}

			$Drugs = Input::get('D');
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
				$addPrescribedDrug->date = date("Y-m-d",time());
				$addPrescribedDrug->time = date("H:i:s",time());
				$addPrescribedDrug->drugName = $drugName;
				$addPrescribedDrug->quantity = $quantity;	
				$addPrescribedDrug->description = $description;
				$addPrescribedDrug->pharmacistEmpID = $pharmacistEmpID;
				$addPrescribedDrug->checked = 0;
 				$addPrescribedDrug->save();
			}
			return Redirect::to('doctor/prescribe')->with('flash_notice','ดำเนินการสั่งยาสำเร็จ');
		}else{return Redirect::to('doctor/prescribe')->withErrors($validator)->withInput();}
	}
}
			
?>