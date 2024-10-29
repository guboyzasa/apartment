@extends('admin-layouts.master')

@section('title')
    ราคา/หน่วย
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
            ราคา/หน่วย
        @endslot
    @endcomponent

    <div class="row">
        <div class="card" id="locationForm" style="display: none;">
            <div class="card-body">
                <div class="col-12">
                    <p class="font-size-16"><b>เพิ่มราคา/หน่วย</b></p>
                    <div class="row">
                        @csrf
                        <div class="mb-3">
                            <label for="room_rate" class="form-label text-start">ราคา/หน่วย</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="formInput form-control" id="room_rate" value=""
                                name="room_rate" placeholder="ราคา/หน่วย" required>
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
                </div>
            </div>
        </div>

        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="text-end mb-3">
                        <button type="button" class="btn btn-success" id="showFormBtn">เพิ่มราคา/หน่วย</button>
                    </div>
                    <div class="col-12">
                        <div class="row gy-3">
                            <!-- สถานที่ -->
                            <div class="col-md-12 mb-3">
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
                        </div>
                        <div class="table-responsive">
                            <table id="simple_table" class="table table-bordered dt-responsive table-striped nowrap w-100">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>วันที่สร้าง</th>
                                        <th>รายการ</th>
                                        <th>ราคา/หน่วย</th>
                                        <th>Com</th>
                                        <th>สถานะ</th>
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
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel"><span id="modal_titles"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" class="formEdit form-control" name="id" value="" id="room_id">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="room_rate" class="form-label">ราคา/หน่วย</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="formEdit form-control" id="show_room_rate" value=""
                                    name="room_rate" placeholder="ราคา/หน่วย">
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

        @include('admins.room-rates.showTable')

        //บันทึกการเพิ่มเมมเบอร์
        $('#saveCusBtn').click(function() {
            var room_rate = $('#room_rate').val();
            // var floor_id = $('#floor_select').val();
            // var code = $('#code').val();

            if (!room_rate) {
                toastr.warning('กรุณากรอกข้อมูลให้ครบถ้วน', 'แจ้งเดือน!', {
                    timeOut: 3000,
                    progressBar: true,
                    tapToDismiss: false
                });
            } else {
                $.post("{{ route('admin.room-rates.add') }}", data = {
                        _token: '{{ csrf_token() }}',
                        room_rate: room_rate,
                        // floor_id: floor_id,
                        // code: code,
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
            $('#modal_titles').text('แก้ไขราคา/หน่วย');
            $('#room_id').val(obj.id);
            $('#show_room_rate').val(obj.room_rate).trigger('change');
            // $('#show_floor_select').val(obj.floor_id).trigger('change');
            // $('#show_code').val(obj.code).trigger('change');
            $('#simpleModals').modal("show");
        }

        //บันทึกการแก้ไขเมมเบอร์
        $('#editCusBtns').click(function() {
            var id = $('#room_id').val();
            var room_rate = $('#show_room_rate').val();
            // var floor_id = $('#show_floor_select').val();
            // var code = $('#show_code').val();

            if (!room_rate) {
                toastr.warning('กรุณากรอกข้อมูลให้ครบถ้วน', 'แจ้งเดือน!', {
                    timeOut: 3000,
                    progressBar: true,
                    tapToDismiss: false
                });
            } else {
                $.post("{{ route('admin.room-rates.update') }}", data = {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        room_rate: room_rate,
                        // floor_id: floor_id,
                        // code: code,
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
                url: "{{ route('admin.room-rates.set-active') }}",
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
                    $.post("{{ route('admin.room-rates.destroy') }}", data = {
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

        $('#filter_company_id').on('change', function() {
            showTable(); // เรียกฟังก์ชันค้นหาทันทีที่เปลี่ยน company
        });
    </script>
@endsection
