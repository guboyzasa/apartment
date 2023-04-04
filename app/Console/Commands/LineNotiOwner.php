<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LineNotiOwner extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:send-line-noti-owner';


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


        $now = Carbon::now();
        $start = Carbon::createFromTime(22, 0);
        $end = Carbon::createFromTime(23, 0);

        if ($now->between($start, $end)) {

            DB::beginTransaction();
            $companies = Company::with('countWorkStatus1Today', 
            'countWorkStatus2Today', 
            'countWorkStatus3Today',
            'countWorkStatus4Today',
            'countWorkStatus5Today',
            'sumWorkEndToday',
            )->where('is_active', 1)->where('is_sent', 0)->where('line_token_owner', '!=', null)
            ->whereHas('companyPackage.package', function ($query)  {
                $query->where('is_fn_line_notify', 1);
            })
            ->limit(5)->get();

            foreach ($companies as $company) {
         
                $messa = "message=" .
                    "\n** สรุปงานวันนี้ **" .
                    "\nรอดำเนินการ: " . $company->countWorkStatus1Today->count() . " งาน" .
                    "\nกำลังดำเนินการ: " . $company->countWorkStatus2Today->count() . " งาน" .
                    "\nเสร็จงาน: " . $company->countWorkStatus3Today->count() . " งาน" .
                    "\nปิดงาน: " . $company->countWorkStatus4Today->count() . " งาน" .
                    "\nยกเลิก: " . $company->countWorkStatus5Today->count() . " งาน" .
                    "\nรวมยอดปิดงานทั้งหมด: " . number_format($company->sumWorkEndToday->sum('total_amount')) . " บาท" .
                    "\nรับเงินแล้ว: " . number_format($company->sumWorkEndToday->where('pay_status', '!=', 'ค้างชำระ')->sum('total_amount')) . " บาท";
                    $this->LineNotify($messa, $company->line_token_owner);
                $company->is_sent = 1;
                $company->save();
            }
            DB::commit();
        }

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
