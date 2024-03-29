<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\User;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddRoomController extends Controller
{
    public function index()
    {
        $status = Status::where('is_active', 1)->get();
        return view('admins.room.index', compact('status'));
    }
    public function listF1()
    {
        return datatables()->of(
            Room::query()->with('statusList:id,name')->where('status_id', 1)
        )->toJson();
    }

    public function listF2()
    {
        return datatables()->of(
            Room::query()->with('statusList:id,name')->where('status_id', 2)
        )->toJson();
    }

    public function listF3()
    {
        return datatables()->of(
            Room::query()->with('statusList:id,name')->where('status_id', 3)
        )->toJson();
    }

    public function store(Request $req)
    {
        try {
            DB::beginTransaction();
            $detail = new Room;
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
        } catch (\Exception $e) {
            $sMessageGroup['text'] = "** Error **" .
                "\nError: " . $e->getMessage();

            $this->telegramNotifyGroup($sMessageGroup);
        }
    }

    public function update(Request $req)
    {
        try {

            DB::beginTransaction();
            $detail = Room::find($req->id);
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
        } catch (\Exception $e) {
            $sMessageGroup['text'] = "** Error **" .
                "\nError: " . $e->getMessage();

            $this->telegramNotifyGroup($sMessageGroup);
        }
    }

    public function setActive(Request $req)
    {
        try {
            DB::beginTransaction();

            $status = 0;
            $userS = Room::find($req->id);

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
        } catch (\Exception $e) {
            $sMessageGroup['text'] = "** Error **" .
                "\nError: " . $e->getMessage();

            $this->telegramNotifyGroup($sMessageGroup);
        }
    }

    public function destroy(Request $req)
    {
        try {
            DB::beginTransaction();
            $cus = Room::where('id', $req->id)->first();

            if (!$cus) {
                $data = [
                    'title' => 'ไม่สำเร็จ!',
                    'msg' => 'ไม่พบลูกค้า',
                    'status' => 'success',
                ];

                return $data;
            }
            $cus->is_active = 0;
            $cus->save();

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

            $this->telegramNotifyGroup($sMessageGroup);
        }
    }
}