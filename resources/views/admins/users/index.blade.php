@extends('admin-layouts.master')

@section('title')
    Manage User
@endsection

@section('css')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        @endslot
        @slot('title')
            Manage User
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <div>
                        <h4>Filter</h4>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="">User</label>
                            <select name="user" id="search_user" class="form-control">
                                <option value="">ALL</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-6">
                            <label for="">Company</label>

                            <select name="company" id="search_company" class="form-control">
                                <option value="">ALL</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->code }} |
                                        {{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="simple_table" class="table table-bordered dt-responsive  nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Company</th>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Created At</th>
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
        </div> <!-- end col -->
    </div> <!-- end row -->


    <div class="modal fade update-profile" id="simpleModal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel"><span id="modal_title"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">

                    <div class="modal-body">
                        <p class="mb-2">Request Code: #<span class="text-primary" id="show_code"></span></p>
                        <p class="mb-2">Company Code: <span class="text-primary" id="show_company_code"></span></p>
                        <p class="mb-2">Company Name: <span class="text-primary" id="show_company_name"></span></p>

                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap">
                                <thead>
                                    <tr>
                                        <th scope="col">Package Name</th>
                                        <th scope="col">Price Per Month</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                        <td>
                                            <div>
                                                <h5 class="text-truncate font-size-14"> <span id="show_package"></span>
                                                </h5>
                                                <p class="text-muted mb-0">฿ <span id="show_package_price"> </span> x <span
                                                        id="show_package_month"></span> month</p>
                                            </div>
                                        </td>
                                        <td>฿ <span class="show_total_amount"> </span></td>
                                    </tr>

                                    <tr>
                                        <td colspan="1">
                                            <h6 class="m-0 text-right">Request Date:</h6>
                                        </td>
                                        <td>
                                            <span id="show_request_date"></span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="1">
                                            <h6 class="m-0 text-right">Total:</h6>
                                        </td>
                                        <td>
                                            ฿ <span class="show_total_amount"></span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="1">
                                            <h6 class="m-0 text-right">Image:</h6>
                                        </td>
                                        <td>
                                            <a href="" target="_blank" id="show_img">slip image</a>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td colspan="1">
                                            <h6 class="m-0 text-right">Status:</h6>
                                        </td>
                                        <td>
                                            <span id="show_status"></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <input type="hidden" name="request_id" id="request_id">
                    <button type="button" class="btn btn-primary" data-loading-text="Loading..."
                        onclick="setStatus('APPROVE')">Approve</button>
                    <button type="button" class="btn btn-danger" data-loading-text="Loading..."
                        onclick="setStatus('CANCEL')">Cancel</button>
                    <button type="button" class="btn btn-secondary" class="btn-close"
                        data-bs-dismiss="modal">Close</button>
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

        $('body').on('change', '#search_user', function(event) {
            showTable();
        });

        $('body').on('change', '#search_company', function(event) {
            showTable();
        });


        showTable = () => {
            let search_company = $('#search_company').val()
            let search_user = $('#search_user').val()
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
                    "url": "{{ route('admin.user.list') }}",
                    "method": "GET",
                    "data": {
                        "_token": "{{ csrf_token() }}",
                        "search_company": search_company,
                        "search_user": search_user,

                    },
                },
                'columnDefs': [{
                    "targets": [0, 1, 2, 3, 4, 5, 6],
                    "className": "text-center",
                }, ],
                "columns": [{
                        "data": "id",
                    },

                    {
                        "data": "company.name",
                    },
                    {
                        "data": "username",
                    },
                    {
                        "data": "name",
                    },
                    {
                        "data": "email",
                    },
                    {
                        "data": "phone",
                    },
                    {
                        "data": "created_at",
                        "render": function(data, type, full) {
                            return moment(data).format('DD-MM-YYYY HH:mm')
                        }
                    },

                    {
                        "data": "is_active",
                        "render": function(data, type, full) {
                            var text = ``;
                            if (data == 1) {
                                text = `<input type="checkbox" onclick="setStatus(${full.id})" id="switch${full.id}" switch="primary" checked />
                                    <label for="switch${full.id}" data-on-label="" data-off-label=""></label>`;
                            } else {
                                text = `<input type="checkbox" onclick="setStatus(${full.id})" id="switch${full.id}" switch="primary"  />
                                    <label for="switch${full.id}" data-on-label="" data-off-label=""></label>`;
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
                            `;
                            return button;

                        }
                    },

                ],
            });
        }

        setStatus = (status) => {
            openLoading()
            let request_id = $("#request_id").val()
            $.ajax({
                type: "method",
                method: "POST",
                url: "{{ route('admin.request-package.store') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "status": status,
                    "request_id": request_id
                },
                success: function(res) {
                    closeLoading()
                    simple.ajax.reload();
                    Swal.fire(res.title, res.msg, res.status);
                    $('#simpleModal').modal("hide");

                }
            });
        }


        function showInfo(obj) {

            $('#modal_title').text('Request Detail');
            $('#request_id').val(obj.id);
            $('#show_code').text(obj.code);
            $('#show_company_code').text(obj.company.code);
            $('#show_company_name').text(obj.company.name);
            $('#show_package').text(obj.package.name);
            $('#show_package_month').text(obj.package_month);
            $('#show_package_price').text(obj.package_price);
            $('#show_request_date').text(moment(obj.request_date).format('DD-MM-YYYY HH:mm'));
            $('.show_total_amount').text(obj.total_amount);
            $('#show_status').text(obj.status);
            $('#show_img').attr("href", obj.img);
            $('#show_status').removeClass();
            if (obj.status == 'WAIT') {
                $('#show_status').addClass("badge badge-pill badge-soft-warning")
            } else if (obj.status == 'APPROVE') {
                $('#show_status').addClass("badge badge-pill badge-soft-success")
            } else if (obj.status == 'CANCEL') {
                $('#show_status').addClass("badge badge-pill badge-soft-danger")
            }
            if (obj.status != 'WAIT') {
                $('.btn-primary').hide()
                $('.btn-danger').hide()
            }
            $('#simpleModal').modal("show");

        }


        setStatus = (id) => {
            openLoading()
            $.ajax({
                type: "method",
                method: "POST",
                url: "{{ route('admin.user.set-active') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                },
                success: function(res) {
                    closeLoading()
                    simple.ajax.reload();
                    // Swal.fire(res.title, res.msg, res.status);
                    // $('#simpleModal').modal("hide");

                }
            });
        }
    </script>
@endsection
