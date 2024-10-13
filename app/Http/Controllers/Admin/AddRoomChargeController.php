<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomCharge;
use App\Models\User;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddRoomChargeController extends Controller
{
    public function index()
    {
        $status = Status::where('is_active', 1)->get();

        return view('admins.room-charge.index', compact('status'));
    }

    public function list()
    {
        return datatables()->of(
            RoomCharge::query()->with('statusList:id,name'))->toJson();
    }

    public function store(Request $req)
    {
        try {
            DB::beginTransaction();
            $detail = new RoomCharge;
            $detail->name = $req->name;
            // $detail->status_id = $req->status_id;
            // $detail->code = $req->code;
            $detail->save();

            DB::commit();

            $data = [
                'title' => 'Success!',
                'msg' => 'เพิ่มค่าห้องสำเร็จ',
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
            $detail = RoomCharge::find($req->id);
            $detail->name = $req->name;
            // $detail->status_id = $req->status_id;
            // $detail->code = $req->code;
            $detail->save();

            DB::commit();

            $data = [
                'title' => 'แก้ไขสำเร็จ!',
                'msg' => 'แก้ไขค่าห้องสำเร็จ',
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
            $userS = RoomCharge::find($req->id);

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
            $cus = RoomCharge::where('id', $req->id)->first();

            if (!$cus) {
                $data = [
                    'title' => 'ไม่สำเร็จ!',
                    'msg' => 'ไม่พบค่าห้อง',
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
                'msg' => 'ลบค่าห้องสำเร็จ',
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