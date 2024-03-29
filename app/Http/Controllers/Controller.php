<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vendor;
use App\Models\Room;
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
        try {
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
        } catch (\Exception $e) {
            $sMessageGroup['text'] = "** Error **" .
                "\nError: " . $e->getMessage();

            $this->telegramNotifyGroup($sMessageGroup);
        }
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
        try {
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
            } else {
                dd('Base64 not match');
            }
        } catch (\Exception $e) {
            $sMessageGroup['text'] = "** Error **" .
                "\nError: " . $e->getMessage();

            $this->telegramNotifyGroup($sMessageGroup);
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
            $sMessageGroup['text'] = "** Error **" .
                "\nError: " . $e->getMessage();

            $this->telegramNotifyGroup($sMessageGroup);
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

            $this->telegramNotifyGroup($sMessageGroup);
        }
    }

    //telegramNotifyImg_Controller
    public function telegramNotiflyWithImage($fullPath)
    {
        try {

            $BOT_TOKEN = env('TELEGRAM_TOKEN'); //----YOUR BOT TOKEN
            $chat_id = env('ID_GROUP_G'); // or '123456' ------Receiver chat id
            define('BOTAPI', 'https://api.telegram.org/bot' . $BOT_TOKEN . '/');

            $cfile = new \CURLFile(realpath($fullPath), 'image/jpg', 'slips.jpg');
            $data = [
                'chat_id' => $chat_id,
                'photo' => $cfile
            ];

            $ch = curl_init(BOTAPI . 'sendPhoto');
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

            $this->telegramNotifyGroup($sMessageGroup);
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
        } catch (\Exception $e) {
            $sMessageGroup['text'] = "** Error **" .
                "\nError: " . $e->getMessage();

            $this->telegramNotifyGroup($sMessageGroup);
        }
    }

}
