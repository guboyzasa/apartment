<script>
    //F1
    function showInfoF1(obj) {
        $('#modal_titleF1').text('แก้ไข Floor 1');
        $('#id').val(obj.id);
        $('#show_name_id').val(obj.customer_id).trigger('change');
        $('#show_company_id').val(obj.company_id).trigger('change');

        $('#show_list1').val(obj.list1).trigger('change');
        $('#show_list2').val(obj.list2).trigger('change');
        $('#show_list3').val(obj.list3).trigger('change');
        $('#show_list6').val(obj.list6).trigger('change');

        $('#show_price_unit1').val(obj.price_unit1).trigger('change');
        $('#show_price_unit2').val(obj.price_unit2).trigger('change');
        $('#show_price_unit3').val(obj.price_unit3).trigger('change');
        $('#show_price_unit6').val(obj.price_unit6).trigger('change');

        $('#show_unit_befor2').val(obj.unit_befor2).trigger('change');
        $('#show_unit_after2').val(obj.unit_after2).trigger('change');

        $('#show_unit_befor3').val(obj.unit_befor3).trigger('change');
        $('#show_unit_after3').val(obj.unit_after3).trigger('change');

        $('#simpleModalF1').modal("show");
    }

    //F2
    function showInfoF2(obj) {
        $('#modal_titleF2').text('แก้ไข Floor 2');
        $('#id').val(obj.id);
        $('#show_name_id_f2').val(obj.customer_id).trigger('change');
        $('#show_company_id_f2').val(obj.company_id).trigger('change');

        $('#show_list1_f2').val(obj.list1).trigger('change');
        $('#show_list2_f2').val(obj.list2).trigger('change');
        $('#show_list3_f2').val(obj.list3).trigger('change');
        $('#show_list6_f2').val(obj.list6).trigger('change');

        $('#show_price_unit1_f2').val(obj.price_unit1).trigger('change');
        $('#show_price_unit2_f2').val(obj.price_unit2).trigger('change');
        $('#show_price_unit3_f2').val(obj.price_unit3).trigger('change');
        $('#show_price_unit6_f2').val(obj.price_unit6).trigger('change');

        $('#show_unit_befor2_f2').val(obj.unit_befor2).trigger('change');
        $('#show_unit_after2_f2').val(obj.unit_after2).trigger('change');

        $('#show_unit_befor3_f2').val(obj.unit_befor3).trigger('change');
        $('#show_unit_after3_f2').val(obj.unit_after3).trigger('change');

        $('#simpleModalF2').modal("show");
    }

     //F2
     function showInfoF3(obj) {
        $('#modal_titleF3').text('แก้ไข Floor 3');
        $('#id').val(obj.id);
        $('#show_name_id_f3').val(obj.customer_id).trigger('change');
        $('#show_company_id_f3').val(obj.company_id).trigger('change');

        $('#show_list1_f3').val(obj.list1).trigger('change');
        $('#show_list2_f3').val(obj.list2).trigger('change');
        $('#show_list3_f3').val(obj.list3).trigger('change');
        $('#show_list6_f3').val(obj.list6).trigger('change');

        $('#show_price_unit1_f3').val(obj.price_unit1).trigger('change');
        $('#show_price_unit2_f3').val(obj.price_unit2).trigger('change');
        $('#show_price_unit3_f3').val(obj.price_unit3).trigger('change');
        $('#show_price_unit6_f3').val(obj.price_unit6).trigger('change');

        $('#show_unit_befor2_f3').val(obj.unit_befor2).trigger('change');
        $('#show_unit_after2_f3').val(obj.unit_after2).trigger('change');

        $('#show_unit_befor3_f3').val(obj.unit_befor3).trigger('change');
        $('#show_unit_after3_f3').val(obj.unit_after3).trigger('change');

        $('#simpleModalF3').modal("show");
    }

    //V2
    // function showInfoV2(obj) {
    //     $('#modal_titleV2').text('แก้ไข Apartment');
    //     $('#id').val(obj.id);
    //     $('#show_nametwo_id').val(obj.customer_id).trigger('change');

    //     $('#show_check01').val(obj.january).trigger('change');
    //     $('#show_check02').val(obj.february).trigger('change');
    //     $('#show_check03').val(obj.march).trigger('change');
    //     $('#show_check04').val(obj.april).trigger('change');
    //     $('#show_check05').val(obj.may).trigger('change');
    //     $('#show_check06').val(obj.june).trigger('change');
    //     $('#show_check07').val(obj.july).trigger('change');
    //     $('#show_check08').val(obj.august).trigger('change');
    //     $('#show_check09').val(obj.september).trigger('change');
    //     $('#show_check010').val(obj.october).trigger('change');
    //     $('#show_check011').val(obj.november).trigger('change');
    //     $('#show_check012').val(obj.december).trigger('change');

        // if ((obj.january)==1) {
        //     $('#show_check01').prop('checked', true).trigger('change');
        // } else {
        //     $('#show_check01').prop('checked', false).trigger('change');
        // };

        // if ((obj.february)==1) {
        //     $('#show_check02').prop('checked', true).trigger('change');
        // } else {
        //     $('#show_check02').prop('checked', false).trigger('change');
        // };

        // if ((obj.march)==1) {
        //     $('#show_check03').prop('checked', true).trigger('change');
        // } else {
        //     $('#show_check03').prop('checked', false).trigger('change');
        // };

        // if ((obj.april)==1) {
        //     $('#show_check04').prop('checked', true).trigger('change');
        // } else {
        //     $('#show_check04').prop('checked', false).trigger('change');
        // };

        // if ((obj.may)==1) {
        //     $('#show_check05').prop('checked', true).trigger('change');
        // } else {
        //     $('#show_check05').prop('checked', false).trigger('change');
        // };

        // if ((obj.june)==1) {
        //     $('#show_check06').prop('checked', true).trigger('change');
        // } else {
        //     $('#show_check06').prop('checked', false).trigger('change');
        // };

        // if ((obj.july)==1) {
        //     $('#show_check07').prop('checked', true).trigger('change');
        // } else {
        //     $('#show_check07').prop('checked', false).trigger('change');
        // };

        // if ((obj.august)==1) {
        //     $('#show_check08').prop('checked', true).trigger('change');
        // } else {
        //     $('#show_check08').prop('checked', false).trigger('change');
        // };

        // if ((obj.september)==1) {
        //     $('#show_check09').prop('checked', true).trigger('change');
        // } else {
        //     $('#show_check09').prop('checked', false).trigger('change');
        // };

        // if ((obj.october)==1) {
        //     $('#show_check010').prop('checked', true).trigger('change');
        // } else {
        //     $('#show_check010').prop('checked', false).trigger('change');
        // };

        // if ((obj.november)==1) {
        //     $('#show_check011').prop('checked', true).trigger('change');
        // } else {
        //     $('#show_check011').prop('checked', false).trigger('change');
        // };

        // if ((obj.december)==1) {
        //     $('#show_check012').prop('checked', true).trigger('change');
        // } else {
        //     $('#show_check012').prop('checked', false).trigger('change');
        // };

    //     $('#simpleModalV2').modal("show");
    // }
</script>
