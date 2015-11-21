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
			,array('idenCardNo'=>'min:13|idencardno_exist|already_register'
			,'phoneNo'=>'min:10|unique:users'
			,'emailAddr'=>'email|unique:users')
			
			,array('idenCardNo.min'=>'ท่านกรอกเลขบัตรประจำตัวประชาชนไม่ครบ13หลัก'
			,'idenCardNo.idencardno_exist'=>'ท่านยังไม่ได้เป็นผู้ป่วยของโรงพยาบาล'
			,'idenCardNo.already_register'=>'ท่านได้ทำการสมัครสมาชิกไปแล้ว'
			,'phoneNo.min'=>'ท่านกรอกเบอร์โทรศัพท์ไม่ครบ'			
			,'phoneNo.unique'=>'เบอร์โทรศัพท์นี้มีอยู่ในระบบแล้ว'
			,'emailAddr.email'=>'รูปแบบอีเมลไม่ถูกต้อง'			
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
        	//mail(Input::get('emailAddr'),"ตรวจสอบรหัสผ่านในการเข้าสู่เว็บไซต์ OPDSystem",$randomString ,'');
  
			$addUser->password = Hash::make($randomString);	
			$addUser->save();

			DB::table('idenCardNo_HN')->where('idenCardNo',Input::get('idenCardNo'))
										->where('HN',$user->HN)
										->update(array('registered'=>1));

			return Redirect::to('login/register')->with('flash_notice' , $randomString);}
		else{return Redirect::to('login/register')->withErrors($validator)
			->withInput(Input::except('password'))
			->withInput(Input::except('password_confirmation'))
			->withInput();}}}
?>