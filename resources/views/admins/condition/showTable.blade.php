    //Room-rates
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
                [0, "desc"]
            ],
            "ajax": {
                "url": "{{ route('admin.condition.list') }}",
                "method": "GET",
                "data": {
                    "_token": "{{ csrf_token() }}",
                },
            },
            'columnDefs': [{
                "targets": [0, 1, 2, 3, 4],
                {{-- "className": "text-center", --}}
            }, ],
            "columns": [

                {
                    "data": "created_at",
                    "render": function(data, type, full) {
                        return moment(data).format('DD-MM-YYYY HH:mm')
                    }
                },

                {
                    "data": "point",
                },

                {
                    "data": "info",
                    "render": function (data) {
                        const maxLength = 130; // กำหนดความยาวสูงสุด
                        const truncatedText = data.length > maxLength 
                            ? data.substring(0, maxLength) + '...' 
                            : data;
                        
                        return `<span title="${data}">${truncatedText}</span>`;
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
