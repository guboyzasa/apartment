@extends('admin-layouts.master')

@section('title')
    เงื่อนไขสัญญาเช่า
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
            เงื่อนไขสัญญาเช่า
        @endslot
    @endcomponent

    <div class="row">
        <div class="card" id="locationForm" style="display: none;">
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        @csrf
                        <div class="mb-3">
                            <label for="point" class="form-label">หัวข้อ</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="formInput form-control" id="point" name="point"
                                value="หัวข้อ " placeholder="เงื่อนไขสัญญาเช่า" required>
                        </div>
                        <div class="mb-3">
                            <label for="info" class="form-label">เงื่อนไขสัญญาเช่า</label>
                            <span class="text-danger">*</span>
                            <textarea class="formInput form-control" id="info" rows="5" placeholder="เงื่อนไขสัญญาเช่า"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4 text-center">
                            <div class="mt-3 d-grid gap-2">
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
                    <div class="col-12">
                        {{-- <p class="font-size-16"><b>เงื่อนไขสัญญาเช่า</b></p> --}}
                        <div class="text-end mb-3">
                            <button type="button" class="btn btn-success" id="showFormBtn">เพิ่มสัญญาเช่า</button>
                        </div>
                        <div class="table-responsive">
                            <table id="simple_table" class="table table-bordered dt-responsive table-striped nowrap w-100">
                                <thead>
                                    <tr class="text-center">
                                        <th>CREATE</th>
                                        <th>POINT</th>
                                        <th>INFO</th>
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
                    <input type="hidden" class="formEdit form-control" name="condition_id" id="condition_id">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="show_point" class="form-label">หัวข้อ</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="formEdit form-control" id="show_point" name="show_point">
                            </div>
                            <div class="mb-3">
                                <label for="show_info" class="form-label">เงื่อนไขสัญญาเช่า</label>
                                <span class="text-danger">*</span>
                                <textarea class="formEdit form-control" id="show_info" rows="5" placeholder="หมายเหตุอื่นๆ"></textarea>

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

        @include('admins.condition.showTable')

        //บันทึกการเพิ่มเมมเบอร์
        $('#saveCusBtn').click(function() {
            var point = $('#point').val();
            var info = $('#info').val();
            if (!point || !info) {
                toastr.warning('กรุณากรอกข้อมูลให้ครบถ้วน', 'แจ้งเดือน!', {
                    timeOut: 3000,
                    progressBar: true,
                    tapToDismiss: false
                });
            } else {
                $.post("{{ route('admin.condition.add') }}", data = {
                        _token: '{{ csrf_token() }}',
                        point: point,
                        info: info,
                    },
                    function(res) {
                        simple.ajax.reload(null, false);
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
            $('#condition_id').val(obj.id);
            $('#show_point').val(obj.point).trigger('change');
            $('#show_info').val(obj.info).trigger('change');
            $('#simpleModals').modal("show");
        }

        //บันทึกการแก้ไขเมมเบอร์
        $('#editCusBtns').click(function() {
            var id = $('#condition_id').val();
            var point = $('#show_point').val();
            var info = $('#show_info').val();

            if (!point || !info) {
                toastr.warning('กรุณากรอกข้อมูลให้ครบถ้วน', 'แจ้งเดือน!', {
                    timeOut: 3000,
                    progressBar: true,
                    tapToDismiss: false
                });
            } else {
                $.post("{{ route('admin.condition.update') }}", data = {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        point: point,
                        info: info,
                    },
                    function(res) {
                        simple.ajax.reload(null, false);
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
                url: "{{ route('admin.condition.set-active') }}",
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
                    $.post("{{ route('admin.condition.destroy') }}", data = {
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
        })
    </script>
@endsection
