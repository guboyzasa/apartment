    //Room-Rate
    showTable = () => {
        var filter_company_id = $('#filter_company_id').val();
        var filter_floor_id = $('#filter_floor_id').val();
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
                "url": "{{ route('admin.con-customer.list') }}",
                "method": "GET",
                "data": {
                    "_token": "{{ csrf_token() }}",
                    filter_company_id : filter_company_id,
                     filter_floor_id : filter_floor_id,
                },
            },
            'columnDefs': [{
                "targets": [0, 1, 2, 3, 4, 5, 6],
                "className": "text-center",
            }, ],
            "columns": [

                {
                    "data": "id",
                    "render": function(data, type, full) {
                        var text =
                            `${full.code}`;
                        if (full.img) {
                            text =
                                `<a style="text-align:center;" href="#" onclick="showInfoImg('${full.img}')">
                                    <img src="{{ URL::asset('/${full.img}') }}" alt="" style="height:50px"></a>`;
                        }
                        return text;
                    }
                },

                {
                    // โชว์ชื่อบริษัทจาก relation company และ room_number
                    "data": null, 
                    "render": function(data, type, full) {
                        const companyName = full.company ? full.company.name : '-';
                        const roomNumber = full.room_number;
                        
                        // สร้างข้อความแสดงชื่อบริษัทและหมายเลขห้อง
                        const text = `<b>${roomNumber}</b> <br> ${companyName}`;
                
                        return text;
                    }
                },
                
                {{-- {
                    "data": "room_number",
                }, --}}

                {
                    // โชว์ชื่อบริษัทจาก relation company และ room_number
                    "data": null, 
                    "render": function(data, type, full) {
                        const nickName = full.nickname;
                        const phoneNumber = full.phone;
                        
                        // สร้างข้อความแสดงชื่อบริษัทและหมายเลขห้อง
                        const text = `<b>${nickName}</b> <br> ${phoneNumber}`;
                
                        return text;
                    }
                },

                {{-- {
                    "data": "phone",
                }, --}}

                {
                    // โชว์ชื่อบริษัทจาก relation company และ room_number
                    "data": null, 
                    "render": function(data, type, full) {
                        const nickName2 = full.nickname2;
                        const phoneNumber2 = full.phone2;
                        
                        // สร้างข้อความแสดงชื่อบริษัทและหมายเลขห้อง
                        const text = `<b>${nickName2}</b> <br> ${phoneNumber2}`;
                
                        return text;
                    }
                },

                {{-- {
                    "data": "phone2",
                }, --}}

                {
                    "data": "other",
                    "render": function(data) {
                        const text = data ? data : '-'; // ถ้าไม่มีข้อมูลให้แสดง "-"
                        return `<span style="color: red;">${text}</span>`;
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
