<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Floor;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddFloorController extends Controller
{
    public function index()
    {
        $company = Company::where('is_active', 1)->get();

        return view('admins.room-floor.index', compact('company'));
    }
    public function list(Request $req)
    {
        $fillter_company = Floor::with('company');

        if ($req->filter_company_id != 'all') {
            $fillter_company->where('company_id', $req->filter_company_id);
        }
        $fillter_company->get();
        return datatables()->of($fillter_company->get())->toJson();
    }

    public function store(Request $req)
    {
        try {
            DB::beginTransaction();
            $floors = new Floor;
            $floors->name = $req->floor_number;
            $floors->company_id = $req->company_id;
            $floors->save();

            DB::commit();

            $data = [
                'title' => 'Success!',
                'msg' => 'เพิ่มสำเร็จ',
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
            $floors = Floor::find($req->id);
            $floors->name = $req->floor_number;
            $floors->company_id = $req->company_id;
            $floors->save();

            DB::commit();

            $data = [
                'title' => 'แก้ไขสำเร็จ!',
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

    public function setActive(Request $req)
    {
        try {
            DB::beginTransaction();

            $status = 0;
            $floors = Floor::find($req->id);

            $oldStatus = $floors->is_active;

            if ($oldStatus == 1) {
                $status = 0;
            } else {
                $status = 1;
            }
            $floors->is_active = $status;
            $floors->save();

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
            $floors = Floor::where('id', $req->id)->first();

            if (!$floors) {
                $data = [
                    'title' => 'ไม่สำเร็จ!',
                    'msg' => 'ไม่พบข้อมูล',
                    'status' => 'success',
                ];

                return $data;
            }
            $floors->is_active = 0;
            $floors->save();

            $floors->delete();

            DB::commit();

            $data = [
                'title' => 'สำเร็จ!',
                'msg' => 'ลบห้องสำเร็จ',
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
