<?php

namespace App\Http\Controllers\Admins;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use App\User;
use View;

class RegisterController extends BaseController
{
	public function registerForm()
	{
		return View::make('login.register');
	}
	public function registerCreate()
	{
		$user = DB::table('idenCardNo_HN')->where('idenCardNo',Input::get('idenCardNo'))->first();

		$validator = Validator::make(Input::all()
			,array('idenCardNo'=>'required|min:13|max:13'
			,'name'=>'required|max:100'
			,'surname'=>'required|max:200'
			,'birthdate'=>'required'
			,'address'=>'max:1000'
			,'phoneNo'=>'required|min:9|max:10|unique:users'
			,'emailAddr'=>'required|email|max:100|unique:users')
			
			,array('idenCardNo.required'=>'กรุณากรอกเลขบัตรประจำตัวประชาชน'
			,'idenCardNo.min'=>'กรอกเลขบัตรประจำตัวประชาชนไม่ครบ13หลัก'
			,'idenCardNo.max'=>'กรอกเลขบัตรประจำตัวประชาชนเกิน13หลัก'
			,'name.required'=>'กรุณากรอกชื่อ'
			,'name.max'=>'ชื่อยาวเกินไป'
			,'surname.required'=>'กรุณานามสกุล'
			,'surname.max'=>'นามสกุลยาวเกินไป'
			,'birthdate.required'=>'กรุณากรอกวันเดือนปีเกิด'
			,'address.max'=>'ที่อยู่ยาวเกินไป'
			,'phoneNo.required'=>'กรุณากรอกเบอร์โทรศัพท์'
			,'phoneNo.min'=>'เบอร์โทรศัพท์สั้นเกินไป'			
			,'phoneNo.max'=>'เบอร์โทรศัพท์ยาวเกินไป'
			,'phoneNo.unique'=>'เบอร์โทรศัพท์นี้มีอยู่ในระบบแล้ว'
			,'emailAddr.required'=>'กรุณากรอกอีเมล'
			,'emailAddr.email'=>'รูปแบบอีเมลไม่ถูกต้อง'			
			,'emailAddr.max'=>'อีเมลยาวเกินไป'
			,'emailAddr.unique'=>'อีเมลนี้มีอยู่ในระบบแล้ว')
		);
		if ($validator->passes()) { $addUser = new User();
			$addUser->type = 'patient';
			$addUser->username = $user->HN;
			$addUser->name = Input::get('name');
			$addUser->surname = Input::get('surname');
			$addUser->birthdate= Input::get('birthdate'); 
			$addUser->address = Input::get('address');
			$addUser->phoneNo = Input::get('phoneNo');			
			$addUser->emailAddr = Input::get('emailAddr');

			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    		$charactersLength = strlen($characters);
    		$randomString = '';
    		for ($i = 0; $i < 8; $i++)
        		$randomString .= $characters[rand(0, $charactersLength - 1)];
        	mail(Input::get('emailAddr'),"ตรวจสอบรหัสผ่านในการเข้าสู่เว็บไซต์ OPDSystem",$randomString ,'');
  
			$addUser->password = Hash::make($randomString);	
			$addUser->save();
			return Redirect::to('login/register')->with('flash_notice' , $randomString);}
		else{return Redirect::to('login/register')->withErrors($validator)
			->withInput(Input::except('password'))
			->withInput(Input::except('password_confirmation'))
			->withInput();}}}
?>