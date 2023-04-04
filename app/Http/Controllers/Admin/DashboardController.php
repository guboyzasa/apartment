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
        $storeV1 = StoreClear::with('customer:id,name')->where('youtube_id',1)->OrderBy('is_active','desc')->get();
        $storeV2 = StoreClear::with('customer:id,name')->where('youtube_id',2)->OrderBy('is_active','desc')->get();
        $countV1 = StoreClear::where('youtube_id',1)->OrderBy('is_active','desc')->count('is_active');
        $countV2 = StoreClear::where('youtube_id',2)->OrderBy('is_active','desc')->count('is_active');

        return view('admins.balances.index' , compact('storeV1','storeV2','countV1','countV2'));
    }


}
