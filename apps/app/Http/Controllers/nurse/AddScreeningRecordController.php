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
		$validator = Validator::make(Input::all()
			,array('HN'=>'required|min:8|max:8'
			,'symptom'=>'required|max:1000'
			,'weight'=>'required'
			,'height'=>'required|max:3'
			,'bloodPressureS'=>'required|max:3'
			,'bloodPressureD'=>'required|max:3'
			,'bodyTemp'=>'required'
			,'pulse'=>'required|max:3')
			
			,array('HN.required'=>'กรุณากรอก HN ของผู้ป่วย','HN.min'=>'กรุณากรอก HN ของผู้ป่วยให้ถูกต้อง','HN.max'=>'กรุณากรอก HN ของผู้ป่วยให้ถูกต้อง'
			,'symptom.required'=>'กรุณากรอกอาการเบื้องต้น','symptom.max'=>'อาการเบื้องต้นยาวเกินไป'
			,'weight.required'=>'กรุณากรอกส่วนสูง'
			,'height.required'=>'กรุณากรอกนำ้หน้า','height.max'=>'กรอกน้ำหนักไม่ถูกต้อง'
			,'bloodPressureS.required'=>'กรุณากรอกความดันโลหิต Systolic','bloodPressureS.max'=>'กรอกความดันโลหิต Systolic ไม่ถูกต้อง'
			,'bloodPressureD.required'=>'กรุณากรอกความดันโลหิต Diastolic','bloodPressureD.max'=>'กรอกความดันโลหิต Diastolic ไม่ถูกต้อง'
			,'bodyTemp.required'=>'กรุณากรอกอุณหภูมิร่างกาย'
			,'pulse.required'=>'กรุณากรอกชีพจร','pulse.max'=>'กรอกชีพจรไม่ถูกต้อง')
		);

		if ($validator->passes()) 
		{ 
			$addScreeningRecord = new ScreeningRecord();
			$allergicDrugsList = explode(',',Input::get('allergicDrug'));
			for($i=0; $i<sizeof($allergicDrugsList) ;$i++)
			if(!DB::table('HN_allergicDrug')->where('HN',Input::get('HN'))->where('allergicDrug',$allergicDrugsList[$i])->first())
			DB::table('HN_allergicDrug')->insert(array('HN'=>Input::get('HN'), 'allergicDrug'=>$allergicDrugsList[$i]));

			$addScreeningRecord->HN = Input::get('HN');
			date_default_timezone_set('Asia/Bangkok');
			$addScreeningRecord->screenDate = date("Y-m-d H:i:s",time());
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