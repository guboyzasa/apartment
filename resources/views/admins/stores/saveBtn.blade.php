<script>
    $(document).ready(function() {
        var simple = '';
    });

    //บันทึก F1
    $('#saveCusBtnF1').click(function() {
        var name_id = $('#name_id').val();
        var status_id = 1;

        var list1 = $('#list1').val();
        var list2 = $('#list2').val();
        var list3 = $('#list3').val();
        var list4 = $('#list4').val();
        var list5 = $('#list5').val();
        var list6 = $('#list6').val();

        var price_unit1 = $('#price_unit1').val();
        var price_unit2 = $('#price_unit2').val();
        var price_unit3 = $('#price_unit3').val();
        var price_unit6 = $('#price_unit6').val();
        
        var unit_befor2 = $('#unit_befor2').val();
        var unit_befor3 = $('#unit_befor3').val();
        
        var unit_after2 = $('#unit_after2').val();
        var unit_after3 = $('#unit_after3').val();


        if (name_id == '' || name_id == null) {
            Swal.fire('แจ้งเตือน!', 'กรุณากรอกข้อมูลให้ครบถ้วน ', 'warning');
        } else {
            $.post("{{ route('admin.store.add') }}", data = {
                    _token: '{{ csrf_token() }}',
                    name_id: name_id,
                    status_id: status_id,

                    list1: list1,
                    list2: list2,
                    list3: list3,
                    list4: list4,
                    list5: list5,
                    list6: list6,

                    price_unit1: price_unit1,
                    price_unit2: price_unit2,
                    price_unit3: price_unit3,
                    price_unit6: price_unit6,
                    
                    unit_befor2: unit_befor2,
                    unit_befor3: unit_befor3,
                    
                    unit_after2: unit_after2,
                    unit_after3: unit_after3,
                },
                function(res) {
                    simple.ajax.reload();
                    Swal.fire(res.title, res.msg, res.status);
                    location.reload();
                    closeLoading();

                },
            );
        }
    });

    //บันทึก F2
    $('#saveCusBtnF2').click(function() {
        var name_id = $('#name_id_f2').val();
        var status_id = 2;

        var list1 = $('#list1_f2').val();
        var list2 = $('#list2_f2').val();
        var list3 = $('#list3_f2').val();
        var list4 = $('#list4_f2').val();
        var list5 = $('#list5_f2').val();
        var list6 = $('#list6_f2').val();

        var price_unit1 = $('#price_unit1_f2').val();
        var price_unit2 = $('#price_unit2_f2').val();
        var price_unit3 = $('#price_unit3_f2').val();
        var price_unit6 = $('#price_unit6_f2').val();
        
        var unit_befor2 = $('#unit_befor2_f2').val();
        var unit_befor3 = $('#unit_befor3_f2').val();
        
        var unit_after2 = $('#unit_after2_f2').val();
        var unit_after3 = $('#unit_after3_f2').val();


        if (name_id == '' || name_id == null) {
            Swal.fire('แจ้งเตือน!', 'กรุณากรอกข้อมูลให้ครบถ้วน ', 'warning');
        } else {
            $.post("{{ route('admin.store.add') }}", data = {
                    _token: '{{ csrf_token() }}',
                    name_id: name_id,
                    status_id: status_id,

                    list1: list1,
                    list2: list2,
                    list3: list3,
                    list4: list4,
                    list5: list5,
                    list6: list6,

                    price_unit1: price_unit1,
                    price_unit2: price_unit2,
                    price_unit3: price_unit3,
                    price_unit6: price_unit6,
                    
                    unit_befor2: unit_befor2,
                    unit_befor3: unit_befor3,
                    
                    unit_after2: unit_after2,
                    unit_after3: unit_after3,
                },
                function(res) {
                    simple.ajax.reload();
                    Swal.fire(res.title, res.msg, res.status);
                    location.reload();
                    closeLoading();

                },
            );
        }
    });

    //บันทึก F3
    $('#saveCusBtnF3').click(function() {
        var name_id = $('#name_id_f3').val();
        var status_id = 3;

        var list1 = $('#list1_f3').val();
        var list2 = $('#list2_f3').val();
        var list3 = $('#list3_f3').val();
        var list4 = $('#list4_f3').val();
        var list5 = $('#list5_f3').val();
        var list6 = $('#list6_f3').val();

        var price_unit1 = $('#price_unit1_f3').val();
        var price_unit2 = $('#price_unit2_f3').val();
        var price_unit3 = $('#price_unit3_f3').val();
        var price_unit6 = $('#price_unit6_f3').val();
        
        var unit_befor2 = $('#unit_befor2_f3').val();
        var unit_befor3 = $('#unit_befor3_f3').val();
        
        var unit_after2 = $('#unit_after2_f3').val();
        var unit_after3 = $('#unit_after3_f3').val();


        if (name_id == '' || name_id == null) {
            Swal.fire('แจ้งเตือน!', 'กรุณากรอกข้อมูลให้ครบถ้วน ', 'warning');
        } else {
            $.post("{{ route('admin.store.add') }}", data = {
                    _token: '{{ csrf_token() }}',
                    name_id: name_id,
                    status_id: status_id,

                    list1: list1,
                    list2: list2,
                    list3: list3,
                    list4: list4,
                    list5: list5,
                    list6: list6,

                    price_unit1: price_unit1,
                    price_unit2: price_unit2,
                    price_unit3: price_unit3,
                    price_unit6: price_unit6,
                    
                    unit_befor2: unit_befor2,
                    unit_befor3: unit_befor3,
                    
                    unit_after2: unit_after2,
                    unit_after3: unit_after3,
                },
                function(res) {
                    simple.ajax.reload();
                    Swal.fire(res.title, res.msg, res.status);
                    location.reload();
                    closeLoading();

                },
            );
        }
    });
</script>
