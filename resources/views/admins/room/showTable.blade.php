    //F1
    showTableF1 = () => {
        simpleF1 = $('#simple_table_f1').DataTable({
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
                "url": "{{ route('admin.room.listf1') }}",
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

    //F2
    showTableF2 = () => {
        simpleF2 = $('#simple_table_f2').DataTable({
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
                "url": "{{ route('admin.room.listf2') }}",
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

    //F3
    showTableF3 = () => {
        simpleF3 = $('#simple_table_f3').DataTable({
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
                "url": "{{ route('admin.room.listf3') }}",
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
