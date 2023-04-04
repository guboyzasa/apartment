<script>
    $(document).ready(function() {
            var simple = '';
            showTableF1();
            showTableF2();
            showTableF3();

        });
        
    //F1
    showTableF1 = () => {
        simple = $('#simple_table_f1').DataTable({
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
                "url": "{{ route('admin.customer.listf1') }}",
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
                    "data": "name",
                },

                {
                    "data": "status_id",
                    "render": function(data, type, full) {
                        var text = ``;
                        if (full.status_id == 1) {
                            text =
                                `
                                <span class="badge bg-success text-white text-center font-size-13">ชั้น 1</span>`
                        } else if (full.status_id == 2) {
                            text = `
                                <span class="badge bg-warning text-white text-center font-size-13">ชั้น 2</span>
                                `
                        }else if (full.status_id == 3) {
                            text = `
                                <span class="badge bg-danger text-white text-center font-size-13">ชั้น 3</span>
                                `
                        }
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

    //F2
    showTableF2 = () => {
        simple = $('#simple_table_f2').DataTable({
            "processing": false,
            "serverSide": false,
            "info": false,
            "searching": true,
            "responsive": false,
            "bFilter": false,
            "destroy": true,
            "order": [
                [2, "desc"]
            ],
            "ajax": {
                "url": "{{ route('admin.customer.listf2') }}",
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
                    "data": "name",
                },

                {
                    "data": "status_id",
                    "render": function(data, type, full) {
                        if (full.status_id == 1) {
                            text =
                                `
                                <span class="badge bg-success text-white text-center font-size-13">ชั้น 1</span>`
                        } else if (full.status_id == 2) {
                            text = `
                                <span class="badge bg-warning text-white text-center font-size-13">ชั้น 2</span>
                                `
                        }else if (full.status_id == 3) {
                            text = `
                                <span class="badge bg-danger text-white text-center font-size-13">ชั้น 3</span>
                                `
                        }
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

    //F3
    showTableF3 = () => {
        simple = $('#simple_table_f3').DataTable({
            "processing": false,
            "serverSide": false,
            "info": false,
            "searching": true,
            "responsive": false,
            "bFilter": false,
            "destroy": true,
            "order": [
                [3, "desc"]
            ],
            "ajax": {
                "url": "{{ route('admin.customer.listf3') }}",
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
                    "data": "name",
                },

                {
                    "data": "status_id",
                    "render": function(data, type, full) {
                        var text = ``;
                        if (full.status_id == 1) {
                            text =
                                `
                                <span class="badge bg-success text-white text-center font-size-13">ชั้น 1</span>`
                        } else if (full.status_id == 2) {
                            text = `
                                <span class="badge bg-warning text-white text-center font-size-13">ชั้น 2</span>
                                `
                        }else if (full.status_id == 3) {
                            text = `
                                <span class="badge bg-danger text-white text-center font-size-13">ชั้น 3</span>
                                `
                        }
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
</script>
