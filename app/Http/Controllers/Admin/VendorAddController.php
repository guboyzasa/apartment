<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VendorAddController extends Controller
{
    public function index()
    {
        return view('admins.vendors.index');
    }
    public function list()
    {
        return datatables()->of(
            Vendor::query()->orderBy('id', 'asc')
        )->toJson();
    }

    public function store(Request $req)
    {
        DB::beginTransaction();
            $detail = new Vendor;
            $detail->name = $req->name;
            $detail->code = $req->code;
            $detail->is_active = 1;
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
        $detail = Vendor::find($id);

        DB::beginTransaction();

        $detail->name = $req->name;
        $detail->code = $req->code;
        $detail->save();

        DB::commit();

        $data = [
            'title' => 'แก้ไขสำเร็จ!',
            'msg' => 'แก้ไขข้อมูลสำเร็จ',
            'status' => 'success',
        ];
        return $data;
    }

    public function setActive(Request $req)
    {
        $id = $req->id;

        DB::beginTransaction();

        $status = 0;
        $userS = Vendor::find($id);

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
            $cus = Vendor::where('id', $id)->first();

            if (!$cus) {
                $data = [
                    'title' => 'ไม่สำเร็จ!',
                    'msg' => 'ไม่พบ',
                    'status' => 'success',
                ];

                return $data;
            }

            $cus->delete();

            DB::commit();

            $data = [
                'title' => 'สำเร็จ!',
                'msg' => 'ลบสำเร็จ',
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