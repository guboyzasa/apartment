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

        return view('admins.balances.index', compact('listF1','listIdF1','listF2','listIdF2','listF3','listIdF3'));
    }


}
