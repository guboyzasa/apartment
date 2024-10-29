<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Condition;
use App\Models\User;
use App\Models\Floor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConditionController extends Controller
{
    public function index()
    {
        $floor = Floor::where('is_active', 1)->get();

        return view('admins.condition.index', compact('floor'));
    }

    public function list()
    {
        return datatables()->of(
            Condition::query()->OrderBy('created_at', 'desc'))->toJson();
    }

    public function store(Request $req)
    {
        try {
            DB::beginTransaction();
            $condition = new Condition;
            $condition->point = $req->point;
            $condition->info = $req->info;
            $condition->save();

            DB::commit();

            $data = [
                'title' => 'Success!',
                'msg' => 'เพิ่มเงื่อนไขสำเร็จ',
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
            $condition = Condition::find($req->id);
            $condition->point = $req->point;
            $condition->info = $req->info;
            $condition->save();
            DB::commit();

            $data = [
                'title' => 'แก้ไขสำเร็จ!',
                'msg' => 'แก้ไขเงื่อนไขสำเร็จ',
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
            $conditon = Condition::find($req->id);

            $oldStatus = $conditon->is_active;

            if ($oldStatus == 1) {
                $status = 0;
            } else {
                $status = 1;
            }
            $conditon->is_active = $status;
            $conditon->save();

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
            $conditon = Condition::where('id', $req->id)->first();

            if (!$conditon) {
                $data = [
                    'title' => 'ไม่สำเร็จ!',
                    'msg' => 'ไม่พบค่าห้อง',
                    'status' => 'success',
                ];

                return $data;
            }
            $conditon->is_active = 0;
            $conditon->save();

            $conditon->delete();

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