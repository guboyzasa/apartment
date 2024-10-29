@extends('admin-layouts.master')

@section('title')
    สัญญาเช่า/ลูกค้า
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
            สัญญาเช่า/ลูกค้า
        @endslot
    @endcomponent

    <div class="row">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="col-12">
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
                                <button type="button" class="btn btn-primary w-50" onclick="showTable()">
                                    ค้นหา
                                </button>
                            </div>
                        </div>
                        {{-- <p class="font-size-16"><b>สัญญาเช่า/ลูกค้า</b></p> --}}
                        <div class="table-responsive">
                            <table id="simple_table" class="table table-bordered dt-responsive table-striped nowrap w-100">
                                <thead>
                                    <tr class="text-center">
                                        <th>IMG</th>
                                        <th>สถานที่</th>
                                        <th>ชื่อเล่น</th>
                                        <th>พยาน</th>
                                        <th>หมายเหตุ</th>
                                        <th>STATUS</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modals edit --}}
    <div class="modal fade update-profile" id="simpleModals" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel"><span id="modal_titles"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    {{-- <form class="needs-validation" novalidate=""> --}}
                    @csrf
                    <input type="hidden" class="formEdit form-control" name="room_id" value="" id="room_id">
                    <div class="row">
                        <div class="col-md-12">
                            @include('admins.con-customer.form')
                        </div>
                    </div>
                    <div class="mt-3 d-grid">
                        <br>
                        <button class="btn btn-primary waves-effect waves-light" id="editCusBtns" type="button">
                            บันทึก
                        </button>
                    </div>
                    {{-- </form> --}}
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!--  Picture modal example -->
    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true" id="infoModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">รูปภาพบัตรประชาชน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="output" max-width="300" style="max-height: 500px;" class="form-control" />
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            var simple = '';
            showTable();

        });

        @include('admins.con-customer.showTable')

        //show ข้อมูลเมมเบอร์ modals
        function showInfo(obj) {
            $('#modal_titles').text('แก้ไขสัญญาเช่า');
            $('#con-customer_id').val(obj.id);
            $('#company_id').val(obj.company_id).trigger('change');
            $('#floor_id').empty().append(new Option('เลือกชั้น', '', false, false));
            $('#roomName').empty().append(new Option('เลือกห้อง', '', false, false));

            console.log('Selected Company ID:', obj.company_id, 'Selected Floor ID:', obj.floor_id);

            if (obj.company_id) {
                $.post("{{ route('admin.con-customer.get-floor') }}", {
                        _token: '{{ csrf_token() }}',
                        company_id: obj.company_id
                    })
                    .done((res) => {
                        $('#floor_id').empty().append(new Option('เลือกชั้น', '', false, false)); // ล้างค่าเก่า
                        res.forEach(floor => {
                            $('#floor_id').append(new Option(floor.name, floor.id)); // เพิ่มชั้นใน select
                        });

                        // ตั้งค่า floor_id หลังจากโหลดเสร็จ
                        if (obj.floor_id) {
                            $('#floor_id').val(obj.floor_id).trigger('change');
                            // ดึงข้อมูลห้องทันทีเมื่อชั้นถูกเลือก
                            loadRooms(obj.company_id, obj.floor_id);
                        }
                    })
                    .fail(xhr => console.error('Error loading floors:', xhr));
            }

            function loadRooms(companyId, floorId) {
                $.post("{{ route('admin.con-customer.get-room') }}", {
                        _token: '{{ csrf_token() }}',
                        company_id: companyId,
                        floor_id: floorId
                    })
                    .done((res) => {
                        $('#roomName').empty().append(new Option('เลือกห้อง', '', false, false)); // ล้างค่าเก่า
                        res.forEach(room => {
                            console.log('ID:', room.room_number, room.id);
                            $('#roomName').append(new Option(room.room_number, room.id)); // เพิ่มห้องใน select
                        });

                        // ตั้งค่า room_id หลังจากโหลดเสร็จ
                        if (obj.room_id) {
                            $('#roomName').val(obj.room_id).trigger('change');
                        }

                        // แสดงข้อมูลห้องในตาราง (ถ้าคุณมี DataTable)
                        // updateRoomTable(res); // ฟังก์ชันที่คุณต้องสร้างเพื่อนำข้อมูลไปแสดงในตาราง
                    })
                    .fail(xhr => console.error('Error loading rooms:', xhr));
            }
            $('#inputNickName').val(obj.nickname).trigger('change');
            $('#inputPayment').val(obj.payment).trigger('change');
            $('#inputPayment2').val(obj.payment2).trigger('change');
            $('#inputpersonal_code').val(obj.personal_code).trigger('change');
            $('#inputName').val(obj.name).trigger('change');
            $('#inputLastName').val(obj.lastname).trigger('change');
            $('#inputPhone').val(obj.phone).trigger('change');
            $('#inputAddress1').val(obj.address1).trigger('change');
            $('#inputAddress2').val(obj.address2).trigger('change');
            $('#inputAddress3').val(obj.address3).trigger('change');
            $('#inputAddress4').val(obj.address4).trigger('change');
            $('#inputAddress5').val(obj.address5).trigger('change');
            $('#inputAddress6').val(obj.address6).trigger('change');
            $('#inputAddress7').val(obj.address7).trigger('change');
            $('#inputZip').val(obj.zipcode).trigger('change');
            $('#inputNickName2').val(obj.nickname2).trigger('change');
            $('#inputPhone2').val(obj.phone2).trigger('change');
            $('#inputOther').val(obj.other).trigger('change');
            // $('#inputZip').val(obj.zipcode).trigger('change');
            $('#simpleModals').modal("show");
        }

        //show_img
        function showInfoImg(img) {
            $('#infoModal').modal('show');
            $('#output').attr('src', `{{ URL::asset('/${img}') }}`);
        }

        //บันทึก
        $('#editCusBtns').click(function(e) {
            e.preventDefault();
            $(this).attr('disabled', true);
            // เก็บค่าจากฟอร์ม
            var CompanyID = $('#CompanyID').val();
            var inputRoomID = $('#inputRoomID').val();
            var inputNickName = $('#inputNickName').val();
            var inputPayment = $('#inputPayment').val();
            var inputPayment2 = $('#inputPayment2').val();
            var inputpersonal_code = $('#inputpersonal_code').val();
            var inputName = $('#inputName').val();
            var inputLastName = $('#inputLastName').val();
            var inputPhone = $('#inputPhone').val();
            var inputAddress1 = $('#inputAddress1').val();
            var inputAddress2 = $('#inputAddress2').val();
            var inputAddress3 = $('#inputAddress3').val();
            var inputAddress4 = $('#inputAddress4').val();
            var inputAddress5 = $('#inputAddress5').val();
            var inputAddress6 = $('#inputAddress6').val();
            var inputAddress7 = $('#inputAddress7').val();
            var inputZip = $('#inputZip').val();
            var inputNickName2 = $('#inputNickName2').val();
            var inputPhone2 = $('#inputPhone2').val();
            var inputOther = $('#inputOther').val();
            var confirmDataCheckbox = $('#confirmDataCheckbox').val();
            var acceptContractCheckbox = $('#acceptContractCheckbox').val();
            var imgbase64 = $('#imgbase64').val();

            if (!inputRoomID || !inputNickName || !inputPayment || !inputPayment2 || !inputLastName ||
                !inputpersonal_code || !inputName || !inputPhone || !inputPhone2 ||
                !inputAddress1 || !inputAddress5 || !inputAddress6 || !inputAddress7 || !confirmDataCheckbox || !
                acceptContractCheckbox ||
                !inputZip || !inputNickName2) {
                toastr.warning('กรุณากรอกข้อมูลให้ครบถ้วน', 'แจ้งเตือน!', {
                    timeOut: 3000,
                    progressBar: true,
                    tapToDismiss: false
                });
                $(this).attr('disabled', false);
            } else {
                $.post("{{ route('condition.store') }}", {
                        _token: '{{ csrf_token() }}',
                        CompanyID,
                        inputRoomID,
                        inputNickName,
                        inputPayment,
                        inputPayment2,
                        inputpersonal_code,
                        inputName,
                        inputLastName,
                        inputPhone,
                        inputAddress1,
                        inputAddress2,
                        inputAddress3,
                        inputAddress4,
                        inputAddress5,
                        inputAddress6,
                        inputAddress7,
                        inputZip,
                        inputNickName2,
                        inputPhone2,
                        inputOther,
                        confirmDataCheckbox,
                        acceptContractCheckbox,
                        imgbase64
                    }).done(function(res) {
                        if (res.status === 'success') {
                            // console.log(res);
                            // ถ้าบันทึกสำเร็จ
                            $('#saveCusBtn').attr('disabled', false);
                            sessionStorage.setItem('savedId', res.id);
                            $.post('/set-saved-id', {
                                _token: '{{ csrf_token() }}',
                                savedId: res.id
                            }).done(function() {
                                window.location.href =
                                    '/list-condition/view-doc'; // เปลี่ยนหน้าโดยไม่ต้องมี id บน URL
                            });
                            closeLoading();
                            toastr.success(res.msg, res.title, {
                                timeOut: 3000,
                                progressBar: true,
                                tapToDismiss: false,
                            });
                        } else {
                            toastr.error(res.msg, res.title, {
                                timeOut: 3000,
                                progressBar: true,
                                tapToDismiss: false,
                            });
                        }
                    })
                    .fail(function() {
                        toastr.error('ไม่สามารถบันทึกข้อมูลได้', 'ข้อผิดพลาด', {
                            timeOut: 3000,
                            progressBar: true,
                            tapToDismiss: false,
                        });
                    });
            }
        });

        //button switch
        setStatus = (id) => {
            // openLoading()
            $.ajax({
                type: "method",
                method: "POST",
                url: "{{ route('admin.con-customer.set-active') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                },
                success: function(res) {
                    simple.ajax.reload(null, false);
                    closeLoading();
                    toastr.success('แก้ไขเรียบร้อย', 'แจ้งเตือน!', {
                        timeOut: 3000,
                        progressBar: true,
                        tapToDismiss: false
                    });
                }
            });
        }

        //ลบข้อมูลเมมเบอร์
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
                    $.post("{{ route('admin.con-customer.destroy') }}", data = {
                            _token: '{{ csrf_token() }}',
                            id: id,
                        },
                        function(res) {
                            simple.ajax.reload(null, false);
                            closeLoading();
                            // Swal.fire(res.title, res.msg, res.status);
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
    </script>
@endsection
