<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerAddController extends Controller
{
    public function index()
    {
        $status = Status::where('is_active',1)->get();
        return view('admins.customers.index' , compact('status'));
    }
    public function listF1()
    {
        return datatables()->of(
            Customer::query()->with('statusList:id,name')->where('status_id',1)
        )->toJson();
    }

    public function listF2()
    {
        return datatables()->of(
            Customer::query()->with('statusList:id,name')->where('status_id',2)
        )->toJson();
    }

    public function listF3()
    {
        return datatables()->of(
            Customer::query()->with('statusList:id,name')->where('status_id',3)
        )->toJson();
    }

    public function store(Request $req)
    {
        DB::beginTransaction();
            $detail = new Customer;
            $detail->name = $req->name;
            $detail->status_id = $req->status_id;
            $detail->code = $req->code;
            $detail->save();

        DB::commit();
            
        $data = [
            'title' => 'Success!',
            'msg' => 'เพิ่มเมมเบอร์สำเร็จ',
            'status' => 'success',
        ];
    
        return $data;
    }

    public function update(Request $req)
    {
        $id = $req->id;
        $detail = Customer::find($id);

        DB::beginTransaction();

        $detail->name = $req->name;
        $detail->status_id = $req->status_id;
        $detail->code = $req->code;
        $detail->save();

        DB::commit();

        $data = [
            'title' => 'แก้ไขสำเร็จ!',
            'msg' => 'แก้ไขข้อมูลเมมเบอร์สำเร็จ',
            'status' => 'success',
        ];
        return $data;
    }

    public function setActive(Request $req)
    {
        $id = $req->id;

        DB::beginTransaction();

        $status = 0;
        $userS = Customer::find($id);

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

    public function destroy(Request $req)
    {
        try {
            $id = $req->id;

            DB::beginTransaction();
            $cus = Customer::where('id', $id)->first();

            if (!$cus) {
                $data = [
                    'title' => 'ไม่สำเร็จ!',
                    'msg' => 'ไม่พบลูกค้า',
                    'status' => 'success',
                ];

                return $data;
            }

            $cus->delete();

            DB::commit();

            $data = [
                'title' => 'สำเร็จ!',
                'msg' => 'ลบลูกค้าสำเร็จ',
                'status' => 'success',
            ];

            return $data;
        } catch (\Exception $e) {
            $sMessageGroup['text'] = "** Error **" .
                "\nError: " . $e->getMessage();

                // $this->telegramNotifyGroup($sMessageGroup);

            $data = [
                'title' => 'ผิดพลาด',
                'msg' => 'กรุณาติดต่อผู้พัฒนา',
                'status' => 'error',
            ];
            return $data;
        }
    }
}