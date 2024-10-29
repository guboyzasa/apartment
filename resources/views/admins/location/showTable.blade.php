//Room-Rate
showTable = () => {
    simple = $('#simple_table').DataTable({
        "processing": false,
        "serverSide": false,
        "info": false,
        "searching": true,
        "responsive": false,
        "bFilter": false,
        "destroy": true,
        "order": [[0, "desc"]],
        "ajax": {
            "url": "{{ route('admin.location.list') }}",
            "method": "GET",
            "data": {
                "_token": "{{ csrf_token() }}",
            },
        },
        'columnDefs': [{
            "targets": [0, 1, 2, 3, 4, 5, 6],
            "className": "text-center",
        }],
        "columns": [
            { "data": "name" },
            { "data": "name_owner" },
            {
                "data": null,
                "render": function(data, type, full) {
                    let address = full.address ? full.address : '-';
                    let address2 = full.address2 ? full.address2 : '-';
                    return `${address} ${address2}`;
                }
            },
            { "data": "phone" },
            { 
                "data": "floors_count"  // ใช้จำนวนชั้นที่นับได้
            },
            {
                "data": "is_active",
                "render": function(data, type, full) {
                    let checked = data == 1 ? "checked" : "";
                    return `
                        <div class="form-check form-switch d-flex justify-content-center">
                            <input class="form-check-input" type="checkbox" role="switch" 
                                   id="switch${full.id}" ${checked} onchange="setStatus(${full.id})">
                        </div>`;
                }
            },
            {
                "data": "id",
                "render": function(data, type, full) {
                    let obj = JSON.stringify(full);
                    return `
                        <button type="button" class="btn btn-sm btn-info" onclick='showInfo(${obj})'>
                            <i class="bx bx-search"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger" onclick='destroy(${data})'>
                            <i class="bx bx-trash"></i>
                        </button>`;
                }
            },
        ],
    });
}

