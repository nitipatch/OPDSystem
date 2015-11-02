<?php namespace App\Http\Controllers\Admins; //กำหนดให้ระบบทราบว่า Controller นี้อยู่ไหน
     use Auth; // ทำการเรียกใช้ Auth เพื่อเอาไว้ตรวจสอบว่า มีการ Login อยู่แล้วหรือไม่
     use Illuminate\Routing\Controller; // เรียกใช้ Controller ของ Laravel 5.0
     use App\Http\Requests\Admins\LoginRequest; // สำหรับตรวจสอบ หรือสร้าง Validate ให้กับ Form
 
class LoginController extends Controller {
  // ตรวจสอบว่า มีการ Login อยู่หรือไม่ ถ้า Login อยู่ ระบบจะทำการ redirect ไปหน้า Index ถ้ายัง ก็ให้อยู่ในหน้า Login
    public function getIndex()
    {
      if(Auth::check()) return redirect('/login/index');
      else return view('login.loginframe');
    }

    public function getIndexSlash()
    {
      if(Auth::check()) return redirect('/login/index');
      else return redirect('/login/loginframe');
    }

    public function patient(){ return redirect('patient/loginsuccess'); }
    public function doctor(){ return redirect('doctor/loginsuccess'); }
    
    // ตรวจสอบค่าที่ส่งมาจาก Form login แล้วเรียนกใช้การ validate จาก LoginRequest
    public function postProcess(LoginRequest $request)
    {
      $username = $request->input('username');
      $password = $request->input('password');
      if(Auth::attempt(['username' => $username,'password'=>$password,'type'=>'patient'],$request->has('remember')))
          return redirect()->intended('/login/patient');
      if(Auth::attempt(['username' => $username,'password'=>$password,'type'=>'doctor'],$request->has('remember')))
          return redirect()->intended('/login/doctor');
      else
          return redirect()->back()->with('message',"Error!! Username or Password Incorrect. \nPlease try again.");;
    }

    // สำหรับทำการ Logout
    public function getLogout()
    {
      Auth::logout();
      return redirect('/login/loginframe');
    }
}
