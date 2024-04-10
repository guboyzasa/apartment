//แก้ไข F1
        $('#editCusBtnF1').click(function() {
            var id = $('#id').val();
            var name_id = $('#show_name_id').val();
            var company_id = $('#show_company_id').val();
            var status_id = 1;

            {{-- var list1 = $('#show_list1').val();
            var list2 = $('#show_list2').val();
            var list3 = $('#show_list3').val();
            var list6 = $('#show_list6').val();
            var list7 = $('#show_list7').val(); --}}

            var price_unit1 = $('#show_price_unit1').val();
            var price_unit2 = $('#show_price_unit2').val();
            var price_unit3 = $('#show_price_unit3').val();
            var price_unit6 = $('#show_price_unit6').val();
            var price_unit7 = $('#show_price_unit7').val();
            var price_unit8 = $('#show_price_unit8').val();

            var unit_befor2 = $('#show_unit_befor2').val();
            var unit_befor3 = $('#show_unit_befor3').val();

            var unit_after2 = $('#show_unit_after2').val();
            var unit_after3 = $('#show_unit_after3').val();

            if (name_id == '' || name_id == null) {
                toastr.warning('กรุณากรอกข้อมูลให้ครบถ้วน', 'แจ้งเดือน!', {
                    timeOut: 3000,
                    progressBar: true,
                    tapToDismiss: false
                });
            } else {
                $.post("{{ route('admin.store.update') }}", data = {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        name_id: name_id,
                        company_id: company_id,
                        status_id: status_id,

                        {{-- list1: list1,
                        list2: list2,
                        list3: list3,
                        list6: list6,
                        list7: list7, --}}

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
                        $('#simpleModalF1').modal("hide");
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

        //แก้ไข F2
        $('#editCusBtnF2').click(function() {
            var id = $('#id').val();
            var name_id = $('#show_name_id_f2').val();
            var company_id = $('#show_company_id_f2').val();
            var status_id = 2;

            {{-- var list1 = $('#show_list1_f2').val();
            var list2 = $('#show_list2_f2').val();
            var list3 = $('#show_list3_f2').val();
            var list6 = $('#show_list6_f2').val();
            var list7 = $('#show_list7_f2').val(); --}}

            var price_unit1 = $('#show_price_unit1_f2').val();
            var price_unit2 = $('#show_price_unit2_f2').val();
            var price_unit3 = $('#show_price_unit3_f2').val();
            var price_unit6 = $('#show_price_unit6_f2').val();
            var price_unit7 = $('#show_price_unit7_f2').val();
            var price_unit8 = $('#show_price_unit8_f2').val();

            var unit_befor2 = $('#show_unit_befor2_f2').val();
            var unit_befor3 = $('#show_unit_befor3_f2').val();

            var unit_after2 = $('#show_unit_after2_f2').val();
            var unit_after3 = $('#show_unit_after3_f2').val();

            if (name_id == '' || name_id == null) {
                toastr.warning('กรุณากรอกข้อมูลให้ครบถ้วน', 'แจ้งเดือน!', {
                    timeOut: 3000,
                    progressBar: true,
                    tapToDismiss: false
                });
            } else {
                $.post("{{ route('admin.store.update') }}", data = {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        name_id: name_id,
                        company_id: company_id,
                        status_id: status_id,

                        {{-- list1: list1,
                        list2: list2,
                        list3: list3,
                        list6: list6,
                        list7: list7, --}}

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
                        $('#simpleModalF2').modal("hide");
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

        //แก้ไข F3
        $('#editCusBtnF3').click(function() {
            var id = $('#id').val();
            var name_id = $('#show_name_id_f3').val();
            var company_id = $('#show_company_id_f3').val();
            var status_id = 3;

            {{-- var list1 = $('#show_list1_f3').val();
            var list2 = $('#show_list2_f3').val();
            var list3 = $('#show_list3_f3').val();
            var list6 = $('#show_list6_f3').val();
            var list7 = $('#show_list7_f3').val(); --}}

            var price_unit1 = $('#show_price_unit1_f3').val();
            var price_unit2 = $('#show_price_unit2_f3').val();
            var price_unit3 = $('#show_price_unit3_f3').val();
            var price_unit6 = $('#show_price_unit6_f3').val();
            var price_unit7 = $('#show_price_unit7_f3').val();
            var price_unit8 = $('#show_price_unit8_f3').val();

            var unit_befor2 = $('#show_unit_befor2_f3').val();
            var unit_befor3 = $('#show_unit_befor3_f3').val();

            var unit_after2 = $('#show_unit_after2_f3').val();
            var unit_after3 = $('#show_unit_after3_f3').val();

            if (name_id == '' || name_id == null) {
                toastr.warning('กรุณากรอกข้อมูลให้ครบถ้วน', 'แจ้งเดือน!', {
                    timeOut: 3000,
                    progressBar: true,
                    tapToDismiss: false
                });
            } else {
                $.post("{{ route('admin.store.update') }}", data = {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        name_id: name_id,
                        company_id: company_id,
                        status_id: status_id,

                        {{-- list1: list1,
                        list2: list2,
                        list3: list3,
                        list6: list6,
                        list7: list7, --}}

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
                        $('#simpleModalF3').modal("hide");
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