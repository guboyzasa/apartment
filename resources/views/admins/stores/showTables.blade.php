 
     //Table F1
     showTableF1 = () => {
        var filter_company_id = $('#filter_company_id').val();
        var filter_floor_id = $('#filter_floor_id').val();
         simpleF1 = $('#simple_table_f1').DataTable({
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
                 "url": "{{ route('admin.store.listf1') }}",
                 "method": "POST",
                 "data": {
                     "_token": "{{ csrf_token() }}",
                     filter_company_id : filter_company_id,
                     filter_floor_id : filter_floor_id,
                 },
             },
             'columnDefs': [{
                 "targets": [0, 1, 2, 3, 4, 5, 6, 7, 9],
                 "className": "text-center",
             },
             {
                "targets": [8],
                "className": "bg-soft bg-danger text-center",

            },],
             "columns": [{
                     "data": "id"
                    },

                    {
                        "data": "id",
                        "render": function(data, type, full) {
                            const room = full.room ? full.room.room_number : 'N/A';
                            const customer = full.customer ? full.customer.nickname : 'N/A';
                            const date = moment(full.created_at).format('DD-MM-YYYY');
                    
                            let text = `<span>${date}</span><br>`;
                            if (full.floor_id) { // แสดงทุก floor_id ที่มีค่า
                                text += `
                                    <span class="badge text-dark text-center font-size-14">
                                        ${room} - ${customer}
                                    </span>`;
                            }
                            return text;
                        }
                    },

                    {
                        "data": "company_id",
                        "render": function(data, type, full) {
                            let text = ``;
                    
                            if (full.company) {
                                let badgeClass = "";
                                switch (full.company_id) {
                                    case 1:
                                        badgeClass = "bg-primary";
                                        break;
                                    case 2:
                                        badgeClass = "bg-success";
                                        break;
                                    default:
                                        badgeClass = "bg-secondary"; // สีเริ่มต้นหากไม่มีเงื่อนไขตรงกัน
                                }
                    
                                text = `
                                    <span class="badge ${badgeClass} text-center font-size-14">
                                        ${full.company.name}
                                    </span>
                                `;
                            } else {
                                text = `<span class="badge bg-danger">ไม่พบข้อมูลบริษัท</span>`;
                            }
                    
                            return text;
                        }
                    },

                 {
                     "data": "amount1",
                     "render": function(data, type, row) {
                        if (data != null) {
                            return formatNumber(data); // เรียกใช้ฟังก์ชันจัดรูปแบบตัวเลข
                        } else {
                            return '-'; // กรณีที่ไม่มีข้อมูล
                        }
                    }
                 },

                 {
                     "data": "amount2",
                     "render": function(data, type, row) {
                        if (data != null) {
                            return formatNumber(data); // เรียกใช้ฟังก์ชันจัดรูปแบบตัวเลข
                        } else {
                            return '-'; // กรณีที่ไม่มีข้อมูล
                        }
                    }
                 },

                 {
                     "data": "amount3",
                     "render": function(data, type, row) {
                        if (data != null) {
                            return formatNumber(data); // เรียกใช้ฟังก์ชันจัดรูปแบบตัวเลข
                        } else {
                            return '-'; // กรณีที่ไม่มีข้อมูล
                        }
                    }
                 },

                 {
                     "data": "amount6",
                     "render": function(data, type, row) {
                        if (data != null) {
                            return formatNumber(data); // เรียกใช้ฟังก์ชันจัดรูปแบบตัวเลข
                        } else {
                            return '-'; // กรณีที่ไม่มีข้อมูล
                        }
                    }
                 },

                 {
                     "data": "amount8",
                     "render": function(data, type, row) {
                        if (data != null) {
                            return formatNumber(data); // เรียกใช้ฟังก์ชันจัดรูปแบบตัวเลข
                        } else {
                            return '-'; // กรณีที่ไม่มีข้อมูล
                        }
                    }
                 },

                 {
                    "data": "total_amount",
                    "render": function(data, type, row) {
                        if (data != null) {
                            const formattedData = formatNumber(data); // เรียกใช้ฟังก์ชันจัดรูปแบบตัวเลข
                
                            // ใช้เงื่อนไขสำหรับการใส่สี (ตัวอย่าง: สีแดงหากน้อยกว่า 0, สีเขียวหากมากกว่า 0)
                            const color = data < 0 ? 'red' : 'green';
                
                            // ใส่สไตล์ inline เพื่อกำหนดสี
                            return `<span style="color: ${color}; font-weight: bold;">${formattedData}</span>`;
                        } else {
                            return '<span style="color: gray;">-</span>'; // แสดง "-" พร้อมสีเทา
                        }
                    }
                },

                 {
                     "data": "is_active",
                     "render": function(data, type, full) {
                         var text = ``;
                         if (data == 1) {
                             text = `
                                    <div class="form-check form-switch d-flex justify-content-center">
                                        <input class="form-check-input" type="checkbox" role="switch" id="switch${full.id}" checked
                                            onchange="setStatus(${full.id})">
                                    </div>
                                    `;
                         } else {
                             text = `
                                    <div class="form-check form-switch d-flex justify-content-center">
                                        <input class="form-check-input" type="checkbox" role="switch" id="switch${full.id}"
                                            onchange="setStatus(${full.id})">
                                    </div>
                                    `;
                         }
                         return text;
                     }
                 },

                 {
                    "data": "id",
                    "render": (data, type, full) => `
                        <button class="btn btn-sm btn-outline-success" onclick='showInfoF1(${JSON.stringify(full)})'>
                            <i class="bx bx-search"></i>
                        </button>
                        {{-- <button class="btn btn-sm btn-danger" onclick='destroy(${data})'>
                            <i class="bx bx-trash"></i>
                        </button> --}}
                    `
                },
             ],
         });
     }

