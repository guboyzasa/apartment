<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Floor;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddRoomController extends Controller
{
    public function index()
    {
        $floor = Floor::where('is_active', 1)->get();
        $company = Company::where('is_active', 1)->get();

        return view('admins.room.index', compact('floor', 'company'));
    }
    public function listF1(Request $req)
    {
        $fillter_company = Room::with('floor', 'company');

        if ($req->filter_company_id != 'all') {
            $fillter_company->where('company_id', $req->filter_company_id);
        }
        if ($req->filter_floor_id != 'all') {
            $fillter_company->where('floor_id', $req->filter_floor_id);
        }
        $fillter_company->get();

        return datatables()->of($fillter_company->get())->toJson();
        // return datatables()->of(
        //     Room::query()->with('floor', 'company'))->toJson();
    }

    public function getFloorsByCompany(Request $request)
    {
        $companyId = $request->input('company_id');
        $floors = Floor::where('company_id', $companyId)
            ->where('is_active', 1)
            ->get();

        return response()->json($floors);
    }

    public function store(Request $req)
    {
        try {
            DB::beginTransaction();
            $rooms = new Room;
            $rooms->room_number = $req->room_number;
            $rooms->floor_id = $req->floor_id;
            $rooms->company_id = $req->company_id;
            $rooms->save();

            DB::commit();

            $data = [
                'title' => 'Success!',
                'msg' => 'เพิ่มห้องสำเร็จ',
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
            $rooms = Room::find($req->id);
            $rooms->room_number = $req->room_number;
            $rooms->floor_id = $req->floor_id;
            $rooms->company_id = $req->company_id;
            $rooms->save();

            DB::commit();

            $data = [
                'title' => 'แก้ไขสำเร็จ!',
                'msg' => 'แก้ไขห้องสำเร็จ',
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
            $rooms = Room::find($req->id);

            $oldStatus = $rooms->is_active;

            if ($oldStatus == 1) {
                $status = 0;
            } else {
                $status = 1;
            }
            $rooms->is_active = $status;
            $rooms->save();

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
            $rooms = Room::where('id', $req->id)->first();

            if (!$rooms) {
                $data = [
                    'title' => 'ไม่สำเร็จ!',
                    'msg' => 'ไม่พบห้อง',
                    'status' => 'success',
                ];

                return $data;
            }
            $rooms->is_active = 0;
            $rooms->save();

            $rooms->delete();

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
