//Room-Rate
    showTable = () => {
        var filter_company_id = $('#filter_company_id').val();
        simple = $('#simple_table').DataTable({
            "processing": false,
            "serverSide": false,
            "info": false,
            "searching": true,
            "responsive": false,
            "bFilter": false,
            "destroy": true,
            "order": [
                [1, "asc"]
            ],
            "ajax": {
                "url": "{{ route('admin.room-rates.list') }}",
                "method": "GET",
                "data": {
                    "_token": "{{ csrf_token() }}",
                    filter_company_id : filter_company_id,
                },
            },
            'columnDefs': [{
                "targets": [0, 1, 2, 3, 4, 5],
                "className": "text-center",
            }, ],
            "columns": [
                {
                    "data": "id",
                },

                {
                    "data": "created_at",
                    "render": function(data, type, full) {
                        return moment(data).format('DD-MM-YYYY HH:mm')
                    }
                },

                {
                    "data": "list_payment_id",
                    "render": function(data, type, full) {
                        return full.list_payment ? full.list_payment.name : 'ไม่มีชื่อ';
                    }
                },

                {
                    "data": "price_unit",
                },

                {
                    "data": "company_id",
                    "render": function(data, type, full) {
                        return full.company ? full.company.name : 'ไม่มีชื่อ';
                    }
                },

                {
                    "data": "is_active",
                    "render": function(data, type, full) {
                        var text = ``;
                        if (data == 1) {
                            text =`
                                <div class="form-check form-switch d-flex justify-content-center">
                                    <input class="form-check-input" type="checkbox" role="switch" id="switch${full.id}" checked onchange="setStatus(${full.id})">
                                </div>
                                `;
                        } else {
                            text =`
                            <div class="form-check form-switch d-flex justify-content-center">
                                    <input class="form-check-input" type="checkbox" role="switch" id="switch${full.id}" onchange="setStatus(${full.id})">
                                </div>
                            `;
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
