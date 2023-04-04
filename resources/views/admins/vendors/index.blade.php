@extends('admin-layouts.master')

@section('title')
    Vendor
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
            Vendor
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @csrf
                        <div class="col-md-10">
                            <div class="mb-3">
                                <label for="name" class="form-label text-start">Add Vendor</label>
                                <span class="text-danger">*</span>
                                <input type="text" class="formInput form-control" id="name" value=""
                                    name="name" placeholder="Add Vendor" required>
                            </div>
                        </div>
                        <div class="col-md-2 text-center">
                            <div class="mb-0">
                                <label for="code" class="form-label">Add Color</label>
                                <span class="text-danger">*</span><br>
                                <input type="color" class="mt-1" id="code" value="#ff0000" name="code"
                                    placeholder="" required>
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
                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{-- <button type="button" class="btn btn-warning create_btn" style="float: right;"><i
                            class="bx bx-plus"></i>
                        Add Vendor
                    </button>
                    <br>
                    <br>
                    <br> --}}
                    <div class="table-responsive">
                        <table id="simple_table" class="table table-bordered dt-responsive  nowrap w-100">
                            <thead>
                                <tr class="text-center">
                                    <th>CREATE</th>
                                    <th>COLOR</th>
                                    <th>NAME</th>
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
        </div> <!-- end col -->
    </div> <!-- end row -->


    {{-- edit --}}
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
                    <input type="hidden" class="formEdit form-control" name="id" value="" id="customer_id">
                    <div class="row">
                        <div class="col-md-10">
                        <div class="mb-3">
                            <label for="name" class="form-label">Vendor</label>
                            <span class="text-danger">*</span>
                            <input type="text" class="formEdit form-control" id="show_name" value="" name="name"
                                placeholder="Add Vendor" required>
                        </div>
                        </div>
                        <div class="col-md-2 text-center">
                        <div class="mb-3 mt-1">
                            <label for="code" class="form-label">Color</label>
                            <span class="text-danger">*</span><br>
                            <input type="color" class="" id="show_code" value="" name="code"
                                placeholder="กรอก Color" required>
                        </div>
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
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            var simple = '';
            showTable();
        });

        showTable = () => {
            simple = $('#simple_table').DataTable({
                "processing": false,
                "serverSide": false,
                "info": false,
                "searching": true,
                "responsive": false,
                "bFilter": false,
                "destroy": true,
                "order": [
                    [0, "desc"]
                ],
                "ajax": {
                    "url": "{{ route('admin.vendor.list') }}",
                    "method": "GET",
                    "data": {
                        "_token": "{{ csrf_token() }}",
                    },
                },
                'columnDefs': [{
                    "targets": [0, 1, 2, 3, 4],
                    "className": "text-center",
                }, ],
                "columns": [

                    {
                        "data": "created_at",
                        "render": function(data, type, full) {
                            return moment(data).format('DD-MM-YYYY HH:mm')
                        }
                    },

                    {
                        "data": "code",
                        "render": function(data, type, full) {
                            var text =
                                `<i class='bx bxs-circle font-size-16' style="color: ${full.code}"></i>`
                            return text;
                        }
                    },

                    {
                        "data": "name",
                    },

                    {
                        "data": "is_active",
                        "render": function(data, type, full) {
                            var text = ``;
                            if (data == 1) {
                                text =
                                    `<input type="checkbox" class="custom-control-input" onclick="setStatus(${full.id})" id="switch${full.id}" switch="primary" checked />
                                    <label for="switch${full.id}" class="custom-control-input" data-on-label="เปิด" data-off-label="ปิด"></label>`;
                            } else {
                                text =
                                    `<input type="checkbox" class="custom-control-input" onclick="setStatus(${full.id})" id="switch${full.id}" switch="primary"  />
                                    <label for="switch${full.id}" class="custom-control-input" data-on-label="เปิด" data-off-label="ปิด"></label>`;
                            }
                            return text;
                        }
                    },

                    {
                        "data": "id",
                        "render": function(data, type, full) {
                            var obj = JSON.stringify(full);
                            var button = `

                            <button type="button" class="btn btn-sm btn-info" onclick='showInfo(${obj})'><i class="bx bx-search"></i> </button>
                            <button type="button" class="btn btn-sm btn-danger" onclick='destroy(${data})'><i class="bx bx-trash"></i>  </button>
                            
                            `;
                            return button;

                        }
                    },
                ],
            });
        }

        //modalsเพิ่ม Vendor ใหม่
        // $(".create_btn").click(function() {
        //     $('#modal_title').text('แก้ไข Vendor ');
        //     $('.formInput').val('');
        //     $('#simpleModal').modal("show");
        // });

        //บันทึกการเพิ่ม Vendor 
        $('#saveCusBtn').click(function() {
            var name = $('#name').val();
            var code = $('#code').val();

            if (name == '' || name == null || code == '' || code == null) {
                Swal.fire('แจ้งเตือน!', 'กรุณากรอกข้อมูลให้ครบถ้วน ', 'warning');
            } else {
                $.post("{{ route('admin.vendor.add') }}", data = {
                        _token: '{{ csrf_token() }}',
                        name: name,
                        code: code,

                    },
                    function(res) {
                        simple.ajax.reload();
                        Swal.fire(res.title, res.msg, res.status);
                        location.reload();
                        closeLoading();

                    },
                );
            }
        });

        //show ข้อมูล Vendor  modals
        function showInfo(obj) {
            $('#modal_titles').text('แก้ไข Vendor ');
            $('#customer_id').val(obj.id);
            $('#show_name').val(obj.name).trigger('change');
            $('#show_code').val(obj.code).trigger('change');
            $('#simpleModals').modal("show");
        }

        //บันทึกการแก้ไข Vendor 
        $('#editCusBtns').click(function() {
            var id = $('#customer_id').val();
            var name = $('#show_name').val();
            var code = $('#show_code').val();

            if (name == '' || name == null || code == '' || code == null) {
                Swal.fire('แจ้งเตือน!', 'กรุณากรอกข้อมูลให้ครบถ้วน ', 'warning');
            } else {
                $.post("{{ route('admin.vendor.update') }}", data = {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        name: name,
                        code: code,

                    },
                    function(res) {
                        simple.ajax.reload();
                        Swal.fire(res.title, res.msg, res.status);
                        $('#simpleModals').modal("hide");
                        closeLoading();

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
                url: "{{ route('admin.vendor.set-active') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                },
                success: function(res) {
                    closeLoading()
                    simple.ajax.reload();
                }
            });
        }

        //ลบข้อมูล Vendor 
        function destroy(id) {
            Swal.fire({
                title: 'คุณมั่นใจหรือไม่ ?',
                text: 'ที่จะลบ Vendor นี้',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#7A7978',
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก',

            }).then((result) => {
                if (result.isConfirmed) {
                    // openLoading();
                    $.post("{{ route('admin.vendor.destroy') }}", data = {
                            _token: '{{ csrf_token() }}',
                            id: id,
                        },
                        function(res) {
                            simple.ajax.reload();
                            closeLoading();
                            Swal.fire(res.title, res.msg, res.status);
                        },
                    );

                }
            });
        }
    </script>
@endsection
