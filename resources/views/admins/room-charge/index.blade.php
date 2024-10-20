@extends('admin-layouts.master')

@section('title')
RoomCharge
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
        RoomCharge
        @endslot
    @endcomponent

    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="col-12">
                    <div class="row">
                        @csrf
                        {{-- <div class="col-md-8"> --}}
                            <div class="mb-3">
                                <label for="name" class="form-label text-start">Add Room Charge</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="formInput form-control" id="name" value=""
                                    name="name" placeholder="Add Room Charge" required>
                            </div>
                        {{-- </div> --}}
                        {{-- <div class="col-md-3">
                            <div class="mt-0 mb-3">
                                <label for="status" class="form-label">ชั้น</label>
                                <span class="text-danger">*</span>
                                <select name="status" id="status_select" class="form-control">
                                    <option value="">เลือกชั้น</option>
                                    @foreach ($status as $detail)
                                        <option value="{{ $detail->id }}">{{ $detail->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                        {{-- <div class="col-md-1 text-center">
                            <label for="code" class="form-label">Color</label>
                            <span class="text-danger">*</span>
                            <div class="mt-1">
                                <input type="color" class="" id="code" value="#ff0000" name="code"
                                    placeholder="" required>
                            </div>
                        </div> --}}
                    </div>
                    <div class="row">
                        {{-- <div class="col-md-4"></div>
                        <div class="col-md-4 text-center"> --}}
                            <div class="mt-3 d-grid gap-1">
                                <button type="button" class="btn btn-primary waves-effect waves-light"
                                    id="saveCusBtn">บันทึก</button>
                            </div>
                        {{-- </div>
                        <div class="col-md-4"></div> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="col-12">
                        <p class="font-size-16 badge bg-success"><b>RoomCharge</b></p>
                        <div class="table-responsive">
                            <table id="simple_table" class="table table-bordered dt-responsive table-striped nowrap w-100">
                                <thead>
                                    <tr class="text-center">
                                        <th>CREATE</th>
                                        <th>RoomCharge</th>
                                        {{-- <th>FLOOR</th> --}}
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

        {{-- <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active text-success" data-bs-toggle="tab" href="#floor1" role="tab"
                            aria-selected="false" tabindex="-1">
                            <span class="d-block d-sm-none">F1</span>
                            <span class="d-none d-sm-block">Floor 1</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-warning" data-bs-toggle="tab" href="#floor2" role="tab"
                            aria-selected="false" tabindex="-1">
                            <span class="d-block d-sm-none">F2</span>
                            <span class="d-none d-sm-block">Floor 2</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-danger" data-bs-toggle="tab" href="#floor3" role="tab"
                            aria-selected="false" tabindex="-1">
                            <span class="d-block d-sm-none">F3</span>
                            <span class="d-none d-sm-block">Floor 3</span>
                        </a>
                    </li>
                </ul>

                <div class="tab-content p-3 text-muted">
                    <div class="tab-pane active show" id="floor1" role="tabpanel">
                        <div class="col-12">
                            <p class="font-size-16 badge bg-success"><b>Floor 1</b></p>
                            <div class="table-responsive">
                                <table id="simple_table_f1"
                                    class="table table-bordered dt-responsive table-striped nowrap w-100">
                                    <thead>
                                        <tr class="text-center">
                                            <th>CREATE</th>
                                            <th>NAME</th>
                                            <th>FLOOR</th>
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
                    <div class="tab-pane" id="floor2" role="tabpanel">
                        <div class="col-12">
                            <p class="font-size-16 badge bg-warning"><b>Floor 2</b></p>
                            <div class="table-responsive">
                                <table id="simple_table_f2"
                                    class="table table-bordered dt-responsive table-striped nowrap w-100">
                                    <thead>
                                        <tr class="text-center">
                                            <th>CREATE</th>
                                            <th>NAME</th>
                                            <th>FLOOR</th>
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
                    <div class="tab-pane" id="floor3" role="tabpanel">
                        <div class="col-12">
                            <p class="font-size-16 badge bg-danger"><b>Floor 3</b></p>
                            <div class="table-responsive">
                                <table id="simple_table_f3"
                                    class="table table-bordered dt-responsive table-striped nowrap w-100">
                                    <thead>
                                        <tr class="text-center">
                                            <th>CREATE</th>
                                            <th>NAME</th>
                                            <th>FLOOR</th>
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
        </div> --}}

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
                    {{-- <form class="needs-validation" novalidate=""> --}}
                    @csrf
                    <input type="hidden" class="formEdit form-control" name="id" value="" id="room_id">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="name" class="form-label">RoomCharge</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="formEdit form-control" id="show_name" value=""
                                    name="name" placeholder="Add Room Charge">
                            </div>
                        </div>
                        {{-- <div class="col-md-4">
                            <div class="mb-3">
                                <label for="status" class="form-label">ชั้น</label>
                                <span class="text-danger">*</span><br>
                                <select name="status" id="show_status_select" class="form-control" readonly>
                                    @foreach ($status as $detail)
                                        <option value="{{ $detail->id }}">{{ $detail->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                        {{-- <div class="col-md-2 text-center">
                            <div class="mb-0 mt-1">
                                <label for="code" class="form-label">Color</label>
                                <span class="text-danger">*</span><br>
                                <input type="color" class="" id="show_code" value="" name="code"
                                    placeholder="กรอก Color" required>
                            </div>
                        </div> --}}
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

@endsection
@section('script')
    <script>
        $(document).ready(function() {
            var simple = '';
            showTable();

        });

        @include('admins.room-charge.showTable')

        //บันทึกการเพิ่มเมมเบอร์
        $('#saveCusBtn').click(function() {
            var name = $('#name').val();
            // var status_id = $('#status_select').val();
            // var code = $('#code').val();

            if (name == '' || name == null) {
                toastr.warning('กรุณากรอกข้อมูลให้ครบถ้วน', 'แจ้งเดือน!', {
                    timeOut: 3000,
                    progressBar: true,
                    tapToDismiss: false
                });
            } else {
                $.post("{{ route('admin.room-charge.add') }}", data = {
                        _token: '{{ csrf_token() }}',
                        name: name,
                        // status_id: status_id,
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
            $('#modal_titles').text('แก้ไขค่าห้อง');
            $('#room_id').val(obj.id);
            $('#show_name').val(obj.name).trigger('change');
            // $('#show_status_select').val(obj.status_id).trigger('change');
            // $('#show_code').val(obj.code).trigger('change');
            $('#simpleModals').modal("show");
        }

        //บันทึกการแก้ไขเมมเบอร์
        $('#editCusBtns').click(function() {
            var id = $('#room_id').val();
            var name = $('#show_name').val();
            // var status_id = $('#show_status_select').val();
            // var code = $('#show_code').val();

            if (name == '' || name == null) {
                toastr.warning('กรุณากรอกข้อมูลให้ครบถ้วน', 'แจ้งเดือน!', {
                    timeOut: 3000,
                    progressBar: true,
                    tapToDismiss: false
                });
            } else {
                $.post("{{ route('admin.room-charge.update') }}", data = {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        name: name,
                        // status_id: status_id,
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
                url: "{{ route('admin.room-charge.set-active') }}",
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
                    $.post("{{ route('admin.room-charge.destroy') }}", data = {
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
    </script>
@endsection