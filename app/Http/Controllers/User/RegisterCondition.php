<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Condition;
use App\Models\Customer;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class RegisterCondition extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function condition(Request $req)
    {
        $id = $req->input('id'); // รับค่า id จาก request
        $company = Company::where('id', $id)->where('is_active', 1)->first();
        $condition = Condition::where('is_active', 1)->get();

        // เก็บข้อมูลใน session หรือ cache เพื่อใช้ในหน้าถัดไป (หากจำเป็น)
        session(['company' => $company, 'condition' => $condition]);

        return response()->json(['message' => 'Success']);
    }

    public function showConditionPage()
    {
        // ดึงข้อมูลจาก session หรือจัดการตามที่ต้องการ
        $company = session('company');
        $condition = session('condition');

        $cusOne = Room::where('status_id', 1)->where('is_active', 1)->get();
        $cusTwo = Room::where('status_id', 2)->where('is_active', 1)->get();
        $cusThree = Room::where('status_id', 3)->where('is_active', 1)->get();

        // ตรวจสอบสถานะห้อง
        $occupiedRooms = Customer::where('company_id', $company->id)->where('is_active', 1)
            ->pluck('room_id')
            ->toArray();

        return view('users.condition.index', compact('company', 'condition', 'cusOne', 'cusTwo', 'cusThree', 'occupiedRooms'));
    }

    public function setSavedId(Request $req)
    {
        // บันทึก savedId ลงใน Session
        $req->session()->put('savedId', $req->input('savedId'));
        return response()->json(['status' => 'success']);
    }

    public function viewListDoc(Request $req)
    {
        $id = $req->session()->get('savedId');

        if (!$id) {
            return redirect()->route('condition')->with('error', 'ไม่พบข้อมูล');
        }

        $customer = Customer::find($id);
        $company = Company::where('id', $customer?->company_id)->where('is_active', 1)->first();

        if (!$customer || !$company) {
            return redirect()->route('condition')->with('error', 'ไม่พบข้อมูล');
        }

        $condition = Condition::where('is_active', 1)->get();
        $cusOne = Room::where('status_id', 1)->where('is_active', 1)->get();
        $cusTwo = Room::where('status_id', 2)->where('is_active', 1)->get();
        $cusTree = Room::where('status_id', 3)->where('is_active', 1)->get();

        return view('users.condition.view-doc-1', compact('company', 'condition', 'cusOne', 'cusTwo', 'cusTree', 'customer'));
    }

    public function store(Request $req)
    {
        try {

            $imgbase64 = $req->imgbase64;

            $room = Room::find($req->inputRoomID); // ค้นหาห้องโดยใช้ ID ที่ส่งมา

            if (!$room) {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'ไม่พบหมายเลขห้องที่เลือก',
                ], 404); // ตรวจสอบกรณีที่หาไม่เจอ
            }

            DB::beginTransaction();
            $customer = new Customer;

            $customer->room_number = $room->name;
            $customer->nickname = $req->inputNickName;
            $customer->personal_code = $req->inputpersonal_code;
            $customer->name = $req->inputName;
            $customer->lastname = $req->inputLastName;
            $customer->payment = ceil($req->inputPayment);
            $customer->payment2 = ceil($req->inputPayment2);
            $customer->payment_total = ceil($req->inputPayment) + ceil($req->inputPayment2);
            $customer->phone = $req->inputPhone;
            $customer->address1 = $req->inputAddress1;
            $customer->address2 = $req->inputAddress2;
            $customer->address3 = $req->inputAddress3;
            $customer->address4 = $req->inputAddress4;
            $customer->address5 = $req->inputAddress5;
            $customer->address6 = $req->inputAddress6;
            $customer->address7 = $req->inputAddress7;
            $customer->zipcode = $req->inputZip;
            $customer->nickname2 = $req->inputNickName2;
            $customer->phone2 = $req->inputPhone2;
            $customer->other = $req->inputOther;

            $customer->company_id = $req->CompanyID;
            $customer->room_id = $req->inputRoomID;

            $path = 'images/personals-img/' . $room->name;
            $fullPath = $this->uploadBase64($imgbase64, $path);
            $customer->img = $fullPath;

            $customer->save();

            DB::commit();

            //telegramNotify_อัพโหลด
            $detail = Customer::find($customer->id);
            $company = Company::find($customer->company_id);

            $sMessageGroup['text'] = "** "."สัญญาเช่า " . $company->name . " **" .
            "\nวันที่ทำสัญญา: " . $detail->created_at->format('d/m/Y') .
            "\nห้อง: " . $detail->room_number .
            "\nชื่อเล่น: " . $detail->nickname ." - ". $detail->phone .
            "\nค่าห้อง: " . number_format($detail->payment) . " บาท" .
            "\nค่าประกันห้อง: " . number_format($detail->payment2) . " บาท" ;
            // เพิ่มยอดชำระและวันที่เสมอ
            $sMessageGroup['text'] .= "\nจำนวนเงินที่ชำระล่วงหน้า: " . number_format($detail->payment_total) . " บาท".
            "\nหมายเหตุ/อื่นๆ: " . $detail->other ;

            $this->telegramNotifyGroup($sMessageGroup);
            $this->telegramNotiflyWithImage($fullPath);

            $data = [
                'title' => 'สำเร็จ',
                'msg' => 'บันทึกสัญญาเช่าสำเร็จ',
                'status' => 'success',
                'id' => $customer->id,
            ];
            // dd($data);

            return $data;
        } catch (\Exception $e) {
            $sMessageGroup['text'] = "** Error **" .
            "\nError: " . $e->getMessage();
            $this->telegramNotifyGroup($sMessageGroup);

            $data = [
                'title' => 'ผิดพลาด',
                'msg' => 'กรุณาติดต่อผู้พัฒนา',
                'status' => 'error',
            ];
            return $data;
        }
    }

    public function checkPhone(Request $req)
    {

        $cus = Customer::where('phone', $req->text)->first();
        if ($cus != null) {
            $data = [
                'title' => 'แจ้งเตือน!',
                'msg' => 'เบอร์โทรนี้ถูกใช้แล้ว',
                'status' => 'warning',
            ];

            return $data;
        }
    }

    public function checkPersonal(Request $req)
    {

        $cus = Customer::where('personal_code', $req->text)->first();
        if ($cus != null) {
            $data = [
                'title' => 'แจ้งเตือน!',
                'msg' => 'เลขบัตรประชาชนนี้ถูกใช้แล้ว',
                'status' => 'warning',
            ];

            return $data;
        }
    }

}
