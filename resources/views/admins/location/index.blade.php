@extends('admin-layouts.master')

@section('title')
    สถานที่ตั้ง
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
            สถานที่ตั้ง
        @endslot
    @endcomponent

    <div class="row">
        <!-- ฟอร์มเพิ่มสถานที่ (ซ่อนอยู่ตั้งแต่เริ่มต้น) -->
        <div class="card" id="locationForm" style="display: none;">
            <div class="card-body">
                <div class="col-12">
                    {{-- <p class="font-size-16"><b>เพิ่มสถานที่</b></p> --}}
                    <div class="row">
                        @csrf
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="name" class="form-label">ชื่อหอพัก</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="formInput form-control" id="name" name="name"
                                    placeholder="ชื่อหอพัก" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="owner" class="form-label">Owner</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="formInput form-control" id="owner" name="owner"
                                    placeholder="Owner" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="address" class="form-label">ที่อยู่ 1</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="formInput form-control" id="address" name="address"
                                    placeholder="ที่อยู่ 1" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="address2" class="form-label">ที่อยู่ 2</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="formInput form-control" id="address2" name="address2"
                                    placeholder="ที่อยู่ 2" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="phone" class="form-label">เบอร์โทร</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="formInput form-control" id="phone" name="phone"
                                    placeholder="เบอร์โทรศัพท์" required>
                            </div>
                        </div>
                        {{-- <div class="col-md-4">
                            <div class="mb-3">
                                <label for="floor_number" class="form-label">จำนวนชั้น</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="formInput form-control" id="floor_number" name="floor_number"
                                    placeholder="จำนวนชั้น" required>
                            </div>
                        </div> --}}
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
                </div>
            </div>
        </div>

        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="text-end mb-3">
                        <button type="button" class="btn btn-success" id="showFormBtn">เพิ่มสถานที่</button>
                    </div>
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="simple_table" class="table table-bordered dt-responsive table-striped nowrap w-100">
                                <thead>
                                    <tr class="text-center">
                                        <th>Name</th>
                                        <th>Owner</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Floor_Number</th>
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
                    @csrf
                    <input type="hidden" class="formEdit form-control" name="id" id="show_id">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="show_name" class="form-label">ชื่อสถานที่</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="formEdit form-control" id="show_name" name="show_name"
                                    placeholder="ชื่อสถานที่">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="show_owner" class="form-label">Owner</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="formEdit form-control" id="show_owner" name="show_owner"
                                    placeholder="Owner">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="show_address" class="form-label">ที่อยู่ 1</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="formEdit form-control" id="show_address"
                                    name="show_address" placeholder="ที่อยู่ 1">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="show_address2" class="form-label">ที่อยู่ 2</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="formEdit form-control" id="show_address2"
                                    name="show_address2" placeholder="ที่อยู่ 2">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="show_phone" class="form-label">เบอร์โทรศัพท์</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="formEdit form-control" id="show_phone" name="name"
                                    placeholder="เบอร์โทรศัพท์">
                            </div>
                        </div>
                        {{-- <div class="col-md-12">
                            <div class="mb-3">
                                <label for="show_floor_number" class="form-label">จำนวนชั้น</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="formEdit form-control" id="show_floor_number" name="show_floor_number"
                                    placeholder="จำนวนชั้น">
                            </div>
                        </div> --}}
                    </div>

                    <div class="mt-3 d-grid">
                        <br>
                        <button class="btn btn-primary waves-effect waves-light" id="editCusBtns" type="button">
                            บันทึก
                        </button>
                    </div>
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

        @include('admins.location.showTable')

        //บันทึกการเพิ่มเมมเบอร์
        $('#saveCusBtn').click(function() {
            var name = $('#name').val();
            var owner = $('#owner').val();
            var address = $('#address').val();
            var address2 = $('#address2').val();
            var phone = $('#phone').val();
            // var floor_number = $('#floor_number').val();

            if (!name || !owner || !address || !address2 || !phone) {
                toastr.warning('กรุณากรอกข้อมูลให้ครบถ้วน', 'แจ้งเดือน!', {
                    timeOut: 3000,
                    progressBar: true,
                    tapToDismiss: false
                });
            } else {
                $.post("{{ route('admin.location.add') }}", data = {
                        _token: '{{ csrf_token() }}',
                        name: name,
                        owner: owner,
                        address: address,
                        address2: address2,
                        phone: phone,
                        // floor_number: floor_number,
                    },
                    function(res) {
                        simple.ajax.reload(null, false);
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
            $('#modal_titles').text('แก้ไขรายการ');
            $('#show_id').val(obj.id);
            $('#show_name').val(obj.name).trigger('change');
            $('#show_owner').val(obj.name_owner).trigger('change');
            $('#show_address').val(obj.address).trigger('change');
            $('#show_address2').val(obj.address2).trigger('change');
            $('#show_phone').val(obj.phone).trigger('change');
            // $('#show_floor_number').val(obj.floor_number).trigger('change');
            $('#simpleModals').modal("show");
        }

        //บันทึกการแก้ไขเมมเบอร์
        $('#editCusBtns').click(function() {
            var id = $('#show_id').val();
            var name = $('#show_name').val();
            var owner = $('#show_owner').val();
            var address = $('#show_address').val();
            var address2 = $('#show_address2').val();
            var phone = $('#show_phone').val();
            // var floor_number = $('#show_floor_number').val();

            if (!name || !owner || !address || !address2 || !phone) {
                toastr.warning('กรุณากรอกข้อมูลให้ครบถ้วน', 'แจ้งเดือน!', {
                    timeOut: 3000,
                    progressBar: true,
                    tapToDismiss: false
                });
            } else {
                $.post("{{ route('admin.location.update') }}", data = {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        name: name,
                        owner: owner,
                        address: address,
                        address2: address2,
                        phone: phone,
                        // floor_number: floor_number,
                    },
                    function(res) {
                        simple.ajax.reload(null, false);
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
                url: "{{ route('admin.location.set-active') }}",
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
                    $.post("{{ route('admin.location.destroy') }}", data = {
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

        document.getElementById('showFormBtn').addEventListener('click', function() {
            const form = document.getElementById('locationForm');
            if (form.style.display === 'none') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        });
    </script>
@endsection
