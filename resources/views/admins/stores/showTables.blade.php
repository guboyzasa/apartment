<script>
    $(document).ready(function() {
        var simple = '';
        showTableF1();
        showTableF2();
        showTableF3();
        
    });

    //Table F1
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
                [0, "desc"]
            ],
            "ajax": {
                "url": "{{ route('admin.store.listf1') }}",
                "method": "GET",
                "data": {
                    "_token": "{{ csrf_token() }}",
                },
            },
            'columnDefs': [{
                "targets": [0, 1, 2, 3, 4, 5, 6, 7],
                "className": "text-center",
            }, ],
            "columns": [
                {
                    "data": "id",
                    "render": function(data, type, full) {
                        var date = moment(full.updated_at).format('DD-MM-YYYY HH:mm');
                        var text = ``;
                        if (full.status_id == 1) {
                            text = `
                            <span>${date}</span><br>
                            <span class="badge text-dark text-center font-size-14">${full.customer.name}</span>

                             `
                        } 
                        return text;
                    }
                },

                {
                    "data": "amount1",
                },

                {
                    "data": "amount2",
                },

                {
                    "data": "amount3",
                },

                // {
                //     "data": "amount4",
                // },

                // {
                //     "data": "amount5",
                // },

                {
                    "data": "amount6",
                },

                {
                    "data": "total_amount",
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
                        var button = ``;
                        if (full.status_id == 1) {
                            button = `
                            <button type="button" class="btn btn-sm btn-success" onclick='showInfo(${obj})'><i class="bx bx-search"></i> </button>
                            <button type="button" class="btn btn-sm btn-danger" onclick='destroy(${data})'><i class="bx bx-trash"></i>  </button>
                            `;
                        } else {
                            button = `
                            <button type="button" class="btn btn-sm btn-warning" onclick='showInfoV2(${obj})'><i class="bx bx-search"></i> </button>
                            <button type="button" class="btn btn-sm btn-danger" onclick='destroy(${data})'><i class="bx bx-trash"></i>  </button>
                            `;
                        }

                        return button;

                    }
                },
            ],
        });
    }

    //Table F2
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
                [0, "desc"]
            ],
            "ajax": {
                "url": "{{ route('admin.store.listf2') }}",
                "method": "GET",
                "data": {
                    "_token": "{{ csrf_token() }}",
                },
            },
            'columnDefs': [{
                "targets": [0, 1, 2, 3, 4, 5, 6, 7],
                "className": "text-center",
            }, ],
            "columns": [
                {
                    "data": "id",
                    "render": function(data, type, full) {
                        var date = moment(full.updated_at).format('DD-MM-YYYY HH:mm');
                        var text = ``;
                        if (full.status_id == 2) {
                            text = `
                            <span>${date}</span><br>
                            <span class="badge text-dark text-center font-size-14">${full.customer.name}</span>

                             `
                        } 
                        return text;
                    }
                },

                {
                    "data": "amount1",
                },

                {
                    "data": "amount2",
                },

                {
                    "data": "amount3",
                },

                // {
                //     "data": "amount4",
                // },

                // {
                //     "data": "amount5",
                // },

                {
                    "data": "amount6",
                },

                {
                    "data": "total_amount",
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
                        var button = ``;
                        if (full.status_id == 1) {
                            button = `
                            <button type="button" class="btn btn-sm btn-success" onclick='showInfo(${obj})'><i class="bx bx-search"></i> </button>
                            <button type="button" class="btn btn-sm btn-danger" onclick='destroy(${data})'><i class="bx bx-trash"></i>  </button>
                            `;
                        } else {
                            button = `
                            <button type="button" class="btn btn-sm btn-warning" onclick='showInfoV2(${obj})'><i class="bx bx-search"></i> </button>
                            <button type="button" class="btn btn-sm btn-danger" onclick='destroy(${data})'><i class="bx bx-trash"></i>  </button>
                            `;
                        }

                        return button;

                    }
                },
            ],
        });
    }

    //Table F3
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
                [0, "desc"]
            ],
            "ajax": {
                "url": "{{ route('admin.store.listf3') }}",
                "method": "GET",
                "data": {
                    "_token": "{{ csrf_token() }}",
                },
            },
            'columnDefs': [{
                "targets": [0, 1, 2, 3, 4, 5, 6, 7],
                "className": "text-center",
            }, ],
            "columns": [
                {
                    "data": "id",
                    "render": function(data, type, full) {
                        var date = moment(full.updated_at).format('DD-MM-YYYY HH:mm');
                        var text = ``;
                        if (full.status_id == 3) {
                            text = `
                            <span>${date}</span><br>
                            <span class="badge text-dark text-center font-size-14">${full.customer.name}</span>

                             `
                        } 
                        return text;
                    }
                },

                {
                    "data": "amount1",
                },

                {
                    "data": "amount2",
                },

                {
                    "data": "amount3",
                },

                // {
                //     "data": "amount4",
                // },

                // {
                //     "data": "amount5",
                // },

                {
                    "data": "amount6",
                },

                {
                    "data": "total_amount",
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
                        var button = ``;
                        if (full.status_id == 1) {
                            button = `
                            <button type="button" class="btn btn-sm btn-success" onclick='showInfo(${obj})'><i class="bx bx-search"></i> </button>
                            <button type="button" class="btn btn-sm btn-danger" onclick='destroy(${data})'><i class="bx bx-trash"></i>  </button>
                            `;
                        } else {
                            button = `
                            <button type="button" class="btn btn-sm btn-warning" onclick='showInfoV2(${obj})'><i class="bx bx-search"></i> </button>
                            <button type="button" class="btn btn-sm btn-danger" onclick='destroy(${data})'><i class="bx bx-trash"></i>  </button>
                            `;
                        }

                        return button;

                    }
                },
            ],
        });
    }

</script>
