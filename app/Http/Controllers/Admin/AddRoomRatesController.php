<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomRates;
use App\Models\ListPaymentDetail;
use App\Models\Company;
use App\Models\Floor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddRoomRatesController extends Controller
{
    public function index()
    {
        $company = Company::where('is_active', 1)->get();

        return view('admins.room-rates.index', compact('company'));
    }

    public function list(Request $req)
    {
        $fillter_company = ListPayment::with('company');

        if ($req->filter_company_id != 'all') {
            $fillter_company->where('company_id', $req->filter_company_id);
        }
        $fillter_company->get();
        return datatables()->of($fillter_company->get())->toJson();
        // return datatables()->of(
        //     ListPaymentDetail::query()->with('company','listPayment'))->toJson();
    }

    public function store(Request $req)
    {
        try {
            DB::beginTransaction();
            $room_rate = new RoomRates;
            $room_rate->room_rate = $req->room_rate;
            $room_rate->save();

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
            $room_rate = RoomRates::find($req->id);
            $room_rate->room_rate = $req->room_rate;
            // $detail->floor_id = $req->floor_id;
            // $detail->code = $req->code;
            $room_rate->save();

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
            $room_rate = RoomRates::find($req->id);

            $oldStatus = $room_rate->is_active;

            if ($oldStatus == 1) {
                $status = 0;
            } else {
                $status = 1;
            }
            $room_rate->is_active = $status;
            $room_rate->save();

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
            $room_rate = RoomRates::where('id', $req->id)->first();

            if (!$room_rate) {
                $data = [
                    'title' => 'ไม่สำเร็จ!',
                    'msg' => 'ไม่พบค่าห้อง',
                    'status' => 'success',
                ];

                return $data;
            }
            $room_rate->is_active = 0;
            $room_rate->save();

            $room_rate->delete();

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