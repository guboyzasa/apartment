<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Vendor;
use App\Models\Company;
use App\Models\Status;
use App\Models\StoreClear;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function index()
    {
        $cusOne = Customer::where('status_id',1)->where('is_active',1)->get();
        $cusTwo = Customer::where('status_id',2)->where('is_active',1)->get();
        $cusTree = Customer::where('status_id',3)->where('is_active',1)->get();

        $status = Status::where('is_active',1)->get();
        $company = Company::where('is_active',1)->get();

        return view('admins.stores.index' , compact('cusOne','cusTwo','company','status','cusTree'));
    }

    public function listF1()
    {
        return datatables()->of(
            StoreClear::query()->with('customer:id,name,code','company:id,name')->where('status_id',1)->OrderBy('is_active','desc')
        )->toJson();
    }

    public function listF2()
    {
        return datatables()->of(
            StoreClear::query()->with('customer:id,name,code','company:id,name')->where('status_id',2)->OrderBy('is_active','desc')
        )->toJson();
    }

    public function listF3()
    {
        return datatables()->of(
            StoreClear::query()->with('customer:id,name,code','company:id,name')->where('status_id',3)->OrderBy('is_active','desc')
        )->toJson();
    }

    public function printDoc1()
    {
        $listF1 = StoreClear::with('company:id,name,address,address2,phone')->where('is_active',1)->where('status_id',1)->get();
        $listIdF1 = StoreClear::with('company:id,name,address,address2,phone')->where('is_active',1)->where('status_id',1)->get();

        return view('admins.stores.view-make.print-doc1' , compact('listF1','listIdF1'));
    }

    public function printDoc2()
    {
        $listF2 = StoreClear::where('is_active',1)->where('status_id',2)->get();
        $listIdF2 = StoreClear::where('is_active',1)->where('status_id',2)->get();

        return view('admins.stores.view-make.print-doc2' , compact('listF2','listIdF2'));
    }

    public function printDoc3()
    {
        $listF3 = StoreClear::where('is_active',1)->where('status_id',3)->get();
        $listIdF3 = StoreClear::where('is_active',1)->where('status_id',3)->get();

        return view('admins.stores.view-make.print-doc3' , compact('listF3','listIdF3'));
    }

    public function print1()
    {
        $listF1 = StoreClear::where('is_active',1)->where('status_id',1)->get();
        $listIdF1 = StoreClear::where('is_active',1)->where('status_id',1)->get();

        return view('admins.stores.prints.doc1' , compact('listF1','listIdF1'));
    }

    public function print2()
    {
        $listF2 = StoreClear::where('is_active',1)->where('status_id',2)->get();
        $listIdF2 = StoreClear::where('is_active',1)->where('status_id',2)->get();

        return view('admins.stores.prints.doc2' , compact('listF2','listIdF2'));
    }

    public function print3()
    {
        $listF3 = StoreClear::where('is_active',1)->where('status_id',3)->get();
        $listIdF3 = StoreClear::where('is_active',1)->where('status_id',3)->get();

        return view('admins.stores.prints.doc3' , compact('listF3','listIdF3'));
    }

    public function store(Request $req)
    {
        // return $req->all();
        DB::beginTransaction();
            $detail = new StoreClear;
            $detail->customer_id = $req->name_id;
            $detail->company_id = $req->company_id;
            $detail->status_id = $req->status_id;
        //รายการ
            $detail->list1 = $req->list1;
            $detail->list2 = $req->list2;
            $detail->list3 = $req->list3;
            $detail->list6 = $req->list6;
        //ราคา/หน่วย
            $detail->price_unit1 = $req->price_unit1;
            $detail->price_unit2 = $req->price_unit2;
            $detail->price_unit3 = $req->price_unit3;
            $detail->price_unit6 = $req->price_unit6;
        //ค่าไฟ
            $detail->unit_befor2 = $req->unit_befor2;
            $detail->unit_befor3 = $req->unit_befor3;
        //ค่าน้ำ
            $detail->unit_after2 = $req->unit_after2;
            $detail->unit_after3 = $req->unit_after3;

            $detail->amount1 = $req->price_unit1;
        //ค่าไฟ
            if(($req->price_unit2 * ($req->unit_after2 - $req->unit_befor2)) <= 120){
                $detail->amount2 = 120;
                $sum1 = 120;
            }else{
                $detail->amount2 = ($req->price_unit2 * ($req->unit_after2 - $req->unit_befor2));
                $sum1 = ($req->price_unit2 * ($req->unit_after2 - $req->unit_befor2));
            }
        //ค่าน้ำ
            if(($req->price_unit3 * ($req->unit_after3 - $req->unit_befor3)) <= 100){
                $detail->amount3 = 100;
                $sum2 = 100;
            }else{
                $detail->amount3 = ($req->price_unit3 * ($req->unit_after3 - $req->unit_befor3));
                $sum2 = ($req->price_unit3 * ($req->unit_after3 - $req->unit_befor3));
            }
            
            $detail->amount6 = $req->price_unit6;

            $detail->total_amount = $req->price_unit1 + $sum1 + $sum2 + $req->price_unit6;

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
        $detail = StoreClear::find($id);

        DB::beginTransaction();
            $detail->customer_id = $req->name_id;
            $detail->company_id = $req->company_id;
            $detail->status_id = $req->status_id;

            $detail->list1 = $req->list1;
            $detail->list2 = $req->list2;
            $detail->list3 = $req->list3;
            $detail->list6 = $req->list6;

            $detail->price_unit1 = $req->price_unit1;
            $detail->price_unit2 = $req->price_unit2;
            $detail->price_unit3 = $req->price_unit3;
            $detail->price_unit6 = $req->price_unit6;

            $detail->unit_befor2 = $req->unit_befor2;
            $detail->unit_befor3 = $req->unit_befor3;

            $detail->unit_after2 = $req->unit_after2;
            $detail->unit_after3 = $req->unit_after3;

            $detail->amount1 = $req->price_unit1;
            
            if(($req->price_unit2 * ($req->unit_after2 - $req->unit_befor2)) <= 120){
                $detail->amount2 = 120;
                $sum1 = 120;
            }else{
                $detail->amount2 = ($req->price_unit2 * ($req->unit_after2 - $req->unit_befor2));
                $sum1 = ($req->price_unit2 * ($req->unit_after2 - $req->unit_befor2));
            }

            if(($req->price_unit3 * ($req->unit_after3 - $req->unit_befor3)) <= 100){
                $detail->amount3 = 100;
                $sum2 = 100;
            }else{
                $detail->amount3 = ($req->price_unit3 * ($req->unit_after3 - $req->unit_befor3));
                $sum2 = ($req->price_unit3 * ($req->unit_after3 - $req->unit_befor3));
            }

            $detail->amount6 = $req->price_unit6;

            // $sum1 = ($req->price_unit2 * ($req->unit_after2 - $req->unit_befor2));
            // $sum2 = ($req->price_unit3 * ($req->unit_after3 - $req->unit_befor3));

            $detail->total_amount = $req->price_unit1 + $sum1 + $sum2 + $req->price_unit6;

            $detail->is_active = 1;

            $detail->save();

        DB::commit();
        
        $data = [
            'title' => 'Success!',
            'msg' => 'แก้ไขสำเร็จ',
            'status' => 'success',
        ];

        return $data;
    }

    public function destroy(Request $req)
    {
        $id = $req->id;

            DB::beginTransaction();
            $detail = StoreClear::where('id', $id)->first();
            
            if (!$detail) {
                $data = [
                    'title' => 'ไม่สำเร็จ!',
                    'msg' => 'ไม่พบ',
                    'status' => 'success',
                ];

                return $data;
            }

            $detail->is_active = 0;
            $detail->save();

            $detail->delete();

            DB::commit();

            $data = [
                'title' => 'สำเร็จ!',
                'msg' => 'ลบสำเร็จ',
                'status' => 'success',
            ];

            return $data;
    }

    public function setActive(Request $req)
    {
        $id = $req->id;

        DB::beginTransaction();

        $status = 0;
        $userS = StoreClear::find($id);

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
}
