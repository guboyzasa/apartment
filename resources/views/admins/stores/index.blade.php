@extends('admin-layouts.master')

@section('title')
    Management
@endsection

@section('css')
    <style>

    </style>
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        @endslot
        @slot('title')
            Management
        @endslot
    @endcomponent

    <div class="row">
        <div class="card" id="locationForm" style="display: none;border-radius: 10px">
            <div class="card-body">
                <p class="font-size-16"><b>ออกบิลค่าห้อง</b></p>
                <div class="row">
                    @csrf
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="inputNickName" class="form-label">สถานที่ <span class="text-danger">*</span></label>

                            <select name="company_id" id="company_id" class="form-control">
                                <option value="" disabled selected>เลือกหอพัก</option>
                                @foreach ($company as $detail)
                                    <option value="{{ $detail->id }}">{{ $detail->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="inputNickName" class="form-label">ชั้น <span class="text-danger">*</span></label>

                            <select name="floor_id" id="floor_id" class="form-control">
                                <option value="" disabled selected>เลือกชั้น</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="inputNickName" class="form-label">หมายเลขห้องพัก <span
                                    class="text-danger">*</span></label>

                            <select name="room_id" id="room_id" class="form-control">
                                <option value="" disabled selected>เลือกห้อง</option>
                            </select>
                        </div>
                    </div>

                    <div id="table-hide" style="display: none;">
                        {{-- <div class="table-responsive">
                            <table class="table table-bordered dt-responsive nowrap w-100">
                                <tr class="text-center">
                                    <th class="font-size-18">รายการ</th>
                                    <th class="font-size-18">ราคา/หน่วย</th>
                                    <th colspan="2">
                                        <div class="font-size-18" id="show_room"></div>
                                    </th>
                                </tr>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" class="formInput form-control" id="list1"
                                                value="ค่าห้อง" name="list1" placeholder="ค่าห้อง">
                                        </td>
                                        <td>
                                            <select name="price_unit1" id="price_unit1" class="form-control">
                                                @foreach ($room_rate as $price)
                                                    <option value="{{ $price->room_rate }}">{{ $price->room_rate }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="text-center font-size-18" colspan="2">
                                            จำนวนหน่วย
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" class="formInput form-control" id="list2"
                                                value="ค่าไฟฟ้า" name="list2" placeholder="ค่าไฟฟ้า">
                                        </td>
                                        <td>
                                            <select name="price_unit2" id="price_unit2" class="form-control">
                                                <option value="10">10</option>
                                                <option value="120">120</option>
                                            </select>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroup-sizing-default">ก่อน</span>
                                                <input type="number" class="form-control" aria-label="Sizing example input"
                                                    aria-describedby="inputGroup-sizing-default" id="unit_befor2"
                                                    value="" name="unit_befor2" placeholder="0" required>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroup-sizing-default">หลัง</span>
                                                <input type="number" class="form-control" aria-label="Sizing example input"
                                                    aria-describedby="inputGroup-sizing-default" id="unit_after2"
                                                    value="" name="unit_after2" placeholder="0" required>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" class="formInput form-control" id="list3"
                                                value="ค่าน้ำประปา" name="list3" placeholder="ค่าน้ำประปา">
                                        </td>
                                        <td>
                                            <select name="price_unit3" id="price_unit3" class="form-control">
                                                <option value="30">30</option>
                                                <option value="150">150</option>

                                            </select>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroup-sizing-default">ก่อน</span>
                                                <input type="number" class="form-control"
                                                    aria-label="Sizing example input"
                                                    aria-describedby="inputGroup-sizing-default" id="unit_befor3"
                                                    value="" name="unit_befor3" placeholder="0" required>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroup-sizing-default">หลัง</span>
                                                <input type="number" class="form-control"
                                                    aria-label="Sizing example input"
                                                    aria-describedby="inputGroup-sizing-default" id="unit_after3"
                                                    value="" name="unit_after3" placeholder="0" required>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" class="formInput form-control" id="list6"
                                                value="Internet" name="list6" placeholder="Internet">
                                        </td>

                                        <td>
                                            <input type="number" class="formInput form-control" id="price_unit6"
                                                value="" name="price_unit6" placeholder="0">
                                        </td>
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" class="formInput form-control" id="list7"
                                                value="อื่นๆ" name="list7" placeholder="อื่นๆ">
                                        </td>
                                        <td colspan="2">
                                            <input type="text" class="formInput form-control" id="price_unit7"
                                                value="" name="price_unit7" placeholder="หมายเหตุ">
                                        </td>
                                        <td>
                                            <input type="number" class="formInput form-control" id="price_unit8"
                                                value="" name="price_unit8" placeholder="0">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3 d-grid gap-1">
                            <button type="button" class="btn btn-outline-success waves-effect waves-light"
                                id="saveCusBtn">บันทึก</button>
                        </div> --}}

                        <div class="table-responsive">
                            <form action="" method="POST" id="list_payment_form">
                                @csrf
                                <input type="hidden" name="room_id_form" id="room_id_form" value="">
                                <input type="hidden" name="company_id_form" id="company_id_form" value="">
                                <input type="hidden" name="floor_id_form" id="floor_id_form" value="">

                                <table class="table table-borderless dt-responsive nowrap w-100">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="font-size-18">รายการ</th>
                                            <th class="font-size-18">ราคา/หน่วย</th>
                                            <th colspan="2">
                                                <div class="font-size-18" id="show_room"></div>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody id="list_payment">
                                        <!-- ข้อมูลรายการจะถูกสร้างด้วย JavaScript และแสดงในส่วนนี้ -->
                                    </tbody>
                                </table>

                                <div class="mt-3 d-grid gap-1">
                                    <button type="submit" class="btn btn-success waves-effect waves-light">บันทึก</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="text-end mb-3">
                <button type="button" class="btn btn-success" id="showFormBtn">ออกบิลค่าห้อง</button>
            </div>
            <div class="col-md-12">
                <div class="row gy-3">
                    <!-- สถานที่ -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="filter_company_id" class="form-label">
                                สถานที่
                            </label>
                            <select name="filter_company_id" id="filter_company_id" class="form-control">
                                <option value="all" selected>ทั้งหมด</option>
                                @foreach ($company as $detail)
                                    <option value="{{ $detail->id }}">{{ $detail->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- ชั้น -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="filter_floor_id" class="form-label">
                                ชั้น
                            </label>
                            <select name="filter_floor_id" id="filter_floor_id" class="form-control">
                                <option value="all" selected>ทั้งหมด</option>
                            </select>
                        </div>
                    </div>

                    <!-- ปุ่มค้นหา -->
                    <div class="col-12 text-center mb-3">
                        <button type="button" class="btn btn-primary w-50" id="filterBtn" onclick="showTableF1()">
                            ค้นหา
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="simple_table_f1" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>ROOM</th>
                                <th>COM</th>
                                <th>ค่าห้อง</th>
                                <th>ค่าไฟ</th>
                                <th>ค่าน้ำ</th>
                                <th>Internet</th>
                                <th>อื่นๆ</th>
                                <th class="bg-soft bg-danger">รวม</th>
                                <th>STATUS</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
    </div>

    <!-- Modal Edit F1 -->
    <div class="modal fade" id="simpleModalF1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span class="badge bg-success font-size-16"
                            id="modal_titleF1"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @csrf
                        <input type="hidden" class="formEdit form-control" name="id" id="id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Company</label>
                                    <span class="text-danger">*</span>
                                    <select name="company" id="show_company_id" class="form-control" required>
                                        @foreach ($company as $detail)
                                            <option value="{{ $detail->id }}">{{ $detail->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Room</label>
                                    <span class="text-danger">*</span>
                                    <select name="name" id="show_room_id" class="form-control" required>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered dt-responsive nowrap w-100">
                                <tr class="text-center">
                                    <th>รายการ</th>
                                    <th>ราคา/หน่วย</th>
                                    <th colspan="2">จำนวนหน่วย</th>
                                </tr>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" class="formInput form-control" id="show_list1"
                                                value="" name="show_list1" placeholder="" readonly>
                                        </td>
                                        <td>
                                            <input type="number" class="formInput form-control" id="show_price_unit1"
                                                value="" name="show_price_unit1" placeholder="0" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" class="formInput form-control" id="show_list2"
                                                value="" name="show_list2" placeholder="" readonly>
                                        </td>
                                        <td>
                                            <input type="number" class="formInput form-control" id="show_price_unit2"
                                                value="" name="show_price_unit2" placeholder="0" required>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroup-sizing-default">ก่อน</span>
                                                <input type="number" class="form-control"
                                                    aria-label="Sizing example input"
                                                    aria-describedby="inputGroup-sizing-default" id="show_unit_befor2"
                                                    value="" name="show_unit_befor2" placeholder="0" required>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroup-sizing-default">หลัง</span>
                                                <input type="number" class="form-control"
                                                    aria-label="Sizing example input"
                                                    aria-describedby="inputGroup-sizing-default" id="show_unit_after2"
                                                    value="" name="show_unit_after2" placeholder="0" required>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" class="formInput form-control" id="show_list3"
                                                value="" name="show_list3" placeholder="" readonly>
                                        </td>
                                        <td>
                                            <input type="number" class="formInput form-control" id="show_price_unit3"
                                                value="" name="show_price_unit3" placeholder="0" required>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroup-sizing-default">ก่อน</span>
                                                <input type="number" class="form-control"
                                                    aria-label="Sizing example input"
                                                    aria-describedby="inputGroup-sizing-default" id="show_unit_befor3"
                                                    value="" name="show_unit_befor3" placeholder="0" required>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroup-sizing-default">หลัง</span>
                                                <input type="number" class="form-control"
                                                    aria-label="Sizing example input"
                                                    aria-describedby="inputGroup-sizing-default" id="show_unit_after3"
                                                    value="" name="show_unit_after3" placeholder="0" required>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" class="formInput form-control" id="show_list6"
                                                value="" name="show_list6" placeholder="" readonly>
                                        </td>
                                        <td>
                                            <input type="number" class="formInput form-control" id="show_price_unit6"
                                                value="" name="show_price_unit6" placeholder="0">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" class="formInput form-control" id="show_list7"
                                                value="" name="list7" placeholder="" readonly>
                                        </td>
                                        <td colspan="2">
                                            <input type="text" class="formInput form-control" id="show_price_unit7"
                                                value="" name="price_unit7" placeholder="หมายเหตุ">
                                        </td>
                                        <td>
                                            <input type="number" class="formInput form-control" id="show_price_unit8"
                                                value="" name="price_unit8" placeholder="0">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-3 d-grid gap-1">
                        <button type="button" class="btn btn-primary waves-effect waves-light"
                            id="editCusBtnF1">บันทึก</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            var simpleF1 = '';
            showTableF1();
        });

        @include('admins.stores.showTables');
        // @include('admins.stores.saveBtn');
        @include('admins.stores.editBtn');

        $('#list_payment_form').on('submit', function(e) {
            e.preventDefault();
            openLoading();
            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('admin.store.add') }}", // กำหนด route ของ Laravel
                type: 'POST', // ประเภทของ HTTP request (POST)
                data: formData, // ข้อมูลฟอร์มที่ serialize มา
                success: function(res) {
                    closeLoading();
                    toastr.success(res.msg, res.title, {
                        timeOut: 3000,
                        progressBar: true,
                        tapToDismiss: false
                    });
                    simpleF1.ajax.reload(null, false);
                },
                error: function(xhr, status, error) {
                    closeLoading();
                    toastr.error('เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง', 'ข้อผิดพลาด', {
                        timeOut: 3000,
                        progressBar: true,
                        tapToDismiss: false
                    });
                    // console.error(xhr.responseText); // แสดงข้อผิดพลาดใน console
                }
            });
        });

        //ลบข้อมูลยอด
        function destroy(id) {
            Swal.fire({
                title: 'คุณมั่นใจหรือไม่ ?',
                text: 'ที่จะลบรายการนี้',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#7A7978',
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก',

            }).then((result) => {
                if (result.isConfirmed) {
                    // openLoading();
                    $.post("{{ route('admin.store.destroy') }}", data = {
                            _token: '{{ csrf_token() }}',
                            id: id,
                        },
                        function(res) {
                            simpleF1.ajax.reload(null, false);
                            simpleF2.ajax.reload(null, false);
                            simpleF3.ajax.reload(null, false);
                            closeLoading();
                            // Swal.fire(res.title, res.msg, res.status);
                            // location.reload();
                            toastr.success(res.msg, res.title, {
                                timeOut: 3000,
                                progressBar: true,
                                tapToDismiss: false
                            });
                        },
                    );

                }
            });
        }

        //button switch
        setStatus = (id) => {
            // openLoading()
            $.ajax({
                type: "method",
                method: "POST",
                url: "{{ route('admin.store.set-active') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                },
                success: function(res) {
                    simpleF1.ajax.reload(null, false);
                    simpleF2.ajax.reload(null, false);
                    simpleF3.ajax.reload(null, false);
                    closeLoading();
                    toastr.success('แก้ไขเรียบร้อย', 'แจ้งเตือน!', {
                        timeOut: 3000,
                        progressBar: true,
                        tapToDismiss: false
                    });
                }
            });
        }

        //addCommas
        function addCommas(nStr) {
            nStr += '';
            var x = nStr.split('.');
            var x1 = x[0];
            var x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }

        $('#company_id').on('change', function() {
            const companyId = $(this).val();

            // ล้างค่า floor และ room ก่อน เพื่อไม่ให้ค้างจากครั้งก่อน
            $('#floor_id').empty().append('<option value="" disabled selected>เลือกชั้น</option>');
            $('#room_id').empty().append('<option value="" disabled selected>เลือกห้อง</option>');
            $('#table-hide').hide();

            if (companyId) {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.store.get-floors') }}", // Route สำหรับดึง floor
                    data: {
                        _token: '{{ csrf_token() }}',
                        company_id: companyId
                    },
                    success: function(res) {
                        res.forEach(function(floor) {
                            $('#floor_id').append(
                                `<option value="${floor.id}">${floor.name}</option>`
                            );
                        });
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr);
                    }
                });
            }
        });

        $('#floor_id').on('change', function() {
            const companyId = $('#company_id').val();
            const floorId = $(this).val();

            $('#table-hide').hide();

            if (companyId && floorId) {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.store.get-rooms') }}", // ใช้ route ใหม่ให้ตรงกับฟังก์ชัน
                    data: {
                        _token: '{{ csrf_token() }}',
                        company_id: companyId,
                        floor_id: floorId
                    },
                    success: function(res) {
                        $('#room_id').empty().append(
                            '<option value="" disabled selected>เลือกห้อง</option>');
                        res.forEach(function(room) {
                            const roomText =
                                `${room.room_number} - ${room.nickname} (${room.phone})`;
                            $('#room_id').append(
                                $('<option>', {
                                    value: room.room_id,
                                    text: roomText
                                })
                            );
                        });
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr);
                    }
                });
            }
        });

        const colors = ['#ffb3ba', '#ffdfba', '#ffffba', '#baffc9', '#bae1ff', '#ffd4e5', '#d4ffea', '#eecbff', '#feffa3',
            '#dbdcff'
        ]; // ลิสต์สี
        let currentColorIndex = 0;

        $('#room_id').on('change', function() {
            const roomId = $(this).val();
            const companyId = $('#company_id').val();
            const floorId = $('#floor_id').val();

            $('#unit_before').val('');
            $('#unit_after').val('');
            // $('#unit_after2').val('');
            // $('#unit_after3').val('');
            $('#room_id_form').val('');
            $('#company_id_form').val('');
            $('#floor_id_form').val('');

            $('#list_payment').empty()
            if (roomId) {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.store.get-store') }}", // Route สำหรับดึง floor
                    data: {
                        _token: '{{ csrf_token() }}',
                        room_id: roomId,
                        company_id: companyId,
                    },
                    success: function(res) {
                        // $('#unit_befor2').val(res.unit_after2).trigger('change');
                        // $('#unit_befor3').val(res.unit_after3).trigger('change');
                        console.log(res);
                        let tableAppend = '';
                        $('#room_id_form').val(roomId).trigger('change');
                        $('#company_id_form').val(companyId).trigger('change');
                        $('#floor_id_form').val(floorId).trigger('change');

                        (res.list_payments).forEach(list_payment => {
                            console.log(list_payment);
                            tableAppend += `
                            <tr>
                                <td>
                                    
                                    <input type="text" class="formInput form-control" id="list_payment_id" form="list_payment_form"
                                        value="${list_payment.name}" name="list_payment_id[${list_payment.id}]" placeholder="${list_payment.name}">
                                </td>`

                            if (list_payment.list_payment_details) {
                                if (list_payment.is_other != 1) {
                                    tableAppend += '<td>'
                                    tableAppend +=
                                        `<select name="price_unit[${list_payment.id}]" id="price_unit" class="form-control" form="list_payment_form">`
                                    for (let i = 0; i < (list_payment.list_payment_details)
                                        .length; i++) {
                                        tableAppend +=
                                            `<option value="${list_payment.list_payment_details[i].price_unit}">${list_payment.list_payment_details[i].price_unit}</option>`
                                    }
                                    tableAppend += `</select>`

                                    tableAppend += '</td>'
                                    if (list_payment.is_unit == 1) {
                                        tableAppend += `<td>
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroup-sizing-default">ก่อน</span>
                                                <input type="number" class="form-control" aria-label="Sizing example input" form="list_payment_form"
                                                    aria-describedby="inputGroup-sizing-default" id="unit_before" name="unit_before[${list_payment.id}]"
                                                    value="${list_payment.last_store_clear_detail ? list_payment.last_store_clear_detail.unit_after : ''}">
                                            </div>
                                        </td>`
                                        tableAppend += `<td>
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroup-sizing-default">หลัง</span>
                                                <input type="number" class="form-control" aria-label="Sizing example input"
                                                    aria-describedby="inputGroup-sizing-default" id="unit_after" form="list_payment_form"
                                                    value="" name="unit_after[${list_payment.id}]">
                                            </div>
                                        </td>`
                                    }
                                } else {
                                    // tableAppend += '</td>'
                                    if (list_payment.is_other == 1) {
                                        tableAppend += ` <td colspan="2">
                                            <input type="text" class="formInput form-control" id="other" form="list_payment_form"
                                                value="" name="other[${list_payment.id}]" placeholder="หมายเหตุ">
                                        </td>
                                        <td>
                                            <input type="number" class="formInput form-control" id="price_unit" form="list_payment_form"
                                                value="" name="price_unit[${list_payment.id}]" placeholder="0">
                                        </td>`
                                    }
                                }
                            }

                            tableAppend += '</tr>'

                        });
                        $('#list_payment').append(tableAppend)
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr);
                    }
                });

                $('#table-hide').show(); // แสดงตารางข้อมูล
                $('#show_room').empty();
                $('#show_room').append($("#room_id option:selected").text());



                // เปลี่ยนสีของตาราง
                currentColorIndex = (currentColorIndex + 1) % colors.length; // เปลี่ยนสี
                $('#table-hide .table').css('background-color', colors[
                    currentColorIndex]); // เปลี่ยนสีพื้นหลังของตาราง
            } else {
                $('#table-hide').hide(); // ซ่อนตารางข้อมูล
            }
        });

        $('#filter_company_id').on('change', function() {
            const companyId = $(this).val();

            // ล้างค่า floor และ room ก่อน เพื่อไม่ให้ค้างจากครั้งก่อน
            $('#filter_floor_id').empty().append('<option value="all"selected>ทั้งหมด</option>');

            if (companyId) {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.store.get-floors') }}", // Route สำหรับดึง floor
                    data: {
                        _token: '{{ csrf_token() }}',
                        company_id: companyId
                    },
                    success: function(res) {
                        res.forEach(function(floor) {
                            $('#filter_floor_id').append(
                                `<option value="${floor.id}">${floor.name}</option>`
                            );
                        });
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr);
                    }
                });
            }
        });

        function formatNumber(number) {
            return new Intl.NumberFormat('en-US', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(number);
        }

        document.getElementById('showFormBtn').addEventListener('click', function() {
            const form = document.getElementById('locationForm');
            if (form.style.display === 'none') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        });
    </script>
    @include('admins.stores.showinfo')
@endsection
