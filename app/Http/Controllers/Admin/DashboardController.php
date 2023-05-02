<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StoreClear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function index()
    {

        $listF1 = StoreClear::where('is_active',1)->where('status_id',1)->get();
        $listIdF1 = StoreClear::where('is_active',1)->where('status_id',1)->get();

        $listF2 = StoreClear::where('is_active',1)->where('status_id',2)->get();
        $listIdF2 = StoreClear::where('is_active',1)->where('status_id',2)->get();

        $listF3 = StoreClear::where('is_active',1)->where('status_id',3)->get();
        $listIdF3 = StoreClear::where('is_active',1)->where('status_id',3)->get();

        $countV1 = StoreClear::where('is_active',1)->where('company_id',1)->sum('total_amount');
        $online1 = StoreClear::where('is_active',1)->where('company_id',1)->count('customer_id');
        $countV1_1 = StoreClear::where('is_active',1)->where('company_id',1)->sum('amount1');
        $countV1_2 = StoreClear::where('is_active',1)->where('company_id',1)->sum('amount2');
        $countV1_3 = StoreClear::where('is_active',1)->where('company_id',1)->sum('amount3');

        $countV2 = StoreClear::where('is_active',1)->where('company_id',2)->sum('total_amount');
        $online2 = StoreClear::where('is_active',1)->where('company_id',2)->count('customer_id');
        $countV2_1 = StoreClear::where('is_active',1)->where('company_id',2)->sum('amount1');
        $countV2_2 = StoreClear::where('is_active',1)->where('company_id',2)->sum('amount2');
        $countV2_3 = StoreClear::where('is_active',1)->where('company_id',2)->sum('amount3');

        return view('admins.balances.index', compact('listF1','listIdF1','listF2','listIdF2','listF3','listIdF3',
        'countV1','countV2','countV1_1','countV1_2','countV1_3','countV2_1','countV2_2','countV2_3','online1','online2'));
    }


}
