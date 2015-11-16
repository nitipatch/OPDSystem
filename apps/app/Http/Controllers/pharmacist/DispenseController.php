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
use App\DispensedDrug;
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
			
		$Drugs = Input::get('D');
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
			DB::table('appointments')->where('HN',$HN)
									 ->where('pharmacistEmpID',Session::get('username'))
									 ->where('appointmentDate',$date)
									 ->where('morning',$morning)
									 ->update(array('dispensedTime'=>$time));
			$addDispensedDrug = new DispensedDrug();
			$addDispensedDrug->HN = $HN;
			$addDispensedDrug->pharmacistEmpID = Session::get('username');
			date_default_timezone_set('Asia/Bangkok');
			$addDispensedDrug->date = $date;
			$addDispensedDrug->time = $time;
			$addDispensedDrug->drugName = $drugName;
			$addDispensedDrug->quantity = $quantity;	
			$addDispensedDrug->description = $description;
 			$addDispensedDrug->save();
		}
		return Redirect::to('pharmacist/dispense')->with('flash_notice','ดำเนินการจ่ายยาสำเร็จ');
	}
}
			
?>