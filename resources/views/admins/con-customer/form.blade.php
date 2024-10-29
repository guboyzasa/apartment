<form class="row g-3" id="customerForm">
    @csrf

    <div class="col-md-4">
        <label for="company_id" class="form-label">เลือกสถานที่</label>
        <select name="company_id" id="company_id" class="form-control">
            <option value="" disabled selected>เลือกหอพัก</option>
            @foreach ($company as $detail)
                <option value="{{ $detail->id }}">{{ $detail->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label for="floor_id" class="form-label">ชั้น</label>
        <select name="floor_id" id="floor_id" class="form-control">
            <option value="" disabled selected>เลือกชั้น</option>
        </select>
    </div>

    <div class="col-md-4">
        <label for="roomName" class="form-label">หมายเลขห้อง</label>
        <select name="roomName" id="roomName" class="form-control">
            <option value="" disabled selected>เลือกห้อง</option>
        </select>
    </div>
    <div class="col-md-4">
        <label for="inputNickName" class="form-label">ชื่อเล่นผู้เช่า</label>
        <input type="text" class="form-control" id="inputNickName" placeholder="ชื่อเล่น">
    </div>
    <div class="col-md-4">
        <label for="inputPayment" class="form-label">
            ค่าห้อง
        </label>
        <div class="input-group">
            <input type="text" class="form-control" id="inputPayment" placeholder="ค่าห้อง" aria-label="ค่าห้อง"
                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                aria-describedby="basic-addon2">
            <span class="input-group-text" id="basic-addon2">บาท</span>
        </div>
    </div>
    <div class="col-md-4">
        <label for="inputPayment2" class="form-label">
            ค่าประกันห้อง
        </label>
        <div class="input-group">
            <input type="text" class="form-control" id="inputPayment2" placeholder="ค่าประกันห้อง"
                aria-label="ค่าประกันห้อง"
                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                aria-describedby="basic-addon2">
            <span class="input-group-text" id="basic-addon2">บาท</span>
        </div>
    </div>
    <div class="col-md-3">
        <label for="inputpersonal_code" class="form-label">เลขบัตรประชาชนผู้เช่า</label>
        <input type="text" class="form-control" id="inputpersonal_code" value=""
            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
            name="inputpersonal_code" placeholder="เลขบัตรประชาชนผู้เช่า" maxlength="13" autofocus>
    </div>
    <div class="col-md-3">
        <label for="inputName" class="form-label">ชื่อ</label>
        <input type="text" class="form-control" id="inputName" placeholder="ชื่อ">
    </div>
    <div class="col-md-3">
        <label for="inputLastName" class="form-label">สกุล</label>
        <input type="text" class="form-control" id="inputLastName" placeholder="สกุล">
    </div>
    <div class="col-md-3">
        <label for="inputPhone" class="form-label">เบอร์โทรศัพท์</label>
        <input type="text" class="form-control" id="inputPhone" placeholder="เบอร์โทรศัพท์"
            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="10">
    </div>
    <div class="col-md-3">
        <label for="inputAddress1" class="form-label">ที่อยู่</label>
        <input type="text" class="form-control" id="inputAddress1"
            oninput="this.value = this.value.replace(/[^0-9./]/g, '').replace(/(\..*?)\..*/g, '$1');"
            placeholder="บ้านเลขที่">
    </div>
    <div class="col-md-3">
        <label for="inputAddress2" class="form-label">หมู่</label>
        <input type="text" class="form-control" id="inputAddress2" placeholder="หมู่ที่"
            oninput="this.value = this.value.replace(/[^0-9./]/g, '').replace(/(\..*?)\..*/g, '$1');">
    </div>
    <div class="col-md-3">
        <label for="inputAddress3" class="form-label">ซอย</label>
        <input type="text" class="form-control" id="inputAddress3" placeholder="ซอย">
    </div>
    <div class="col-md-3">
        <label for="inputAddress4" class="form-label">ถนน</label>
        <input type="text" class="form-control" id="inputAddress4" placeholder="ถนน">
    </div>
    <div class="col-md-3">
        <label for="inputAddress5" class="form-label">แขวง/ตำบล</label>
        <input type="text" class="form-control" id="inputAddress5" placeholder="แขวง/ตำบล">
    </div>
    <div class="col-md-3">
        <label for="inputAddress6" class="form-label">อำเภอ</label>
        <input type="text" class="form-control" id="inputAddress6" placeholder="อำเภอ">
    </div>
    <div class="col-md-3">
        <label for="inputAddress7" class="form-label">จังหวัด</label>
        <input type="text" class="form-control" id="inputAddress7" placeholder="จังหวัด">
    </div>
    <div class="col-md-3">
        <label for="inputZip" class="form-label">
            รหัสไปรษณีย์
        </label>
        <input type="text" class="form-control" id="inputZip" placeholder="รหัสไปรษณีย์"
            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="5">
    </div>
    <div class="col-md-6">
        <label for="inputNickName2" class="form-label">ชื่อเล่นของบุคคลที่2</label>
        <input type="text" class="form-control" id="inputNickName2" placeholder="ชื่อเล่นของบุคคลที่2">
    </div>
    <div class="col-md-6">
        <label for="inputPhone2" class="form-label">เบอร์โทรศัพท์บุคคลที่2</label>
        <input type="text" class="form-control" id="inputPhone2"
            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" maxlength="10"
            placeholder="เบอร์โทรศัพท์บุคคลที่2">
    </div>
    <div class="col-md-12">
        <label for="inputOther" class="form-label">หมายเหตุอื่นๆ</label>
        <textarea class="form-control" id="inputOther" rows="3" placeholder="หมายเหตุอื่นๆ"></textarea>
    </div>
</form>
