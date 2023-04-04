<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StoreClear;
use App\Models\StoreVendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BalanceController extends Controller
{
    public function index(Request $req)
    {
        $store = StoreClear::where('is_active', 1)->get();
        $storeVendor = StoreVendor::where('is_active', 1)->get();

        return view('admins.balances.index', compact('store','storeVendor'));
    }
    
}