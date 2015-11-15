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
		$validator = Validator::make(Input::all(),array(),array());

		if ($validator->passes()) 
		{ 
			$D = Input::get('D');
			$i = 0; 
			foreach($D as $item)
			{
				$i++;
				DB::table('prescribedDrugs')->where('HN',$D[$i][1])
											->where('doctorEmpID',$D[$i][2])										
											->where('date',$D[$i][3])
											->where('time',$D[$i][4])
											->where('pharmacistEmpID',Session::get('username'))
											->where('drugName',$D[$i][5])
											->update(array('checked'=>1
															,'drugName'=>$D[$i][6]
															,'quantity'=>$D[$i][7]
															,'description'=>$D[$i][8]));
			}
			
			return Redirect::to('pharmacist/dispense')->with('flash_notice','ดำเนินการจ่ายยาสำเร็จ');
		}
		else{return Redirect::to('pharmacist/dispense')->withErrors($validator)->withInput();}
	}
}
			
?>