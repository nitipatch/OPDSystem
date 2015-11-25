<?php

namespace App\Http\Controllers\pharmacist;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use View;

class DispenseController extends BaseController
{
	public function dispenseForm()
	{
		return View::make('pharmacist.dispense');
	}

	public function dispenseCreate()
	{
		date_default_timezone_set('Asia/Bangkok');
		$date = date("Y-m-d",time());
		$time = date("H:i:s",time());
		$morning = 1;
		if((int)date("H",time())<12)
		$morning = 0;
			
		/*
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
		}*/		
		$msg="จ่ายยา";
		DB::table('appointments')->where('HN',Input::get('patientHN'))
								->where('pharmacistEmpID',Session::get('username'))
								->where('appointmentDate',$date)
								->where('morning',$morning)
								->update(array('dispensedTime'=>$time,'dispensedStatus'=>Input::get('status')));
		
		if(Input::get('status')==1)
		{
			$msg="ขอรายการยาใหม่";
			DB::table('appointments')->where('HN',Input::get('patientHN'))
									->where('pharmacistEmpID',Session::get('username'))
									->where('appointmentDate',$date)
									->where('morning',$morning)
									->update(array('comment'=>Input::get('comment')));
		}

		return Redirect::to('pharmacist/dispense')->with('flash_notice','ดำเนินการ'.$msg.'สำเร็จ');
	}
}
			
?>