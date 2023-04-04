<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\Controller;

class SendLineNotiJob  implements ShouldQueue 
{ 
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $sMessage;

    public function __construct($sMessage)
    {
        //
        $this->$sMessage = $sMessage;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $sMessage = 'message=8cUzIzAOpCCWUzi4bQdnVEcXs9yvgJvU0BiR2tbVNal';
        $this->LineNotify($this->sMessage, '8cUzIzAOpCCWUzi4bQdnVEcXs9yvgJvU0BiR2tbVNal');

    }

    //telegramNotify_Controller
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
