<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Customer;
use App\Models\Company;
use App\Models\Condition;
use App\Models\User;
use App\Models\Floor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index()
    {
        $company = Company::where('is_active',1)->get();
        $condition = Condition::All();

        return view('admins.con-customer.index', compact('company', 'condition'));
    }

    public function getFloor(Request $req)
    {
        $floors = Floor::where('company_id', $req->company_id)->get();
        return response()->json($floors); // ส่งข้อมูลกลับเป็น JSON
    }

    public function getRoom(Request $req)
    {
        $rooms = Room::where('company_id', $req->company_id)
                     ->where('floor_id', $req->floor_id) // กรองด้วย floor_id
                     ->get();
        return response()->json($rooms); // ส่งข้อมูลกลับเป็น JSON
    }

    public function list(Request $req)
    {
        $fillter_company = Customer::with('company');

        if ($req->filter_company_id != 'all') {
            $fillter_company->where('company_id', $req->filter_company_id);
        }
        if ($req->filter_floor_id != 'all') {
            $fillter_company->where('floor_id', $req->filter_floor_id);
        }
        $fillter_company->get();

        return datatables()->of($fillter_company->get())->toJson();
        // return datatables()->of(
        //     Customer::query()->with('company')->OrderBy('created_at', 'desc'))->toJson();
    }

    // public function update(Request $req)
    // {
    //     try {

    //         DB::beginTransaction();
    //         $condition = Condition::find($req->id);
    //         $condition->point = $req->point;
    //         $condition->info = $req->info;
    //         $condition->save();
    //         DB::commit();

    //         $data = [
    //             'title' => 'แก้ไขสำเร็จ!',
    //             'msg' => 'แก้ไขเงื่อนไขสำเร็จ',
    //             'status' => 'success',
    //         ];
    //         return $data;
    //     } catch (\Exception $e) {
    //         $sMessageGroup['text'] = "** Error **" .
    //             "\nError: " . $e->getMessage();

    //         $this->telegramNotifyGroup($sMessageGroup);
    //     }
    // }

    public function setActive(Request $req)
    {
        try {
            DB::beginTransaction();

            $status = 0;
            $customer = Customer::find($req->id);

            $oldStatus = $customer->is_active;

            if ($oldStatus == 1) {
                $status = 0;
            } else {
                $status = 1;
            }
            $customer->is_active = $status;
            $customer->save();

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

}