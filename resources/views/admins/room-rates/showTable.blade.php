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
                "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8],
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
                    "data": "name", // ใช้ null เพราะดึงข้อมูลหลายฟิลด์
                    "render": function(data, type, full) {
                        let listPaymentName = data != null ? data : 'ไม่มีชื่อรายการ';
                        let companyName = full.company ? full.company.name : 'ไม่มีชื่อบริษัท';
                        
                        // รวมชื่อรายการและบริษัทในรูปแบบ HTML
                        return `
                            <div>
                                <strong>${listPaymentName}</strong><br>
                                <span class="font-size-4">${companyName}</span>
                            </div>
                        `;
                    }
                },

                {
                    "data": "id",
                    "render": function(data, type, full) {
                        let price_unit = '';
                        if(full.list_payment_details){
                            for(let i = 0;i<(full.list_payment_details).length;i++){
                                price_unit+='<p>'+full.list_payment_details[i].price_unit+'</p>';
                            }
                        }
                        return price_unit;
                    }
                },

                {
                    "data": "min_price",
                    "render": function(data, type, full) {
                        return data !== null ? data : '-'; // ถ้าเป็น null ให้แสดงเป็น '-'
                    }
                },

                {
                    "data": "is_unit",
                },

                {
                    "data": "is_other",
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
