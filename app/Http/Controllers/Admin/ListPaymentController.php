<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\ListPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListPaymentController extends Controller
{
    public function index()
    {
        $company = Company::where('is_active', 1)->get();

        return view('admins.list-payment.index', compact('company'));
    }
    public function list(Request $req)
    {
        $fillter_company = ListPayment::with('company');

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
            $list_pay = new ListPayment;
            $list_pay->name = $req->name;
            $list_pay->company_id = $req->company_id;
            $list_pay->save();

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
            $list_pay = ListPayment::find($req->id);
            $list_pay->name = $req->name;
            $list_pay->company_id = $req->company_id;
            $list_pay->save();

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

    public function setActive(Request $req)
    {
        try {
            DB::beginTransaction();

            $status = 0;
            $list_pay = ListPayment::find($req->id);

            $oldStatus = $list_pay->is_active;

            if ($oldStatus == 1) {
                $status = 0;
            } else {
                $status = 1;
            }
            $list_pay->is_active = $status;
            $list_pay->save();

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
            $list_pay = ListPayment::where('id', $req->id)->first();

            if (!$list_pay) {
                $data = [
                    'title' => 'ไม่สำเร็จ!',
                    'msg' => 'ไม่พบข้อมูล',
                    'status' => 'success',
                ];

                return $data;
            }
            $list_pay->is_active = 0;
            $list_pay->save();

            $list_pay->delete();

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

            $this->telegramNotifyGroup($sMessageGroup);
        }
    }
}
