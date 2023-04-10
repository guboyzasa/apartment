<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
// use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LineGroup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:send-line-noti-group';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
                $messa = "message=" .
                    "\n** ApartMent **".
                    "\nเคลียร์ dashboard เรียบร้อย";
                    $this->LineNotify($messa, env('LINE_PRIVATE_GROUP'));

        return Command::SUCCESS;
    }


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
