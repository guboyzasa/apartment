
    //บันทึก F1
    $('#saveCusBtn').click(function() {
        $(this).attr('disabled',true);
        var room_id = $('#room_id').val();
        var company_id = $('#company_id').val();
        var floor_id = $('#floor_id').val();

        var list1 = $('#list1').val();
        var list2 = $('#list2').val();
        var list3 = $('#list3').val();
        var list6 = $('#list6').val();
        var list7 = $('#list7').val();

        var price_unit1 = $('#price_unit1').val();
        var price_unit2 = $('#price_unit2').val();
        var price_unit3 = $('#price_unit3').val();
        var price_unit6 = $('#price_unit6').val();
        var price_unit7 = $('#price_unit7').val();
        var price_unit8 = $('#price_unit8').val();
        
        var unit_befor2 = $('#unit_befor2').val();
        var unit_befor3 = $('#unit_befor3').val();
        
        var unit_after2 = $('#unit_after2').val();
        var unit_after3 = $('#unit_after3').val();


        if (!room_id || !floor_id || !company_id || !unit_befor2 || !unit_befor3 || !unit_after2 || !unit_after3) {
            toastr.warning('กรุณากรอกข้อมูลให้ครบถ้วน', 'แจ้งเดือน!', {
                timeOut: 3000,
                progressBar: true,
                tapToDismiss: false
            });
            $(this).attr('disabled',false);
        } else {
            $.post("{{ route('admin.store.add') }}", data = {
                    _token: '{{ csrf_token() }}',
                    room_id: room_id,
                    company_id: company_id,
                    floor_id: floor_id,

                    list1: list1,
                    list2: list2,
                    list3: list3,
                    list6: list6,
                    list7: list7,

                    price_unit1: price_unit1,
                    price_unit2: price_unit2,
                    price_unit3: price_unit3,
                    price_unit6: price_unit6,
                    price_unit7: price_unit7,
                    price_unit8: price_unit8,
                    
                    unit_befor2: unit_befor2,
                    unit_befor3: unit_befor3,
                    
                    unit_after2: unit_after2,
                    unit_after3: unit_after3,
                },
                function(res) {
                    simpleF1.ajax.reload(null, false);
                    $('#saveCusBtn').attr('disabled',false);
                    // Swal.fire(res.title, res.msg, res.status);
                    // location.reload();
                    closeLoading();
                    toastr.success(res.msg, res.title, {
                        timeOut: 3000,
                        progressBar: true,
                        tapToDismiss: false
                    });
                    
                },
            );
        }
    });

    //บันทึก F2
    {{-- $('#saveCusBtnF2').click(function() {
        var room_id = $('#room_id_f2').val();
        var company_id = $('#company_id_f2').val();

        var floor_id = 2;

        var list1 = $('#list1_f2').val();
        var list2 = $('#list2_f2').val();
        var list3 = $('#list3_f2').val();
        var list6 = $('#list6_f2').val();
        var list7 = $('#list7_f2').val();

        var price_unit1 = $('#price_unit1_f2').val();
        var price_unit2 = $('#price_unit2_f2').val();
        var price_unit3 = $('#price_unit3_f2').val();
        var price_unit6 = $('#price_unit6_f2').val();
        var price_unit7 = $('#price_unit7_f2').val();
        var price_unit8 = $('#price_unit8_f2').val();
        
        var unit_befor2 = $('#unit_befor2_f2').val();
        var unit_befor3 = $('#unit_befor3_f2').val();
        
        var unit_after2 = $('#unit_after2_f2').val();
        var unit_after3 = $('#unit_after3_f2').val();


        if (room_id == '' || room_id == null) {
            toastr.warning('กรุณากรอกข้อมูลให้ครบถ้วน', 'แจ้งเดือน!', {
                timeOut: 3000,
                progressBar: true,
                tapToDismiss: false
            });
        } else {
            $.post("{{ route('admin.store.add') }}", data = {
                    _token: '{{ csrf_token() }}',
                    room_id: room_id,
                    company_id: company_id,
                    floor_id: floor_id,

                    list1: list1,
                    list2: list2,
                    list3: list3,
                    list6: list6,
                    list7: list7,

                    price_unit1: price_unit1,
                    price_unit2: price_unit2,
                    price_unit3: price_unit3,
                    price_unit6: price_unit6,
                    price_unit7: price_unit7,
                    price_unit8: price_unit8,
                    
                    unit_befor2: unit_befor2,
                    unit_befor3: unit_befor3,
                    
                    unit_after2: unit_after2,
                    unit_after3: unit_after3,
                },
                function(res) {
                    simpleF1.ajax.reload(null, false);
                    simpleF2.ajax.reload(null, false);
                    simpleF3.ajax.reload(null, false);
                    // Swal.fire(res.title, res.msg, res.status);
                    // location.reload();
                    closeLoading();
                    toastr.success(res.msg, res.title, {
                        timeOut: 3000,
                        progressBar: true,
                        tapToDismiss: false
                    });
                },
            );
        }
    }); --}}

    //บันทึก F3
    {{-- $('#saveCusBtnF3').click(function() {
        var room_id = $('#room_id_f3').val();
        var company_id = $('#company_id_f3').val();

        var floor_id = 3;

        var list1 = $('#list1_f3').val();
        var list2 = $('#list2_f3').val();
        var list3 = $('#list3_f3').val();
        var list6 = $('#list6_f3').val();
        var list7 = $('#list7_f3').val();

        var price_unit1 = $('#price_unit1_f3').val();
        var price_unit2 = $('#price_unit2_f3').val();
        var price_unit3 = $('#price_unit3_f3').val();
        var price_unit6 = $('#price_unit6_f3').val();
        var price_unit7 = $('#price_unit7_f3').val();
        var price_unit8 = $('#price_unit8_f3').val();
        
        var unit_befor2 = $('#unit_befor2_f3').val();
        var unit_befor3 = $('#unit_befor3_f3').val();
        
        var unit_after2 = $('#unit_after2_f3').val();
        var unit_after3 = $('#unit_after3_f3').val();


        if (room_id == '' || room_id == null) {
            toastr.warning('กรุณากรอกข้อมูลให้ครบถ้วน', 'แจ้งเดือน!', {
                timeOut: 3000,
                progressBar: true,
                tapToDismiss: false
            });
        } else {
            $.post("{{ route('admin.store.add') }}", data = {
                    _token: '{{ csrf_token() }}',
                    room_id: room_id,
                    company_id: company_id,
                    floor_id: floor_id,

                    list1: list1,
                    list2: list2,
                    list3: list3,
                    list6: list6,
                    list7: list7,

                    price_unit1: price_unit1,
                    price_unit2: price_unit2,
                    price_unit3: price_unit3,
                    price_unit6: price_unit6,
                    price_unit7: price_unit7,
                    price_unit8: price_unit8,
                    
                    unit_befor2: unit_befor2,
                    unit_befor3: unit_befor3,
                    
                    unit_after2: unit_after2,
                    unit_after3: unit_after3,
                },
                function(res) {
                    simpleF1.ajax.reload(null, false);
                    simpleF2.ajax.reload(null, false);
                    simpleF3.ajax.reload(null, false);
                    // Swal.fire(res.title, res.msg, res.status);
                    // location.reload();
                    closeLoading();
                    toastr.success(res.msg, res.title, {
                        timeOut: 3000,
                        progressBar: true,
                        tapToDismiss: false
                    });
                },
            );
        }
    }); --}}

