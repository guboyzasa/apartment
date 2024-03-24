 
     //Table F1
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
                 "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                 "className": "text-center",
             }, ],
             "columns": [{
                     "data": "id"
                 },

                 {
                     "data": "id",
                     "render": function(data, type, full) {
                         var date = moment(full.created_at).format('DD-MM-YYYY');
                         var text = ``;
                         if (full.status_id == 1) {
                             text = `
                            <span>${date}</span><br>
                            <span class="badge text-dark text-center font-size-14">${full.room.name}</span>

                            `
                         }
                         return text;
                     }
                 },

                 {
                     "data": "id",
                     "render": function(data, type, full) {
                         var text = ``;
                         if (full.company_id == 1) {
                             text = `
                                <span class="badge bg-secondary text-center font-size-14">${full.company.name}</span>

                                `
                         } else if (full.company_id == 2) {
                             text = `
                                <span class="badge bg-info text-center font-size-14">${full.company.name}</span>

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

                 {
                     "data": "amount6",
                 },

                 {
                     "data": "amount8",
                 },

                 {
                     "data": "total_amount",
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
                     "render": function(data, type, full) {
                         var obj = JSON.stringify(full);
                         var button = ``;
                         if (full.status_id == 1) {
                             button = `
                                <button type="button" class="btn btn-sm btn-outline-success" onclick='showInfoF1(${obj})'><i class="bx bx-search"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger" onclick='destroy(${data})'><i class="bx bx-trash"></i> </button>
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
         simpleF2 = $('#simple_table_f2').DataTable({
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
                 "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                 "className": "text-center",
             }, ],
             "columns": [{
                     "data": "id"
                 },

                 {
                     "data": "id",
                     "render": function(data, type, full) {
                         var date = moment(full.created_at).format('DD-MM-YYYY');
                         var text = ``;
                         if (full.status_id == 2) {
                             text = `
                                    <span>${date}</span><br>
                                    <span class="badge text-dark text-center font-size-14">${full.room.name}</span>

                                    `
                         }
                         return text;
                     }
                 },

                 {
                     "data": "id",
                     "render": function(data, type, full) {
                         var text = ``;
                         if (full.company_id == 1) {
                             text = `
                                <span class="badge bg-secondary text-center font-size-14">${full.company.name}</span>

                                `
                         } else if (full.company_id == 2) {
                             text = `
                                <span class="badge bg-info text-center font-size-14">${full.company.name}</span>

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

                 {
                     "data": "amount6",
                 },

                 {
                    "data": "amount8",
                },

                 {
                     "data": "total_amount",
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
                     "render": function(data, type, full) {
                         var obj = JSON.stringify(full);
                         var button = ``;
                         if (full.status_id == 2) {
                             button = `
                                    <button type="button" class="btn btn-sm btn-outline-warning" onclick='showInfoF2(${obj})'><i class="bx bx-search"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick='destroy(${data})'><i class="bx bx-trash"></i> </button>
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
         simpleF3 = $('#simple_table_f3').DataTable({
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
                 "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                 "className": "text-center",
             }, ],
             "columns": [{
                     "data": "id"
                 },

                 {
                     "data": "id",
                     "render": function(data, type, full) {
                         var date = moment(full.created_at).format('DD-MM-YYYY');
                         var text = ``;
                         if (full.status_id == 3) {
                             text = `
                                <span>${date}</span><br>
                                <span class="badge text-dark text-center font-size-14">${full.room.name}</span>

                                `
                         }
                         return text;
                     }
                 },

                 {
                     "data": "id",
                     "render": function(data, type, full) {
                         var text = ``;
                         if (full.company_id == 1) {
                             text = `
                                    <span class="badge bg-secondary text-center font-size-14">${full.company.name}</span>

                                    `
                         } else if (full.company_id == 2) {
                             text = `
                                    <span class="badge bg-info text-center font-size-14">${full.company.name}</span>

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

                 {
                     "data": "amount6",
                 },

                 {
                    "data": "amount8",
                },

                 {
                     "data": "total_amount",
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
                     "render": function(data, type, full) {
                         var obj = JSON.stringify(full);
                         var button = ``;
                         if (full.status_id == 3) {
                             button = `
                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick='showInfoF3(${obj})'><i class="bx bx-search"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick='destroy(${data})'><i class="bx bx-trash"></i> </button>
                                    `;
                         }

                         return button;

                     }
                 },
             ],
         });
     }

