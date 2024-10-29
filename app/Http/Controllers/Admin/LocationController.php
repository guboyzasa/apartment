<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Floor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    public function index()
    {
        $floor = Floor::where('is_active', 1)->get();

        return view('admins.location.index', compact('floor'));
    }

    public function list()
    {
        return datatables()->of(
            Company::withCount(['floors' => fn($query) => $query->where('is_active', 1)])
        )->toJson();
    }
    public function store(Request $req)
    {
        try {
            DB::beginTransaction();
            $company = new Company;
            $company->name = $req->name;
            $company->name_owner = $req->owner;
            $company->address = $req->address;
            $company->address2 = $req->address2;
            $company->phone = $req->phone;
            // $company->floor_number = $req->floor_number;

            $company->save();

            DB::commit();

            $data = [
                'title' => 'Success!',
                'msg' => 'เพิ่มสถานที่ตั้งสำเร็จ',
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
            $company = Company::find($req->id);
            $company->name = $req->name;
            $company->name_owner = $req->owner;
            $company->address = $req->address;
            $company->address2 = $req->address2;
            $company->phone = $req->phone;
            // $company->floor_number = $req->floor_number;

            $company->save();

            DB::commit();

            $data = [
                'title' => 'แก้ไขสำเร็จ!',
                'msg' => 'แก้ไขสถานที่ตั้งสำเร็จ',
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
            $company = Company::find($req->id);

            $oldStatus = $company->is_active;

            if ($oldStatus == 1) {
                $status = 0;
            } else {
                $status = 1;
            }
            $company->is_active = $status;
            $company->save();

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
            $company = Company::where('id', $req->id)->first();

            if (!$company) {
                $data = [
                    'title' => 'ไม่สำเร็จ!',
                    'msg' => 'ไม่พบค่าห้อง',
                    'status' => 'success',
                ];

                return $data;
            }
            $company->is_active = 0;
            $company->save();

            $company->delete();

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
