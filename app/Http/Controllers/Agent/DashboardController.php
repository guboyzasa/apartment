<?php


namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Work;
use App\Models\WarrantyRegistration;
use App\Models\CompanyPackage;
use App\Models\Product;
use App\Models\WorkDetail;
use App\Models\WorkEnd;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $currentPackage = CompanyPackage::where('company_id', Auth::user()->company_id)->where('status', 'ACTIVE')->orderBy('id', 'desc')->with('package')->first();
        $workWaitRepair = Work::where('company_id', Auth::user()->company_id)->where('status', 'รอดำเนินการ')->count();
        $workProgress = Work::where('company_id', Auth::user()->company_id)->where('status', 'กำลังดำเนินการ')->count();
        $workEnd = Work::where('company_id', Auth::user()->company_id)->where('status', 'เสร็จงาน')->count();
        $workOffEnd = Work::where('company_id', Auth::user()->company_id)->where('status', 'ปิดงาน')->count();
        $workCancel = Work::where('company_id', Auth::user()->company_id)->where('status', 'ยกเลิก')->count();

        $countWork = $workWaitRepair + $workProgress + $workEnd + $workOffEnd + $workCancel;
        $countCustomer = Customer::where('company_id', Auth::user()->company_id)->count();
        $countProduct = Product::where('company_id', Auth::user()->company_id)->count();


        $yearNow = Carbon::now()->format('Y');
        $monthNow = Carbon::now()->format('m');

        //สินค้าขายดี
        $bestProducts = WorkDetail::selectRaw('SUM(total_amount) as sum_total, SUM(qty) as sum_qty , product_id')->with('product')->where('company_id', Auth::user()->company_id)
            ->whereHas('work', function ($query) use ($monthNow, $yearNow) {
                $query->whereMonth('doc_date', $monthNow)->whereYear('doc_date', $yearNow);
            })
             ->groupBy('product_id')->orderBy('sum_total', 'DESC')->limit(3)->get();

        //งานนัดส่งวันนี้
        $workTodayAppointments = Work::where('company_id', Auth::user()->company_id)->with('customer')->whereDate('appointment_date', Carbon::now())->orderBy('appointment_date',  'asc')->get();


        //รายได้วันนี้
        $revenueToday = WorkEnd::where('company_id', Auth::user()->company_id)
            ->whereHas('work', function ($query) {
                $query->whereDate('doc_date', Carbon::now());
            })->sum('total_amount');


        //รายได้เดือนนี้
        $revenueMonth = WorkEnd::where('company_id', Auth::user()->company_id)
            ->whereHas('work', function ($query) use ($yearNow, $monthNow) {
                $query->whereMonth('doc_date', $monthNow)->whereYear('doc_date', $yearNow);
            })->sum('total_amount');


        //รายปีนี้
        $revenueYear = WorkEnd::where('company_id', Auth::user()->company_id)
            ->whereHas('work', function ($query) use ($yearNow) {
                $query->whereYear('doc_date', $yearNow);
            })->sum('total_amount');

        $revenues = [
            'revenueToday' => $revenueToday,
            'revenueMonth' => $revenueMonth,
            'revenueYear' => $revenueYear
        ];


        return view('agents.dashboard-saas', compact('currentPackage', 'workWaitRepair', 'workProgress', 'workEnd', 'workOffEnd', 'workCancel', 'countWork', 'countCustomer', 'countProduct', 'revenues', 'bestProducts', 'workTodayAppointments'));
    }
}
