<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function changePassword(Request $req)
    {

        // return $req->all();
        $current_password = $req->current_password;
        $user_id = $req->id;
        $password = $req->password;
        $password_confirmation = $req->password_confirmation;

        $user = User::find($user_id);
        if (!$user) {
            $data = [
                'title' => 'ผิดพลาด!',
                'msg' => 'ไม่พบผู้ใช้',
                'status' => 'error',
            ];
            return $data;
        }
        if ($password != $password_confirmation) {
            $data = [
                'title' => 'ผิดพลาด!',
                'msg' => 'รหัสผ่านไม่ตรงกัน',
                'status' => 'error',
            ];
            return $data;
        }
        $user->password = Hash::make($password);
        $user->save();

        $data = [
            'title' => 'สำเร็จ!',
            'msg' => 'บันทึกรหัสผ่านสำเร็จ',
            'status' => 'success',
        ];
        return $data;
    }

    public function generateCode($prefix)
    {
        $code = null;
        $lastCode = null;

        $now_at = Carbon::now();

        $month = $now_at->month;

        if (strlen($month) == 1) {
            $month = '0' . $month;
        }

        $year = $now_at->year;
        $numCut = 0;
        switch ($prefix) {
            case 'COM':
                $lastCode = Company::orderBy('id', 'desc')->whereNotNull('code')->first();
                $lastCode = $lastCode ? $lastCode->code : null;
                $numCut = 3;
                break;
            case 'REQ':
                $lastCode = RequestPackage::orderBy('id', 'desc')->whereNotNull('code')->first();
                $lastCode = $lastCode ? $lastCode->code : null;
                $numCut = 3;
                break;
            case 'CM':
                $lastCode = Customer::orderBy('id', 'desc')->where('company_id', Auth::user()->company_id)->whereNotNull('code')->first();
                $lastCode = $lastCode ? $lastCode->code : null;
                $numCut = 2;
                break;
            case 'SKU':
                $lastCode = Product::orderBy('id', 'desc')->where('company_id', Auth::user()->company_id)->where('sku', 'LIKE', 'SKU00%')->whereNotNull('sku')->first();
                $lastCode = $lastCode ? $lastCode->sku : null;
                $numCut = 3;
                break;
            case 'PM':
                $lastCode = ProductModel::orderBy('id', 'desc')->where('company_id', Auth::user()->company_id)->where('code', 'LIKE', 'PM00%')->whereNotNull('code')->first();
                $lastCode = $lastCode ? $lastCode->code : null;
                $numCut = 2;
                break;
            case 'PC':
                $lastCode = ProductCategory::orderBy('id', 'desc')->where('company_id', Auth::user()->company_id)->where('code', 'LIKE', 'PC00%')->whereNotNull('code')->first();
                $lastCode = $lastCode ? $lastCode->code : null;
                $numCut = 2;
                break;
            case 'PB':
                $lastCode = ProductBrand::orderBy('id', 'desc')->where('company_id', Auth::user()->company_id)->where('code', 'LIKE', 'PB00%')->whereNotNull('code')->first();
                $lastCode = $lastCode ? $lastCode->code : null;
                $numCut = 2;
                break;
            case 'UN':
                $lastCode = Unit::orderBy('id', 'desc')->where('company_id', Auth::user()->company_id)->where('code', 'LIKE', 'UN00%')->whereNotNull('code')->first();
                $lastCode = $lastCode ? $lastCode->code : null;
                $numCut = 2;
                break;
            case 'VEN':
                $lastCode = Vendor::orderBy('id', 'desc')->where('company_id', Auth::user()->company_id)->whereNotNull('code')->first();
                $lastCode = $lastCode ? $lastCode->code : null;
                $numCut = 3;
                break;
            case 'WK':
                $lastCode = Work::orderBy('id', 'desc')->where('company_id', Auth::user()->company_id)->where('code', 'LIKE', 'WK00%')->whereNotNull('code')->first();
                $lastCode = $lastCode ? $lastCode->code : null;
                $numCut = 2;
                break;
            case 'WT':
                $lastCode = WorkType::orderBy('id', 'desc')->where('company_id', Auth::user()->company_id)->where('code', 'LIKE', 'WT00%')->whereNotNull('code')->first();
                $lastCode = $lastCode ? $lastCode->code : null;
                $numCut = 2;
                break;
            case 'ST':
                $lastCode = ReceiveProduct::orderBy('id', 'desc')->where('company_id', Auth::user()->company_id)->where('code', 'LIKE', 'ST00%')->whereNotNull('code')->first();
                $lastCode = $lastCode ? $lastCode->code : null;
                $numCut = 2;
                break;
            case 'QT':
                $lastCode = Quotation::orderBy('id', 'desc')->where('company_id', Auth::user()->company_id)->where('code', 'LIKE', 'QT00%')->whereNotNull('code')->first();
                $lastCode = $lastCode ? $lastCode->code : null;
                $numCut = 2;
                break;
            case 'SER':
                $lastCode = Product::orderBy('id', 'desc')->where('company_id', Auth::user()->company_id)->where('sku', 'LIKE', 'SER00%')->whereNotNull('sku')->first();
                $lastCode = $lastCode ? $lastCode->sku : null;
                $numCut = 3;
                break;
            default:
                # code...
                break;
        }

        if ($lastCode == null) {
            $currentCode = $prefix . '000001';
            return $currentCode;
        }

        $count = strlen($lastCode) - $numCut;
        $num = (int) substr($lastCode, $numCut);
        $code = $num + 1;
        $count = $count - strlen($code);


        for ($i = 0; $i < $count; $i++) {
            $code = '0' . $code;
        }

        $newCode =  $prefix . $code;

        return $newCode;
    }

    function pagesmaintenance()
    {
        return view('maintenance');
    }

    function pageNotFound()
    {
        return view('pages-404');
    }

    public function uploadBase64($base64_image, $path)
    {

        if (preg_match('/^data:image\/(\w+);base64,/', $base64_image)) {
            // if (env('APP_ENV') == 'production') {
            $data = substr($base64_image, strpos($base64_image, ',') + 1);
            $base64_decode = base64_decode($data);
            $extension = explode('/', explode(':', substr($base64_image, 0, strpos($base64_image, ';')))[1])[1];
            $fileName = strtotime(Carbon::now()) . rand(1, 100) . '.' . $extension;
            $now = strtotime(Carbon::now());
            $fullPath = $path . '/' . $fileName;
            $disk = Storage::disk('local');
            $disk->put($fullPath, $base64_decode);
            return $fullPath;
            // } else {
            //     return '/img/noimage.jpg';
            // }
        } else {
            dd('Base64 not match');
        }
    }

    //telegramNotify_Controller
    public function telegramNotify($sMessage)
    {
        try {
            $apiToken = env('TELEGRAM_TOKEN');
            $sMessage['chat_id'] = env('ID_GROUP');
            $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($sMessage));
        } catch (\Exception $e) {
            $sMessage['text'] = "** Error **" .
                "\nError: " . $e->getMessage();

            // $this->telegramNotify($sMessage);
        }
    }

     //telegramNotify_Controller
    public function telegramNotifyGroup($sMessageGroup)
    {
        try {
            $apiToken = env('TELEGRAM_TOKEN');
            $sMessageGroup['chat_id'] = env('ID_GROUP_G');
            $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($sMessageGroup));
        } catch (\Exception $e) {
            $sMessageGroup['text'] = "** Error **" .
                "\nError: " . $e->getMessage();

            // $this->telegramNotifyGroup($sMessageGroup);
        }
    }

     //telegramNotifyImg_Controller
     public function telegramNotiflyWithImage($fullPath)
     {      
        try {

            $BOT_TOKEN=env('TELEGRAM_TOKEN'); //----YOUR BOT TOKEN
            $chat_id=env('ID_GROUP'); // or '123456' ------Receiver chat id
            define('BOTAPI','https://api.telegram.org/bot' . $BOT_TOKEN .'/');

            $cfile = new \CURLFile(realpath($fullPath), 'image/jpg', 'slips.jpg');
                $data = [
                    'chat_id' => $chat_id , 
                    'photo' => $cfile
                    ];

                $ch = curl_init(BOTAPI.'sendPhoto');
                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $result = curl_exec($ch);
                curl_close($ch);

        } catch (\Exception $e) {
             $sMessageGroup['text'] = "** Error **" .
                 "\nError: " . $e->getMessage();
 
            //  $this->telegramNotifyGroup($sMessageGroup);
         }
     }

    //LineNotify_Controller
    public function LineNotify($LineMessage, $token)
    {
        try {
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            date_default_timezone_set("Asia/Bangkok");

            $chOne = curl_init();
            curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
            curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($chOne, CURLOPT_POST, 1);
            curl_setopt($chOne, CURLOPT_POSTFIELDS, $LineMessage);

            $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $token . '');
            curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($chOne);

            curl_close($chOne);
        } catch (\Throwable $th) {
            return false;
        }
    }

}
