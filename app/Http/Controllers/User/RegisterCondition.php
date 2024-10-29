<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Condition;
use App\Models\Customer;
use App\Models\Floor;
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
        // ดึงข้อมูลจาก session
        $company = session('company');
        $condition = session('condition');

        // ตรวจสอบว่ามีข้อมูล company หรือไม่
        if (!$company) {
            return redirect()->back()->withErrors('Company not found.');
        }

        // ดึงชั้นทั้งหมดที่เป็นของบริษัทนั้น
        $floors = Floor::where('company_id', $company->id)->where('is_active', 1)->get();
        // return $floors;
        // ดึงเฉพาะห้องที่เป็นของบริษัทและชั้นที่มีอยู่ในตาราง floors
        $rooms = Room::where('company_id', $company->id)
            ->whereIn('floor_id', $floors->pluck('id')->toArray()) // กรองเฉพาะห้องที่มี floor_id ในบริษัทนั้น
            ->where('is_active', 1)
            ->with('floor') // โหลดข้อมูลชั้น
            ->get()
            ->groupBy('floor_id'); // จัดกลุ่มตาม floor_id

        // ดึงห้องที่ถูกใช้งาน (occupied rooms)
        $occupiedRooms = Customer::where('company_id', $company->id)
            ->where('is_active', 1)
            ->pluck('room_id')
            ->toArray();

        // ส่งข้อมูลไปยัง View
        return view('users.condition.index', compact('company', 'condition', 'floors', 'rooms', 'occupiedRooms'));
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
        $room_floor_1 = Room::where('floor_id', 1)->where('is_active', 1)->get();
        $room_floor_2 = Room::where('floor_id', 2)->where('is_active', 1)->get();
        $room_floor_3 = Room::where('floor_id', 3)->where('is_active', 1)->get();

        return view('users.condition.view-doc-1', compact('company', 'condition', 'customer', 'room_floor_1', 'room_floor_2', 'room_floor_3'));
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

            $customer->room_number = $room->room_number;
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
            $customer->is_confirm = $req->confirmDataCheckbox;
            $customer->is_accept = $req->acceptContractCheckbox;
            $customer->other = $req->inputOther;

            $customer->company_id = $req->CompanyID;
            $customer->room_id = $req->inputRoomID;
            $customer->floor_id = $room->floor_id;

            $path = 'images/personals-img/' . $room->name . '/' . $customer->personal_code;
            $fullPath = $this->uploadBase64($imgbase64, $path);
            $customer->img = $fullPath;

            $customer->save();

            DB::commit();

            //telegramNotify_อัพโหลด
            $customer = Customer::find($customer->id);
            $company = Company::find($customer->company_id);

            $sMessageGroup['text'] = "** " . "สัญญาเช่า " . $company->name . " **" .
            "\nวันที่ทำสัญญา: " . $customer->created_at->format('d/m/Y') .
            "\nห้อง: " . $customer->room_number .
            "\nชื่อเล่น: " . $customer->nickname . " - " . $customer->phone .
            "\nค่าห้อง: " . number_format($customer->payment) . " บาท" .
            "\nค่าประกันห้อง: " . number_format($customer->payment2) . " บาท";
            // เพิ่มยอดชำระและวันที่เสมอ
            $sMessageGroup['text'] .= "\nจำนวนเงินที่ชำระล่วงหน้า: " . number_format($customer->payment_total) . " บาท" .
            "\nหมายเหตุ/อื่นๆ: " . $customer->other;

            // $this->telegramNotifyGroup($sMessageGroup);
            // $this->telegramNotiflyWithImage($fullPath);

            $data = [
                'title' => 'สำเร็จ',
                'msg' => 'บันทึกสัญญาเช่าสำเร็จ',
                'status' => 'success',
                'id' => $customer->id,
            ];

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

    // public function checkPhone(Request $req)
    // {

    //     $checkPhone = Customer::where('phone', $req->text)->where('is_active', 1)->first();
    //     if ($checkPhone != null) {
    //         $data = [
    //             'title' => 'แจ้งเตือน!',
    //             'msg' => 'เบอร์โทรนี้ถูกใช้แล้ว',
    //             'status' => 'warning',
    //         ];

    //         return $data;
    //     }
    // }

    // public function checkPersonal(Request $req)
    // {

    //     $checkPersonal = Customer::where('personal_code', $req->text)->where('is_active', 1)->first();
    //     if ($checkPersonal != null) {
    //         $data = [
    //             'title' => 'แจ้งเตือน!',
    //             'msg' => 'เลขบัตรประชาชนนี้ถูกใช้แล้ว',
    //             'status' => 'warning',
    //         ];

    //         return $data;
    //     }
    // }

}
