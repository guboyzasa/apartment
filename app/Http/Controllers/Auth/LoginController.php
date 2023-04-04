<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected function redirectTo(){

        return route('dashboard');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        // dd($request->all());
        $input = $request->all();
        $this->validate($request,[
            'username'=>'required',
            'password'=>'required'
        ]);

        //telegramNotify_ล็อกอิน
        $date = date("d-m-Y H:i:s");
        $sMessageGroup['text'] = "** Login Success **".
            "\nLogin: ".$request->username.
            "\nDate: ".$date;

        if( auth()->attempt(array('username'=>$input['username'], 'password'=>$input['password'])) ){
            if(Auth::user()->is_super_admin == 1){
                // $this->telegramNotifyGroup($sMessageGroup);
                return redirect()->route('admin.dashboard');
            }
                // $this->telegramNotifyGroup($sMessageGroup);
            return redirect()->route('dashboard');
        }else{
            return redirect()->back()->withErrors('ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง กรุณากรอกข้อมูลใหม่อีกครั้ง');
        }
    }
}
