<?php

namespace App\Providers;

use Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('hn_exist', function($attribute, $value, $parameters, $validator) 
        {
            $users = DB::table('Users')->get();
            foreach ($users as $user){ if($user->username == $value)return true; }
            return false;
        });
        Validator::extend('idencardno_exist', function($attribute, $value, $parameters, $validator) 
        {
            $patients = DB::table('idenCardNo_HN')->get();
            foreach ($patients as $patient){ if($patient->idenCardNo == $value)return true; }
            return false;
        });
        Validator::extend('already_register', function($attribute, $value, $parameters, $validator) 
        {
            $patients = DB::table('idenCardNo_HN')->get();
            foreach ($patients as $patient){ if($patient->idenCardNo==$value && $patient->registered==1)return false; }
            return true;
        });
        Validator::extend('already_have_appointment_patient', function($attribute, $value, $parameters, $validator) 
        {
            $str = $value;
            $cut = strpos($str," ");
            $len = strlen($str);
            $date = substr($str,0,$cut);
            if(strcmp(substr($str,$cut+1,$len-$cut-1),"เช้า")==0)$morning = 0; else $morning = 1;
            
            $appointments = DB::table('appointments')->get();
            foreach ($appointments as $appointment)
            { 
                date_default_timezone_set('Asia/Bangkok');
                $HN = Session::get('username');
                if($appointment->HN == $HN && $appointment->appointmentDate == $date && $appointment->morning == $morning)
                return false;
            }                                        
            return true;
        });
        Validator::extend('already_have_appointment_officer', function($attribute, $value, $parameters, $validator) 
        {
            $str = $value;
            $cut = strpos($str," ");
            $len = strlen($str);
            $date = substr($str,0,$cut);
            if(strcmp(substr($str,$cut+1,$len-$cut-1),"เช้า")==0)$morning = 0; else $morning = 1;
            
            $appointments = DB::table('appointments')->get();
            foreach ($appointments as $appointment)
            { 
                date_default_timezone_set('Asia/Bangkok');
                $HN = Session::get('HN');
                if($appointment->HN == $HN && $appointment->appointmentDate == $date && $appointment->morning == $morning)
                return false;
            }                                        
            return true;
        }); 
        Validator::extend('have_appointment', function($attribute, $value, $parameters, $validator) 
        {
            $appointments = DB::table('appointments')->get();
            foreach ($appointments as $appointment)
            { 
                date_default_timezone_set('Asia/Bangkok');
                $date = date("Y-m-d",time());
                $time = date("H:i:s",time());
                $morning = 1;
                if((int)date("H",time())<12)
                $morning = 0;
                if($appointment->HN == $value && $appointment->appointmentDate == $date && $appointment->morning == $morning)
                return true;
            }                                        
            return false;
        });
        Validator::extend('already_addscreeningrecord', function($attribute, $value, $parameters, $validator) 
        {
            $appointments = DB::table('appointments')->get();
            foreach ($appointments as $appointment)
            { 
                date_default_timezone_set('Asia/Bangkok');
                $date = date("Y-m-d",time());
                $time = date("H:i:s",time());
                $morning = 1;
                if((int)date("H",time())<12)
                $morning = 0;
                if(isset($appointment->addScreeningRecordTime) && $appointment->HN == $value && $appointment->appointmentDate == $date && $appointment->morning == $morning)
                return false;
            }                                        
            return true;
        });
        Validator::extend('already_addscreeningrecord', function($attribute, $value, $parameters, $validator) 
        {
            $appointments = DB::table('appointments')->get();
            foreach ($appointments as $appointment)
            { 
                date_default_timezone_set('Asia/Bangkok');
                $date = date("Y-m-d",time());
                $time = date("H:i:s",time());
                $morning = 1;
                if((int)date("H",time())<12)
                $morning = 0;
                if(isset($appointment->addScreeningRecordTime) && $appointment->HN == $value && $appointment->appointmentDate == $date && $appointment->morning == $morning)
                return false;
            }                                        
            return true;
        });
        Validator::extend('already_addmedicalrecord', function($attribute, $value, $parameters, $validator) 
        {
            $appointments = DB::table('appointments')->get();
            foreach ($appointments as $appointment)
            { 
                date_default_timezone_set('Asia/Bangkok');
                $date = date("Y-m-d",time());
                $time = date("H:i:s",time());
                $morning = 1;
                if((int)date("H",time())<12)
                $morning = 0;
                if(isset($appointment->addMedicalRecordTime) && $appointment->HN == $value && $appointment->appointmentDate == $date && $appointment->morning == $morning)
                return false;
            }                                        
            return true;
        });
        Validator::extend('already_prescribe', function($attribute, $value, $parameters, $validator) 
        {
            $appointments = DB::table('appointments')->get();
            foreach ($appointments as $appointment)
            { 
                date_default_timezone_set('Asia/Bangkok');
                $date = date("Y-m-d",time());
                $time = date("H:i:s",time());
                $morning = 1;
                if((int)date("H",time())<12)
                $morning = 0;
                if(isset($appointment->prescribedTime) && $appointment->HN == $value && $appointment->appointmentDate == $date && $appointment->morning == $morning)
                return false;
            }                                        
            return true;
        });      
        Validator::extend('have_appointment_with_me', function($attribute, $value, $parameters, $validator) 
        {
            $appointments = DB::table('appointments')->get();
            foreach ($appointments as $appointment)
            { 
                date_default_timezone_set('Asia/Bangkok');
                $date = date("Y-m-d",time());
                $time = date("H:i:s",time());
                $morning = 1;
                if((int)date("H",time())<12)
                $morning = 0;
                $doctorEmpID = Session::get('username');
                if($appointment->HN == $value && $appointment->doctorEmpID == $doctorEmpID && $appointment->appointmentDate == $date && $appointment->morning == $morning)
                return true;
            }                                        
            return false;
        });      
   }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
