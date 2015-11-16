<?php

namespace App\Http\Controllers\nurse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\ScreeningRecord;
use View;

class AddScreeningRecordController extends BaseController
{
	public function addScreeningRecordForm()
	{
		return View::make('nurse.addScreeningRecord');
	}
	public function addScreeningRecordCreate()
	{
		$validator = Validator::make(Input::all(),array('HN'=>'min:8|hn_exist')
					,array('HN.min'=>'ท่านกรอก HN ของผู้ป่วยไม่ครบ','HN.hn_exist'=>'HN ที่ท่านกรอกไม่ตรงกับผู้ป่วยใดของโรงพยาบาล'));

		if ($validator->passes()) 
		{ 
			$addScreeningRecord = new ScreeningRecord();
			$allergicDrugsList = explode(',',Input::get('allergicDrug'));
			for($i=0; $i<sizeof($allergicDrugsList) ;$i++)
			if(!DB::table('HN_allergicDrug')->where('HN',Input::get('HN'))->where('allergicDrug',$allergicDrugsList[$i])->first())
			DB::table('HN_allergicDrug')->insert(array('HN'=>Input::get('HN'), 'allergicDrug'=>$allergicDrugsList[$i]));
			
			date_default_timezone_set('Asia/Bangkok');
			$date = date("Y-m-d",time());
			$time = date("H:i:s",time());
			$morning = 1;
			if((int)date("H",time())<12)
			$morning = 0;
			DB::table('appointments')->where('HN',Input::get('HN'))
									 ->where('appointmentDate',$date)
									 ->where('morning',$morning)
									 ->update(array('addScreeningRecordTime'=>$time));	

			$addScreeningRecord->HN = Input::get('HN');
			$addScreeningRecord->date = $date;
			$addScreeningRecord->time = $time;
			$addScreeningRecord->symptom = Input::get('symptom');
			$addScreeningRecord->weight = Input::get('weight');
			$addScreeningRecord->height = Input::get('height');
			$addScreeningRecord->bloodPressureS = Input::get('bloodPressureS');
			$addScreeningRecord->bloodPressureD = Input::get('bloodPressureD');
			$addScreeningRecord->bodyTemp = Input::get('bodyTemp');
			$addScreeningRecord->pulse = Input::get('pulse');
			
			$addScreeningRecord->save();
			return Redirect::to('nurse/addScreeningRecord')->with('flash_notice','ดำเนินการบันทึกการตรวจคัดกรองสำเร็จ');
		}
		else{return Redirect::to('nurse/addScreeningRecord')->withErrors($validator)->withInput();}
	}
}
			
?>