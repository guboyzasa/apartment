@extends('admin-layouts.master')

@section('title')
    Clear Vendor
@endsection

@section('css')
    <style>
        @media (min-width: 992px) {
            .col-md-center {
                float: none;
                margin-left: auto;
                margin-right: auto;
            }
        }
    </style>
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        @endslot
        @slot('title')
            Clear Vendor
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card" style="border-radius: 10px">
                <div class="card-body">
                    <div class="row">
                        @csrf
                        <div class="mb-3">
                            <select name="vendor" id="vendor" class="form-control">
                                <option value="">Select Vendor</option>
                                @foreach ($vendor as $detail)
                                    <option value="{{ $detail->id }}">{{ $detail->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="container">
                            <div class="row text-center">
                                <div class="col-md-4">
                                    {{-- <div class="container"> --}}
                                    <div class="row bg-danger bg-soft" style="border-radius: 10px;margin:2px">
                                        <label class="text-danger text-center mt-2"><b>SIAMLOT</b></label>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="sm_lot" class="form-label">ยอดได้</label>
                                                <input type="text" class="formInput form-control" id="sm_lot"
                                                    value="0" name="sm_lot" required>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- </div> --}}
                                </div>
                                <div class="col-md-4">
                                    {{-- <div class="container"> --}}
                                    <div class="row bg-success bg-soft" style="border-radius: 10px;margin:2px">
                                        <label class="text-success text-center mt-2"><b>88LOT</b></label>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="pp_lot" class="form-label">ยอดได้</label>
                                                <input type="text" class="formInput form-control" id="pp_lot"
                                                    value="0" name="pp_lot" required>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- </div> --}}
                                </div>
                                <div class="col-md-4">
                                    {{-- <div class="container"> --}}
                                    <div class="row bg-primary bg-soft" style="border-radius: 10px;margin:2px">
                                        <label class="text-primary text-center mt-2"><b>AGNEW</b></label>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="ag_lot" class="form-label">ยอดได้</label>
                                                <input type="text" class="formInput form-control" id="ag_lot"
                                                    value="0" name="ag_lot" required>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="container mt-3">
                            <div class="row text-center">
                                <div class="col-md-4">
                                    {{-- <div class="container"> --}}
                                    <div class="row bg-secondary bg-soft"
                                        style="border-radius: 10px;padding:10px;margin:2px">
                                        <label class="text-secondary text-center mt-0"><b>KEYSUPER</b></label>
                                        <div class="col-md-12">
                                            <div class="mb-1">
                                                <label for="ks_lot" class="form-label">ยอดได้</label>
                                                <input type="text" class="formInput form-control" id="ks_lot"
                                                    value="0" name="ks_lot" required>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- </div> --}}
                                </div>
                                <div class="col-md-4">
                                    {{-- <div class="container"> --}}
                                    <div class="row bg-warning bg-soft" style="border-radius: 10px;padding:10px;margin:2px">
                                        <label class="text-warning text-center mt-0"><b>SUPER99</b></label>
                                        <div class="col-md-12">
                                            <div class="mb-1">
                                                <label for="sp_lot" class="form-label">ยอดได้</label>
                                                <input type="text" class="formInput form-control" id="sp_lot"
                                                    value="0" name="sp_lot" required>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- </div> --}}
                                </div>
                                <div class="col-md-4">
                                    {{-- <div class="container"> --}}
                                    <div class="row bg-info bg-soft" style="border-radius: 10px;padding:10px;margin:2px">
                                        <label class="text-info text-center mt-0"><b>OTHER</b></label>
                                        <div class="col-md-12">
                                            <div class="mb-1">
                                                <label for="ot_lot" class="form-label">ยอดเบิก</label>
                                                <input type="text" class="formInput form-control" id="ot_lot"
                                                    value="0" name="ot_lot" required>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4">
                            <div class="mt-3 d-grid gap-1">
                                <button type="button" class="btn btn-primary waves-effect waves-light"
                                    id="saveCusBtns">บันทึก</button>
                            </div>
                        </div>
                        <div class="col-sm-4"></div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{-- <div class="text-center">
                    <i class='bx bxs-circle font-size-16 text-danger'> เจ้าซ่อม</i> <i class='bx bxs-circle font-size-16 text-success'> ส่งเจ้า</i>
                    </div> --}}
                    <div class="table-responsive">
                        <table id="simple_table" class="table table-bordered dt-responsive  nowrap w-100">
                            <thead>
                                <tr class="text-center">
                                    {{-- <th>DATE</th> --}}
                                    <th>VENDOR</th>
                                    <th>SIAMLOT</th>
                                    <th>88LOTTO</th>
                                    <th>AGNEW</th>
                                    <th>KEYSUPER</th>
                                    <th>SUPER99</th>
                                    <th>OTHER</th>
                                    <th>TOTAL</th>
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

    <!-- Modal Edit -->
    <div class="modal fade" id="simpleModals" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span id="modal_titles"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @csrf
                        <input type="hidden" class="formEdit form-control" name="id" id="id">
                        <div class="mb-3">
                            <label for="name" class="form-label">Vendor</label>
                            <span class="text-danger">*</span>
                            <select name="name" id="show_vendor" class="form-control" readonly>
                                @foreach ($vendor as $detail)
                                    <option value="{{ $detail->id }}">{{ $detail->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="container">
                            <div class="row text-center">
                                <div class="col-md-4">
                                    {{-- <div class="container"> --}}
                                    <div class="row bg-danger bg-soft" style="border-radius: 10px;margin:2px">
                                        <label class="text-danger text-center mt-3">SIAMLOT</label>
                                        <div class="col-md-12">
                                            <div class="mb-4">
                                                <label for="show_sm_lot" class="form-label">ยอดได้</label>
                                                <input type="text" class="formInput form-control" id="show_sm_lot"
                                                    value="0" name="show_sm_lot" required>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- </div> --}}
                                </div>
                                <div class="col-md-4">
                                    {{-- <div class="container"> --}}
                                    <div class="row bg-success bg-soft" style="border-radius: 10px;margin:2px">
                                        <label class="text-success text-center mt-3">88LOT</label>
                                        <div class="col-md-12">
                                            <div class="mb-4">
                                                <label for="show_pp_lot" class="form-label">ยอดได้</label>
                                                <input type="text" class="formInput form-control" id="show_pp_lot"
                                                    value="0" name="show_pp_lot" required>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- </div> --}}
                                </div>
                                <div class="col-md-4">
                                    {{-- <div class="container"> --}}
                                    <div class="row bg-primary bg-soft" style="border-radius: 10px;margin:2px">
                                        <label class="text-primary text-center mt-3">AGNEW</label>
                                        <div class="col-md-12">
                                            <div class="mb-4">
                                                <label for="show_ag_lot" class="form-label">ยอดได้</label>
                                                <input type="text" class="formInput form-control" id="show_ag_lot"
                                                    value="0" name="show_ag_lot" required>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- </div> --}}
                                </div>

                            </div>
                        </div>
                        <hr class="text-white">
                        <div class="container">
                            <div class="row text-center">
                                <div class="col-md-4">
                                    {{-- <div class="container"> --}}
                                    <div class="row bg-secondary bg-soft" style="border-radius: 10px;margin:2px">
                                        <label class="text-secondary text-center mt-3">KEYSUPER</label>
                                        <div class="col-md-12">
                                            <div class="mb-4">
                                                <label for="show_ks_lot" class="form-label">ยอดได้</label>
                                                <input type="text" class="formInput form-control" id="show_ks_lot"
                                                    value="0" name="show_ks_lot" required>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- </div> --}}
                                </div>
                                <div class="col-md-4">
                                    {{-- <div class="container"> --}}
                                    <div class="row bg-warning bg-soft" style="border-radius: 10px;margin:2px">
                                        <label class="text-warning text-center mt-3">SUPER99</label>
                                        <div class="col-md-12">
                                            <div class="mb-4">
                                                <label for="show_sp_lot" class="form-label">ยอดได้</label>
                                                <input type="text" class="formInput form-control" id="show_sp_lot"
                                                    value="0" name="show_sp_lot" required>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- </div> --}}
                                </div>
                                <div class="col-md-4">
                                    {{-- <div class="container"> --}}
                                    <div class="row bg-info bg-soft" style="border-radius: 10px;margin:2px">
                                        <label class="text-info text-center mt-3">OTHER</label>
                                        <div class="col-md-12">
                                            <div class="mb-4">
                                                <label for="show_ot_lot" class="form-label">ยอดได้</label>
                                                <input type="text" class="formInput form-control" id="show_ot_lot"
                                                    value="0" name="show_ot_lot" required>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <hr class="text-white"> --}}
                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="button" class="btn btn-primary waves-effect waves-light"
                            id="editCusBtns">บันทึก</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                    [1, "desc"]
                ],
                "ajax": {
                    "url": "{{ route('admin.store-vendor.list') }}",
                    "method": "GET",
                    "data": {
                        "_token": "{{ csrf_token() }}",
                    },
                },
                'columnDefs': [{
                    "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                    "className": "text-center",
                }, ],
                "columns": [
                    // {
                    //     "data": "created_at",
                    //     "render": function(data, type, full) {
                    //         return moment(data).format('DD-MM-YYYY HH:mm')
                    //     }
                    // },

                    {
                        "data": "id",
                        "render": function(data, type, full) {
                            var date = moment(full.created_at).format('DD-MM-YYYY HH:mm');
                            var text = ``;
                            if (full.is_active == 0) {
                                text = `
                            <span>${date}</span><br>
                            <span class="badge text-dark text-center font-size-12">${full.vendor.name}</span><i class='bx bx-check-double bx-tada' style="color: ${full.vendor.code}"></i>
                            <span class="badge bg-success text-white text-center font-size-13">ส่งยอดแล้ว</span><br>
                             `
                            } else {
                                text = `
                            <span>${date}</span><br>
                            <span class="badge text-dark text-center font-size-12">${full.vendor.name}</span><i class='bx bx-check-double bx-tada' style="color: ${full.vendor.code}"></i>
                            <span class="badge bg-danger text-white text-center font-size-13">ค้างส่งยอด</span><br>

                             `
                            }
                            return text;
                        }
                    },

                    {
                        "data": "siam_total",
                        "render": function(data, type, full) {
                            var text = addCommas(data);
                            return text;
                        }
                    },

                    {
                        "data": "pp_total",
                        "render": function(data, type, full) {
                            var text = addCommas(data);
                            return text;
                        }
                    },

                    {
                        "data": "ag_total",
                        "render": function(data, type, full) {
                            var text = addCommas(data);
                            return text;
                        }
                    },

                    {
                        "data": "ks_total",
                        "render": function(data, type, full) {
                            var text = addCommas(data);
                            return text;
                        }
                    },

                    {
                        "data": "sp_total",
                        "render": function(data, type, full) {
                            var text = addCommas(data);
                            return text;
                        }
                    },

                    {
                        "data": "other_total",
                        "render": function(data, type, full) {
                            var text = addCommas(data);
                            return text;
                        }
                    },

                    {
                        "data": "id",
                        "render": function(data, type, full) {
                            var text = ``;
                            if (full.all_total < 0) {
                                text =
                                    `
                                <span class="badge bg-success text-white text-center">เจ้าซ่อม</span><br>
                                <b class="number text-success">${-full.all_total}</b>
                                `
                            } else {
                                text =
                                    `
                                <span class="badge bg-danger text-white text-center">ส่งเจ้า</span><br>
                                <b class="text-danger">${-full.all_total}</b>
                                
                                `
                            }
                            text = addCommas(text);
                            return text;
                        }
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

        //บันทึกการเพิ่มvendor
        $('#saveCusBtns').click(function() {
            var vendor = $('#vendor').val();
            var sm_lot = $('#sm_lot').val();
            var pp_lot = $('#pp_lot').val();
            var ag_lot = $('#ag_lot').val();
            var ks_lot = $('#ks_lot').val();
            var sp_lot = $('#sp_lot').val();
            var ot_lot = $('#ot_lot').val();

            if (vendor == '' || vendor == null) {
                Swal.fire('แจ้งเตือน!', 'กรุณากรอกข้อมูลให้ครบถ้วน ', 'warning');
            } else {
                $.post("{{ route('admin.store-vendor.add') }}", data = {
                        _token: '{{ csrf_token() }}',
                        vendor: vendor,
                        sm_lot: sm_lot,
                        pp_lot: pp_lot,
                        ag_lot: ag_lot,
                        ks_lot: ks_lot,
                        sp_lot: sp_lot,
                        ot_lot: ot_lot,
                    },
                    function(res) {
                        simple.ajax.reload();
                        Swal.fire(res.title, res.msg, res.status);
                        // $('#simpleModal').modal("hide");
                        location.reload();
                        closeLoading();

                    },
                );
            }
        });

        //บันทึกการเพิ่มยอด
        $('#editCusBtns').click(function() {
            var id = $('#id').val();
            var vendor = $('#show_vendor').val();
            var sm_lot = $('#show_sm_lot').val();
            var pp_lot = $('#show_pp_lot').val();
            var ag_lot = $('#show_ag_lot').val();
            var ks_lot = $('#show_ks_lot').val();
            var sp_lot = $('#show_sp_lot').val();
            var ot_lot = $('#show_ot_lot').val();

            if (vendor == '' || vendor == null) {
                Swal.fire('แจ้งเตือน!', 'กรุณากรอกข้อมูลให้ครบถ้วน ', 'warning');
            } else {
                $.post("{{ route('admin.store-vendor.update') }}", data = {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        vendor: vendor,
                        sm_lot: sm_lot,
                        pp_lot: pp_lot,
                        ag_lot: ag_lot,
                        ks_lot: ks_lot,
                        sp_lot: sp_lot,
                        ot_lot: ot_lot,
                    },
                    function(res) {
                        simple.ajax.reload();
                        Swal.fire(res.title, res.msg, res.status);
                        $('#simpleModals').modal("hide");
                        // location.reload();
                        closeLoading();

                    },
                );
            }
        });

        function showInfo(obj) {
            $('#modal_titles').text('แก้ไขยอด');
            $('#id').val(obj.id);
            $('#show_vendor').val(obj.vendor_id).trigger('change');
            $('#show_sm_lot').val(obj.siam_total).trigger('change');
            $('#show_pp_lot').val(obj.pp_total).trigger('change');
            $('#show_ag_lot').val(obj.ag_total).trigger('change');
            $('#show_ks_lot').val(obj.ks_total).trigger('change');
            $('#show_sp_lot').val(obj.sp_total).trigger('change');
            $('#show_ot_lot').val(obj.other_total).trigger('change');

            $('#simpleModals').modal("show");
        }

        //เช็ค ลบข้อมูลยอด
        function destroy(id) {
            Swal.fire({
                title: 'คุณมั่นใจหรือไม่ ?',
                text: 'ที่จะลบยอดนี้',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#7A7978',
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก',

            }).then((result) => {
                if (result.isConfirmed) {
                    // openLoading();
                    $.post("{{ route('admin.store-vendor.destroy') }}", data = {
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

        //button switch
        setStatus = (id) => {
            // openLoading()
            $.ajax({
                type: "method",
                method: "POST",
                url: "{{ route('admin.store-vendor.set-active') }}",
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
    </script>
@endsection
