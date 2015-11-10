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
		/*
		$validator = Validator::make(Input::all()
			,array('HN'=>'required|min:8|max:8'
			,'description'=>'required|max:1000'
			,'drugName'=>'required|max:100'
			,'quantity'=>'required|max:20')
			
			,array('HN.required'=>'กรุณากรอก HN ของผู้ป่วย','HN.min'=>'กรุณากรอก HN ของผู้ป่วยให้ถูกต้อง','HN.max'=>'กรุณากรอก HN ของผู้ป่วยให้ถูกต้อง'
			,'description.required'=>'กรุณากรอกอาการเบื้องต้น','description.max'=>'อาการเบื้องต้นยาวเกินไป'
			,'drugName.required'=>'กรุณากรอกชื่อยา','drugName.max'=>'ชื่อยายาวเกินไป'
			,'quantity.required'=>'กรุณากรอกปริมาณยา','quantity.max'=>'ปริมาณยายาวเกินไป')
		);
		
		if ($validator->passes()) 
		{*/
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
				$addPrescribedDrug->date = date("Y-m-d H:i:s",time());
				$addPrescribedDrug->drugName = $drugName;
				$addPrescribedDrug->quantity = $quantity;	
				$addPrescribedDrug->description = $description;
				$addPrescribedDrug->save();
			}
			return Redirect::to('doctor/prescribe')->with('flash_notice','ดำเนินการสั่งยาสำเร็จ');
		//}else{return Redirect::to('doctor/prescribe')->withErrors($validator)->withInput();}
	}
}
			
?>