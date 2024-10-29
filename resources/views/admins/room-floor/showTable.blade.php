    //F1
    showTableF1 = () => {
        var filter_company_id = $('#filter_company_id').val();
        simpleF1 = $('#simple_table').DataTable({
            "processing": false,
            "serverSide": false,
            "info": false,
            "searching": true,
            "responsive": false,
            "bFilter": false,
            "destroy": true,
            "order": [
                [0, "asc"]
            ],
            "ajax": {
                "url": "{{ route('admin.room-floor.list') }}",
                "method": "GET",
                "data": {
                    "_token": "{{ csrf_token() }}",
                    filter_company_id : filter_company_id,
                },
            },
            'columnDefs': [{
                "targets": [0, 1, 2, 3, 4],
                "className": "text-center",
            }, ],
            "columns": [{
                    "data": "id",
                },

                {
                    "data": "name",
                },

                {
                    "data": "company_id",
                    "render": function(data, type, full) {
                        if (full.company && full.company.name) {
                            return full.company.name;  // แสดงชื่อหอพัก
                        } else {
                            return '-';  // กรณีไม่มีข้อมูลหอพัก
                        }
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
                            {{-- <button type="button" class="btn btn-sm btn-danger" onclick='destroy(${data})'><i class="bx bx-trash"></i>  </button> --}}
                            
                            `;
                        return button;

                    }
                },

            ],
        });
    }
