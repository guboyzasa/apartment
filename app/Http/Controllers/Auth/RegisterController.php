<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyPackage;
use App\Models\Package;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

    public function create()
    {
        $packages = Package::where('is_active', 1)->get();
        return view('auth.register-master', compact('packages'));
    }

    function store(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                'username' => ['required', 'string', 'max:255', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'password_confirmation' => ['required', 'string', 'min:8'],
                // 'company_name' => ['required', 'string', 'max:255'],
                // 'company_vat_code' => ['required', 'string', 'min:13', 'max:13'],
                'company_phone' => ['required', 'string', 'min:9', 'max:10'],
                // 'package' => ['required'],
                // 'package_month' => ['required'],
            ],
            [
                'username.required' => 'กรุณากรอก Username ',
                'username.unique' => 'Username นี้ถูกใช้งานไปแล้วกรุณากรอกใหม่',
                'email.required' => 'กรุณากรอก Email',
                'email.unique' => 'Email นี้ถูกใช้งานไปแล้วกรุณากรอกใหม่',
                'password.required' => 'กรุณากรอกรหัสผ่าน',
                'password.min' => 'กรุณากรอกรหัสผ่านอย่างน้อย 8 ตัว',
                'password.confirmed' => 'รหัสผ่านไม่ตรงกัน',
                'password_confirmation.required' => 'กรุณากรอกยืนยันรหัสผ่าน',
                'password_confirmation.min' => 'กรุณากรอกยืนยันรหัสผ่านอย่างน้อย 8 ตัว',
                // 'company_name.required' => 'กรุณากรอกชื่อร้าน',
                // 'company_vat_code.required' => 'กรุณากรอกเลขประจำตัวผู้เสียภาษี',
                'company_phone.required' => 'กรุณากรอกเบอร์โทรศัพท์',
                'company_phone.min' => 'กรุณากรอกเบอร์โทรศัพท์อย่างน้อย 9 ตัว',
                // 'package.required' => 'กรุณาเลือก Package',
                // 'package_month.required' => 'กรุณาจำนวนเดือนของ Package',
            ]
        );

        try {

            /** Make avata */
            $checkUser = User::where('username', $request->username)->orWhere('email', $request->email)->first();
            if ($checkUser) {
                return redirect()->back()->withErrors( 'Username หรือ Email ถูกใช้งานแล้ว กรุณากรอกใหม่');
            }

            // $checkCompany = Company::where('vat_code', $request->company_vat_code)->first();
            // if ($checkCompany) {
            //     return redirect()->back()->withErrors( 'เลขที่เสียภาษีนี้ ถูกใช้งานแล้ว กรุณากรอกใหม่');
            // }

            // $checkPackage = Package::where('id', $request->package)->where('is_active', 1)->first();


            // if (!$checkPackage) {
            //     return redirect()->back()->withErrors( 'ไม่พบ Package ที่คุณต้องการ');
            // }

            DB::beginTransaction();

            $company = new Company;
            $company->code = $this->generateCode('COM');
            $company->name = $request->username;
            $company->phone = $request->company_phone;
            // $company->vat_code = $request->company_vat_code;
            $company->email = $request->email;
            $company->save();

            $companyPackage = new CompanyPackage;
            $companyPackage->company_id = $company->id;
            // $companyPackage->package_id = $checkPackage->id;
            $companyPackage->package_id = 1;
            // $companyPackage->package_month = $request->package_month;
            $companyPackage->package_month = 1;
            $companyPackage->package_start = Carbon::now();
            $companyPackage->package_end = Carbon::now()->addMonths(1);
            // $companyPackage->package_price_per_month = $checkPackage->price_per_month ? $checkPackage->price_per_month : 0;
            // $companyPackage->package_amount_price = ($checkPackage->price_per_month ? $checkPackage->price_per_month : 0) *  $request->package_month;
            $companyPackage->package_price_per_month = 0;
            $companyPackage->package_amount_price = 0;
            $companyPackage->status = 'ACTIVE';
            $companyPackage->save();
            
            $user = new User;
            $user->username = $request->username;
            $user->name = $request->username;
            $user->email = $request->email;
            $user->phone = $request->company_phone;
            $user->role_id = 1;
            $user->password = Hash::make($request->password);
            $user->company_id = $company->id;
            $user->save();
            
            DB::commit();

            //telegramNotify_สมัครสมาชิก
            $date = date("d-m-Y H:i:s");
            $sMessage['text']= "** Register Success **".
                    "\nUser: ".$request->username.
                    "\nEmail: ".$request->email.
                    "\nPhone: ".$request->company_phone.
                    "\nDate: ".$date; 

            // $this->telegramNotify($sMessage);

            return redirect()->route('login')->with('success', 'สมัครสมาชิกใหม่สำเร็จ คุณสามารถเข้าสู่ระบบได้');
        } catch (\Exception $e) {

            $sMessageGroup['text'] = "** Error **" .
                "\nCompany: " . $request->company_name .
                "\nError: " . $e->getMessage();
                
                // $this->telegramNotifyGroup($sMessageGroup);
            
            return redirect()->back()->withErrors($e->getMessage());
            // return redirect()->back()->withErrors('มีบางอย่างผิดพลาด');
        }
    }
}
