<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Floor;
use App\Models\ListPayment;
use App\Models\Room;
use App\Models\StoreClear;
use App\Models\StoreClearDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function index()
    {
        $company = Company::where('is_active', 1)->get();
        // $room_rate = RoomRates::where('is_active', 1)->get();

        return view('admins.stores.index', compact('company'));
    }

    public function getFloors(Request $request)
    {
        $floors = Floor::where('company_id', $request->company_id)->where('is_active', 1)->get(['id', 'name']);
        return response()->json($floors);
    }

    public function getRooms(Request $req)
    {
        $room_floor = Customer::where('company_id', $req->company_id)->where('floor_id', $req->floor_id)->where('is_active', 1)->get();
        return response()->json($room_floor); // ส่งข้อมูลกลับเป็น JSON
    }

    public function getRoom(Request $req)
    {
        $room_floor = Customer::where('company_id', $req->company_id)->where('floor_id', $req->floor_id)->get();
        return response()->json($room_floor); // ส่งข้อมูลกลับเป็น JSON
    }

    public function getStore(Request $req)
    {
        $datas = [];
        $store_clear_details = null;
        $get_storeClear = StoreClear::where('room_id', $req->room_id)->where('company_id', $req->company_id)->orderBy('created_at', 'desc')->first();

        // $company = Company::find($req->company_id);
        $list_payments = ListPayment::with('listPaymentDetails', 'lastStoreClearDetail')
            ->with(['lastStoreClearDetail.storeClear' => function ($q) use ($req) {
                $q->where('room_id', $req->room_id)->where('company_id', $req->company_id)->orderBy('created_at', 'desc');
            }])
        // ->whereHas('lastStoreClearDetail.storeClear' , function ( $query)  use($req){
        //     $query->where('room_id', $req->room_id)->where('company_id', $req->company_id)->orderBy('created_at', 'desc');
        //     })
            ->where('company_id', $req->company_id)->get();

        if ($get_storeClear) {
            $store_clear_details = StoreClearDetail::with('listPayment')->where('store_clear_id', $get_storeClear->id)->get();
        }

        $datas = [
            'list_payments' => $list_payments,
            'store_clear_details' => $store_clear_details,
        ];
        return $datas;
    }

    public function listF1(Request $req)
    {
        $fillter_company = StoreClear::with('room', 'company', 'customer');

        if ($req->filter_company_id != 'all') {
            $fillter_company->where('company_id', $req->filter_company_id);
        }
        if ($req->filter_floor_id != 'all') {
            $fillter_company->where('floor_id', $req->filter_floor_id);
        }
        $fillter_company->get();

        return datatables()->of($fillter_company->get())->toJson();
    }

    public function printDoc1()
    {
        $listF1 = StoreClear::with('company')->where('is_active', 1)->where('floor_id', 1)->get();
        $listIdF1 = StoreClear::with('company')->where('is_active', 1)->where('floor_id', 1)->get();

        return view('admins.stores.view-make.print-doc1', compact('listF1', 'listIdF1'));
    }

    public function printDoc2()
    {
        $listF2 = StoreClear::where('is_active', 1)->where('floor_id', 2)->get();
        $listIdF2 = StoreClear::where('is_active', 1)->where('floor_id', 2)->get();

        return view('admins.stores.view-make.print-doc2', compact('listF2', 'listIdF2'));
    }

    public function printDoc3()
    {
        $listF3 = StoreClear::where('is_active', 1)->where('floor_id', 3)->get();
        $listIdF3 = StoreClear::where('is_active', 1)->where('floor_id', 3)->get();

        return view('admins.stores.view-make.print-doc3', compact('listF3', 'listIdF3'));
    }

    public function print1()
    {
        $listF1 = StoreClear::where('is_active', 1)->where('floor_id', 1)->get();
        $listIdF1 = StoreClear::where('is_active', 1)->where('floor_id', 1)->get();

        return view('admins.stores.prints.doc1', compact('listF1', 'listIdF1'));
    }

    public function print2()
    {
        $listF2 = StoreClear::where('is_active', 1)->where('floor_id', 2)->get();
        $listIdF2 = StoreClear::where('is_active', 1)->where('floor_id', 2)->get();

        return view('admins.stores.prints.doc2', compact('listF2', 'listIdF2'));
    }

    public function print3()
    {
        $listF3 = StoreClear::where('is_active', 1)->where('floor_id', 3)->get();
        $listIdF3 = StoreClear::where('is_active', 1)->where('floor_id', 3)->get();

        return view('admins.stores.prints.doc3', compact('listF3', 'listIdF3'));
    }

    public function store(Request $req)
    {

        // return $req->all();
        DB::beginTransaction();

        $customers = Customer::where('room_id', $req->room_id_form)
            ->where('is_active', 1)
            ->first();

        $storeClear = new StoreClear;
        $storeClear->room_id = $customers->room_id;
        $storeClear->company_id = $customers->company_id;
        $storeClear->floor_id = $customers->floor_id;
        $storeClear->customer_id = $customers->id;
        $storeClear->billing_date = Carbon::now();
        $storeClear->save();

        foreach ($req->list_payment_id as $list_payment_id => $list_payments) {
            // ดึงข้อมูล ListPayment พร้อมกับราคาขั้นต่ำจากฐานข้อมูล
            $payment = ListPayment::find($list_payment_id);

            $storeClearDetail = new StoreClearDetail;
            $storeClearDetail->store_clear_id = $storeClear->id;
            $storeClearDetail->list_payment_id = $list_payment_id;
            $storeClearDetail->unit_before = @$req->unit_before[$list_payment_id];
            $storeClearDetail->unit_after = @$req->unit_after[$list_payment_id];
            $storeClearDetail->other_detail = @$req->other[$list_payment_id];

            // ตรวจสอบว่าเป็นรายการที่มีหน่วย และคำนวณราคา
            if ($payment->is_unit == 1 && @$req->unit_before[$list_payment_id] && @$req->unit_after[$list_payment_id]) {
                $quantity = @$req->unit_after[$list_payment_id]-@$req->unit_before[$list_payment_id];
                $price_per_unit = @$req->price_unit[$list_payment_id];
                $total_price = $quantity * $price_per_unit;

                // ใช้ราคาขั้นต่ำจากฐานข้อมูล (ถ้ามี)
                $min_price = $payment->min_price ?? 0;

                // ใช้ราคาขั้นต่ำถ้าราคาคำนวณได้น้อยกว่า
                $storeClearDetail->total_price = max($total_price, $min_price);
                $storeClearDetail->price_unit = $price_per_unit;
            } else {
                // กรณีไม่มีหน่วยหรือไม่ได้กรอกข้อมูล unit_before, unit_after
                $storeClearDetail->total_price = @$req->price_unit[$list_payment_id];
            }

            $storeClearDetail->save(); // บันทึกข้อมูลลงฐานข้อมูล
        }

        DB::commit();

        $data = [
            'title' => 'Success!',
            'msg' => 'เพิ่มสำเร็จ',
            'status' => 'success',
        ];

        return $data;

        // try {
        //     // $rooms = Customer::find($customers->room_id);
        //     // $floors = Floor::find($req->floor_id);

        //     DB::beginTransaction();
        //     $storeClear = new StoreClear;
        //     $storeClear->room_id = $req->room_id;
        //     $storeClear->company_id = $customers->company_id;
        //     $storeClear->floor_id = $customers->floor_id;
        //     $storeClear->customer_id = $customers->id;
        //     //รายการ
        //     $storeClear->list1 = $req->list1;
        //     $storeClear->list2 = $req->list2;
        //     $storeClear->list3 = $req->list3;
        //     $storeClear->list6 = $req->list6;
        //     $storeClear->list7 = $req->list7;
        //     //ราคา/หน่วย
        //     $storeClear->price_unit1 = $req->price_unit1;
        //     $storeClear->price_unit2 = $req->price_unit2;
        //     $storeClear->price_unit3 = $req->price_unit3;
        //     $storeClear->price_unit6 = $req->price_unit6 ?? 0;
        //     $storeClear->price_unit7 = $req->price_unit7;
        //     $storeClear->price_unit8 = $req->price_unit8 ?? 0;
        //     //ค่าไฟ
        //     $storeClear->unit_befor2 = $req->unit_befor2 ?? 0;
        //     $storeClear->unit_befor3 = $req->unit_befor3 ?? 0;
        //     //ค่าน้ำ
        //     $storeClear->unit_after2 = $req->unit_after2 ?? 0;
        //     $storeClear->unit_after3 = $req->unit_after3 ?? 0;
        //     //ค่าห้อง
        //     $storeClear->amount1 = $req->price_unit1;
        //     //ค่าไฟ
        //     if (($req->price_unit2 * ($req->unit_after2 - $req->unit_befor2)) <= 120) {
        //         $storeClear->amount2 = 120;
        //         $sum1 = 120;
        //     } else {
        //         $storeClear->amount2 = ($req->price_unit2 * ($req->unit_after2 - $req->unit_befor2));
        //         $sum1 = ($req->price_unit2 * ($req->unit_after2 - $req->unit_befor2));
        //     }
        //     //ค่าน้ำ
        //     if (($req->price_unit3 * ($req->unit_after3 - $req->unit_befor3)) <= 100) {
        //         $storeClear->amount3 = 100;
        //         $sum2 = 100;
        //     } else {
        //         $storeClear->amount3 = ($req->price_unit3 * ($req->unit_after3 - $req->unit_befor3));
        //         $sum2 = ($req->price_unit3 * ($req->unit_after3 - $req->unit_befor3));
        //     }

        //     $storeClear->amount6 = $req->price_unit6 ?? 0;
        //     $storeClear->amount8 = $req->price_unit8 ?? 0;

        //     $storeClear->total_amount = $req->price_unit1 + $sum1 + $sum2 + $req->price_unit6 + $req->price_unit8;

        //     $storeClear->is_active = 1;

        //     $storeClear->save();

        //     DB::commit();

        //     //telegramNotify_อัพโหลดสลิป
        //     $date = date("d-m-Y");
        //     $rooms = Room::find($storeClear->room_id);
        //     $company = Company::find($storeClear->company_id);

        //     $sMessageGroup['text'] = "** " . $company->name . " **" .
        //     "\nวันที่: " . $date .
        //     "\n" . $rooms->room_number;
        //     // เพิ่มข้อมูลเฉพาะเมื่อมีค่ามากกว่า 0
        //     if ($storeClear->amount1 > 0) {
        //         $sMessageGroup['text'] .= "\nค่าห้อง: " . number_format($storeClear->amount1);
        //     }
        //     if ($storeClear->amount2 > 0) {
        //         $sMessageGroup['text'] .= "\nค่าไฟ: " . number_format($storeClear->amount2);
        //     }
        //     if ($storeClear->amount3 > 0) {
        //         $sMessageGroup['text'] .= "\nค่าน้ำ: " . number_format($storeClear->amount3);
        //     }
        //     if ($storeClear->amount6 > 0) {
        //         $sMessageGroup['text'] .= "\nค่าเน็ต: " . number_format($storeClear->amount6);
        //     }
        //     if ($storeClear->amount8 > 0) {
        //         $sMessageGroup['text'] .= "\nค่าอื่นๆ: " . number_format($storeClear->amount8);
        //     }
        //     // เพิ่มยอดชำระและวันที่เสมอ
        //     $sMessageGroup['text'] .= "\nยอดชำระ: " . number_format($storeClear->total_amount) . " บาท";

        //     // $this->telegramNotifyGroup($sMessageGroup);

        //     $data = [
        //         'title' => 'Success!',
        //         'msg' => 'เพิ่มสำเร็จ',
        //         'status' => 'success',
        //     ];

        //     return $data;
        // } catch (\Exception $e) {
        //     $sMessageGroup['text'] = "** Error **" .
        //     "\nError: " . $e->getMessage();

        //     $this->telegramNotifyGroup($sMessageGroup);
        // }
    }

    public function update(Request $req)
    {
        try {
            DB::beginTransaction();
            $storeClear = StoreClear::find($req->id);
            $storeClear->room_id = $req->room_id;
            $storeClear->company_id = $req->company_id;
            $storeClear->floor_id = $req->floor_id;

            // $detail->list1 = $req->list1;
            // $detail->list2 = $req->list2;
            // $detail->list3 = $req->list3;
            // $detail->list6 = $req->list6;
            // $detail->list7 = $req->list7;

            $storeClear->price_unit1 = $req->price_unit1;
            $storeClear->price_unit2 = $req->price_unit2;
            $storeClear->price_unit3 = $req->price_unit3;
            $storeClear->price_unit6 = $req->price_unit6;
            $storeClear->price_unit7 = $req->price_unit7;
            $storeClear->price_unit8 = $req->price_unit8;

            $storeClear->unit_befor2 = $req->unit_befor2;
            $storeClear->unit_befor3 = $req->unit_befor3;

            $storeClear->unit_after2 = $req->unit_after2;
            $storeClear->unit_after3 = $req->unit_after3;

            $storeClear->amount1 = $req->price_unit1;

            if (($req->price_unit2 * ($req->unit_after2 - $req->unit_befor2)) <= 120) {
                $storeClear->amount2 = 120;
                $sum1 = 120;
            } else {
                $storeClear->amount2 = ($req->price_unit2 * ($req->unit_after2 - $req->unit_befor2));
                $sum1 = ($req->price_unit2 * ($req->unit_after2 - $req->unit_befor2));
            }

            if (($req->price_unit3 * ($req->unit_after3 - $req->unit_befor3)) <= 100) {
                $storeClear->amount3 = 100;
                $sum2 = 100;
            } else {
                $storeClear->amount3 = ($req->price_unit3 * ($req->unit_after3 - $req->unit_befor3));
                $sum2 = ($req->price_unit3 * ($req->unit_after3 - $req->unit_befor3));
            }
            $storeClear->amount6 = $req->price_unit6;
            $storeClear->amount8 = $req->price_unit8;
            $storeClear->total_amount = $req->price_unit1 + $sum1 + $sum2 + $req->price_unit6 + $req->price_unit8;
            $storeClear->is_active = 1;
            $storeClear->save();

            DB::commit();

            //telegramNotify_อัพโหลดสลิป
            $date = date("d-m-Y");
            $rooms = Room::find($storeClear->room_id);
            $company = Company::find($storeClear->company_id);

            $sMessageGroup['text'] = "** " . $company->name . " **" .
            "\nวันที่: " . $date .
            "\n" . $rooms->room_number;
            // เพิ่มข้อมูลเฉพาะเมื่อมีค่ามากกว่า 0
            if ($storeClear->amount1 > 0) {
                $sMessageGroup['text'] .= "\nค่าห้อง: " . number_format($storeClear->amount1);
            }
            if ($storeClear->amount2 > 0) {
                $sMessageGroup['text'] .= "\nค่าไฟ: " . number_format($storeClear->amount2);
            }
            if ($storeClear->amount3 > 0) {
                $sMessageGroup['text'] .= "\nค่าน้ำ: " . number_format($storeClear->amount3);
            }
            if ($storeClear->amount6 > 0) {
                $sMessageGroup['text'] .= "\nค่าเน็ต: " . number_format($storeClear->amount6);
            }
            if ($storeClear->amount8 > 0) {
                $sMessageGroup['text'] .= "\nค่าอื่นๆ: " . number_format($storeClear->amount8);
            }
            // เพิ่มยอดชำระและวันที่เสมอ
            $sMessageGroup['text'] .= "\nยอดชำระ: " . number_format($storeClear->total_amount) . " บาท";

            $this->telegramNotifyGroup($sMessageGroup);

            $data = [
                'title' => 'Success!',
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
            $storeClear = StoreClear::where('id', $req->id)->first();
            $storeClear->is_active = 0;
            $storeClear->save();

            $storeClear->delete();

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

    public function setActive(Request $req)
    {
        try {
            DB::beginTransaction();
            $status = 0;
            $storeClear = StoreClear::find($req->id);

            $oldStatus = $storeClear->is_active;

            if ($oldStatus == 1) {
                $status = 0;
            } else {
                $status = 1;
            }
            $storeClear->is_active = $status;
            $storeClear->save();

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
