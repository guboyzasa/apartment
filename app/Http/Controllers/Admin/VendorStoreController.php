<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Vendor;
use App\Models\StoreVendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorStoreController extends Controller
{
    public function index()
    {
        $room = Room::where('is_active',1)->get();
        return view('admins.store_vendor.index' , compact('room'));
    }

    public function list()
    {
    }

    public function store(Request $req)
    {  
    }

    public function update(Request $req)
    {  
    }

    public function destroy(Request $req)
    { 
    }

    public function setActive(Request $req)
    {
    }
}
