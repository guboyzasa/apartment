@extends('admin-layouts.master')

@section('title')
    หมายเลขห้องพัก
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
            หมายเลขห้องพัก
        @endslot
    @endcomponent

    <div class="row">
        <div class="card" id="locationForm" style="display: none;">
            <div class="card-body">
                <div class="col-12">
                    <p class="font-size-16"><b>เพิ่มหมายเลขห้องพัก</b></p>
                    <div class="row">
                        @csrf
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="room_number" class="form-label text-start">หมายเลขห้องพัก</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="formInput form-control" id="room_number" name="room_number"
                                    placeholder="หมายเลขห้องพัก" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mt-0 mb-3">
                                <label for="company_id" class="form-label">เลือกสถานที่</label>
                                <span class="text-danger">*</span>
                                <select name="company_id" id="company_id" class="form-control" required>
                                    <option disabled selected>เลือกสถานที่</option>
                                    @foreach ($company as $detail)
                                        <option value="{{ $detail->id }}">{{ $detail->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mt-0 mb-3">
                                <label for="floor_id" class="form-label">เลือกชั้น</label>
                                <span class="text-danger">*</span>
                                <select name="floor_id" id="floor_id" class="form-control" required>
                                    <option disabled selected>เลือกชั้น</option>
                                    <!-- ชั้นที่ดึงมาจะถูกเพิ่มที่นี่ -->
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4 text-center">
                            <div class="mt-3 d-grid gap-1">
                                <button type="button" class="btn btn-primary waves-effect waves-light"
                                    id="saveCusBtn">บันทึก</button>
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="text-end mb-3">
                    <button type="button" class="btn btn-success" id="showFormBtn">เพิ่มห้องพัก</button>
                </div>
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
                            <button type="button" class="btn btn-primary w-50" id="filterBtn" onclick="showTableF1()">
                                ค้นหา
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="simple_table_f1" class="table table-bordered dt-responsive table-striped nowrap w-100">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Room</th>
                                    <th>Floor</th>
                                    <th>Company</th>
                                    <th>Status</th>
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

    </div> <!-- end row -->

    {{-- Modals edit --}}
    <div class="modal fade update-profile" id="simpleModals" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel"><span id="modal_titles"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" class="formEdit form-control" name="id" id="room_id">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="show_room_number" class="form-label">หมายเลขห้องพัก</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="formEdit form-control" id="show_room_number"
                                    name="room_number" placeholder="หมายเลขห้องพัก" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mt-0 mb-3">
                                <label for="show_company_id" class="form-label">เลือกสถานที่</label>
                                <span class="text-danger">*</span>
                                <select name="show_company_id" id="show_company_id" class="form-control">
                                    @foreach ($company as $detail)
                                        <option value="{{ $detail->id }}">{{ $detail->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="show_floor_id" class="form-label">ชั้น</label>
                                <span class="text-danger">*</span><br>
                                <select name="show_floor_id" id="show_floor_id" class="form-control">
                                    <option disabled selected>เลือกชั้น</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 d-grid">
                        <br>
                        <button class="btn btn-primary waves-effect waves-light" id="editCusBtns" type="button">
                            บันทึก
                        </button>
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

        @include('admins.room.showTable')

        //บันทึกการเพิ่มเมมเบอร์
        $('#saveCusBtn').click(function() {
            var room_number = $('#room_number').val();
            var floor_id = $('#floor_id').val();
            var company_id = $('#company_id').val();

            if (!room_number || !floor_id || !company_id) {
                toastr.warning('กรุณากรอกข้อมูลให้ครบถ้วน', 'แจ้งเดือน!', {
                    timeOut: 3000,
                    progressBar: true,
                    tapToDismiss: false
                });
            } else {
                $.post("{{ route('admin.room.add') }}", data = {
                        _token: '{{ csrf_token() }}',
                        room_number: room_number,
                        floor_id: floor_id,
                        company_id: company_id,
                    },
                    function(res) {
                        simpleF1.ajax.reload(null, false);
                        // simpleF2.ajax.reload(null, false);
                        // simpleF3.ajax.reload(null, false);
                        // Swal.fire(res.title, res.msg, res.status);
                        // location.reload();
                        closeLoading();
                        toastr.success(res.msg, res.title, {
                            timeOut: 3000,
                            progressBar: true,
                            tapToDismiss: false
                        });
                    },
                );
            }
        });

        //show ข้อมูลเมมเบอร์ modals
        function showInfo(obj) {
            $('#modal_titles').text('แก้ไขหมายเลขห้องพัก');
            $('#room_id').val(obj.id);
            $('#show_room_number').val(obj.room_number).trigger('change');
            $('#show_floor_id').val(obj.floor_id).trigger('change');
            $('#show_company_id').val(obj.company_id).trigger('change');
            $('#simpleModals').modal("show");
        }

        //บันทึกการแก้ไขเมมเบอร์
        $('#editCusBtns').click(function() {
            var id = $('#room_id').val();
            var room_number = $('#show_room_number').val();
            var floor_id = $('#show_floor_id').val();
            var company_id = $('#show_company_id').val();

            if (!room_number || !floor_id || !company_id) {
                toastr.warning('กรุณากรอกข้อมูลให้ครบถ้วน', 'แจ้งเดือน!', {
                    timeOut: 3000,
                    progressBar: true,
                    tapToDismiss: false
                });
            } else {
                $.post("{{ route('admin.room.update') }}", data = {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        room_number: room_number,
                        floor_id: floor_id,
                        company_id: company_id,
                    },
                    function(res) {
                        simpleF1.ajax.reload(null, false);
                        // simpleF2.ajax.reload(null, false);
                        // simpleF3.ajax.reload(null, false);
                        // Swal.fire(res.title, res.msg, res.status);
                        $('#simpleModals').modal("hide");
                        closeLoading();
                        toastr.success(res.msg, res.title, {
                            timeOut: 3000,
                            progressBar: true,
                            tapToDismiss: false
                        });
                    },
                );
            }
        });

        //button switch
        setStatus = (id) => {
            // openLoading()
            $.ajax({
                type: "method",
                method: "POST",
                url: "{{ route('admin.room.set-active') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                },
                success: function(res) {
                    simpleF1.ajax.reload(null, false);
                    // simpleF2.ajax.reload(null, false);
                    // simpleF3.ajax.reload(null, false);
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
                text: 'ที่จะลบเมมเบอร์นี้',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#7A7978',
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก',

            }).then((result) => {
                if (result.isConfirmed) {
                    $.post("{{ route('admin.room.destroy') }}", data = {
                            _token: '{{ csrf_token() }}',
                            id: id,
                        },
                        function(res) {
                            simpleF1.ajax.reload(null, false);
                            // simpleF2.ajax.reload(null, false);
                            // simpleF3.ajax.reload(null, false);
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

        document.getElementById('showFormBtn').addEventListener('click', function() {
            const form = document.getElementById('locationForm');
            if (form.style.display === 'none') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        });

        $('#company_id').on('change', function() {
            var companyId = $(this).val();
            var floorSelect = $('#floor_id');

            // ล้างตัวเลือกเก่า
            floorSelect.empty();
            // floorSelect.append('<option disabled selected>กำลังโหลด...</option>');

            // เรียก AJAX เพื่อดึงข้อมูลชั้น
            $.ajax({
                type: 'POST',
                url: '{{ route('admin.store.get-floors') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    company_id: companyId
                },
                success: function(floors) {
                    floorSelect.empty(); // ล้างตัวเลือก
                    if (floors.length > 0) {
                        floorSelect.append('<option disabled selected>เลือกชั้น</option>');
                        $.each(floors, function(index, floor) {
                            floorSelect.append(
                                `<option value="${floor.id}">${floor.name}</option>`
                            );
                        });
                    } else {
                        floorSelect.append('<option disabled>ไม่มีชั้นในบริษัทนี้</option>');
                    }
                },
                error: function() {
                    floorSelect.empty();
                    floorSelect.append('<option disabled>เกิดข้อผิดพลาด</option>');
                }
            });
        });

        $('#show_company_id').on('change', function() {
            var companyId = $(this).val(); // รับ company_id
            var floorSelect = $('#show_floor_id');

            // ล้างตัวเลือกเก่า
            floorSelect.empty();
            // floorSelect.append('<option disabled selected>กำลังโหลด...</option>');

            // เรียก AJAX เพื่อดึงข้อมูลชั้น
            $.ajax({
                type: 'POST',
                url: '{{ route('admin.store.get-floors') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    company_id: companyId
                },
                success: function(floors) {
                    floorSelect.empty(); // ล้างตัวเลือก
                    if (floors.length > 0) {
                        floorSelect.append('<option disabled selected>เลือกชั้น</option>');
                        $.each(floors, function(index, floor) {
                            floorSelect.append(
                                `<option value="${floor.id}">${floor.name}</option>`
                            );
                        });
                    } else {
                        floorSelect.append(
                            '<option disabled>ไม่มีชั้นในบริษัทนี้</option>');
                    }
                },
                error: function() {
                    floorSelect.empty();
                    floorSelect.append('<option disabled>เกิดข้อผิดพลาด</option>');
                }
            });
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
    </script>
@endsection
