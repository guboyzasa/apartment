@extends('admin-layouts.master')

@section('title')
    รายการเรียกเก็บ
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
            รายการเรียกเก็บ
        @endslot
    @endcomponent

    <div class="row">
        <div class="card" id="locationForm" style="display: none;">
            <div class="card-body">
                <div class="col-12">
                    {{-- <p class="font-size-16"><b>เพิ่มหมายเลขชั้น</b></p> --}}
                    <div class="row">
                        @csrf
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label text-start">รายการเรียกเก็บ</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="formInput form-control" id="name" name="name"
                                    placeholder="รายการเรียกเก็บ" required>
                            </div>
                        </div>
                        <div class="col-md-6">
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
                    <button type="button" class="btn btn-success" id="showFormBtn">เพิ่มรายการ</button>
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

                        <!-- ปุ่มค้นหา -->
                        {{-- <div class="col-12 text-center mb-3">
                            <button type="button" class="btn btn-primary w-50" id="filterBtn" onclick="showTableF1()">
                                ค้นหา
                            </button>
                        </div> --}}
                    </div>
                    <div class="table-responsive">
                        <table id="simple_table" class="table table-bordered dt-responsive table-striped nowrap w-100">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>List</th>
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
                    <input type="hidden" class="formEdit form-control" name="list_payment" id="list_payment">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="show_name" class="form-label">รายการเรียกเก็บ</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="formEdit form-control" id="show_name" name="show_name"
                                    placeholder="รายการเรียกเก็บ" required>
                            </div>
                        </div>
                        <div class="col-md-6">
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

        @include('admins.list-payment.showTable')

        //บันทึกการเพิ่มเมมเบอร์
        $('#saveCusBtn').click(function() {
            var name = $('#name').val();
            var company_id = $('#company_id').val();

            if (!name || !company_id) {
                toastr.warning('กรุณากรอกข้อมูลให้ครบถ้วน', 'แจ้งเดือน!', {
                    timeOut: 3000,
                    progressBar: true,
                    tapToDismiss: false
                });
            } else {
                $.post("{{ route('admin.list-payment.add') }}", data = {
                        _token: '{{ csrf_token() }}',
                        name: name,
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
            $('#modal_titles').text('แก้ไขรายการเรียกเก็บ');
            $('#list_payment').val(obj.id);
            $('#show_name').val(obj.name).trigger('change');
            $('#show_company_id').val(obj.company_id).trigger('change');
            $('#simpleModals').modal("show");
        }

        //บันทึกการแก้ไขเมมเบอร์
        $('#editCusBtns').click(function() {
            var id = $('#list_payment').val();
            var name = $('#show_name').val();
            var company_id = $('#show_company_id').val();

            if (!name || !company_id) {
                toastr.warning('กรุณากรอกข้อมูลให้ครบถ้วน', 'แจ้งเดือน!', {
                    timeOut: 3000,
                    progressBar: true,
                    tapToDismiss: false
                });
            } else {
                $.post("{{ route('admin.list-payment.update') }}", data = {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        name: name,
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
                url: "{{ route('admin.list-payment.set-active') }}",
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
                    $.post("{{ route('admin.list-payment.destroy') }}", data = {
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

        $('#filter_company_id').on('change', function() {
            showTableF1(); // เรียกฟังก์ชันค้นหาทันทีที่เปลี่ยน company
        });
    </script>
@endsection
