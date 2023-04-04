<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Vendor;
use App\Models\StoreVendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorStoreController extends Controller
{
    public function index()
    {
        $customer = Customer::where('is_active',1)->get();
        $vendor = Vendor::where('is_active',1)->get();
        return view('admins.store_vendor.index' , compact('customer','vendor'));
    }

    public function list()
    {
        return datatables()->of(
            StoreVendor::query()->with('vendor:id,name,code')->orderBy('is_active', 'desc')
        )->toJson();
    }

    public function store(Request $req)
    {
        DB::beginTransaction();
            $detail = new StoreVendor;
            $detail->vendor_id = $req->vendor;
        //siam
            $detail->siam_total = ($req->sm_lot);
        //88lot
            $detail->pp_total = ($req->pp_lot);
        //agnew
            $detail->ag_total = ($req->ag_lot);
        //keysuper
            $detail->ks_total = ($req->ks_lot);
        //super99
            $detail->sp_total = ($req->sp_lot);
        //other
            $detail->other_total = ($req->ot_lot);
        //all_total
            $detail->all_total = ($req->sm_lot) + ($req->pp_lot) + ($req->ag_lot) + ($req->ks_lot) + ($req->sp_lot) + ($req->ot_lot);

            $detail->save();

        DB::commit();
        
        $data = [
            'title' => 'Success!',
            'msg' => 'เพิ่มสำเร็จ',
            'status' => 'success',
        ];

        return $data;
    }

    public function update(Request $req)
    {
        $id = $req->id;
        $detail = StoreVendor::find($id);
        DB::beginTransaction();
        $detail->vendor_id = $req->vendor;
        //siam
            $detail->siam_total = ($req->sm_lot);
        //88lot
            $detail->pp_total = ($req->pp_lot);
        //agnew
            $detail->ag_total = ($req->ag_lot);
        //keysuper
            $detail->ks_total = ($req->ks_lot);
        //super99
            $detail->sp_total = ($req->sp_lot);
        //other
            $detail->other_total = ($req->ot_lot);

        //all_total
            $detail->all_total = ($req->sm_lot) + ($req->pp_lot) + ($req->ag_lot) + ($req->ks_lot) + ($req->sp_lot) + ($req->ot_lot);

            $detail->save();

        DB::commit();
        
        $data = [
            'title' => 'Success!',
            'msg' => 'แก้ไขสำเร็จ',
            'status' => 'success',
        ];

        return $data;
    }

    public function destroy(Request $req)
    {
        $id = $req->id;

            DB::beginTransaction();
            $detail = StoreVendor::where('id', $id)->first();

            if (!$detail) {
                $data = [
                    'title' => 'ไม่สำเร็จ!',
                    'msg' => 'ไม่พบ',
                    'status' => 'success',
                ];

                return $data;
            }

            $detail->delete();

            DB::commit();

            $data = [
                'title' => 'สำเร็จ!',
                'msg' => 'ลบสำเร็จ',
                'status' => 'success',
            ];

            return $data;
    }

    public function setActive(Request $req)
    {
        $id = $req->id;

        DB::beginTransaction();

        $status = 0;
        $userS = StoreVendor::find($id);

        $oldStatus = $userS->is_active;

        if ($oldStatus == 1) {
            $status = 0;
        } else {
            $status = 1;
        }
        $userS->is_active = $status;
        $userS->save();

        DB::commit();

        $data = [
            'title' => 'สำเร็จ!',
            'msg' => 'แก้ไขสำเร็จ',
            'status' => 'success',
        ];

        return $data;
    }
}
