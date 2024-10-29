<script>
    //F1
    // function showInfoF1(obj) {
    //     $('#modal_titleF1').text('Edit Floor 1');
    //     $('#id').val(obj.id);
    //     $('#show_room_id').val(obj.room_id).trigger('change');
    //     $('#show_company_id').val(obj.company_id).trigger('change');

    //     $('#show_company_id').on('change', function() {
    //         const companyId = $(this).val();

    //         if (companyId) {
    //             $.ajax({
    //                 type: 'POST',
    //                 url: "{{ route('admin.store.get-rooms') }}", // ใช้ route ใหม่ให้ตรงกับฟังก์ชัน
    //                 data: {
    //                     _token: '{{ csrf_token() }}',
    //                     company_id: companyId,
    //                 },
    //                 success: function(res) {
    //                     res.forEach(function(room) {
    //                         const roomText =
    //                             `${room.room_number} - ${room.nickname} (${room.phone})`;
    //                         $('#show_room_id').append(
    //                             $('<option>', {
    //                                 value: room.id,
    //                                 text: roomText
    //                             })
    //                         );
    //                     });
    //                 },
    //                 error: function(xhr) {
    //                     console.error('Error:', xhr);
    //                 }
    //             });
    //         }
    //     });

    //     $('#show_list1').val(obj.list1).trigger('change');
    //     $('#show_list2').val(obj.list2).trigger('change');
    //     $('#show_list3').val(obj.list3).trigger('change');
    //     $('#show_list6').val(obj.list6).trigger('change');
    //     $('#show_list7').val(obj.list7).trigger('change');

    //     $('#show_price_unit1').val(obj.price_unit1).trigger('change');
    //     $('#show_price_unit2').val(obj.price_unit2).trigger('change');
    //     $('#show_price_unit3').val(obj.price_unit3).trigger('change');
    //     $('#show_price_unit6').val(obj.price_unit6).trigger('change');
    //     $('#show_price_unit7').val(obj.price_unit7).trigger('change');
    //     $('#show_price_unit8').val(obj.price_unit8).trigger('change');

    //     $('#show_unit_befor2').val(obj.unit_befor2).trigger('change');
    //     $('#show_unit_after2').val(obj.unit_after2).trigger('change');

    //     $('#show_unit_befor3').val(obj.unit_befor3).trigger('change');
    //     $('#show_unit_after3').val(obj.unit_after3).trigger('change');

    //     $('#simpleModalF1').modal("show");
    // }

    function showInfoF1(obj) {
        $('#modal_titleF1').text('Edit Floor 1');
        $('#id').val(obj.id);
        $('#show_company_id').val(obj.company_id).trigger('change');
        
        // ล้างค่าเดิมของ #show_room_id ก่อนดึงข้อมูลใหม่
        $('#show_room_id').empty();

        console.log('Selected Company ID:', obj.company_id,obj.floor_id);
        // ดึงข้อมูลห้องทันทีที่ modal เปิด โดยอิงจาก company_id
        if (obj.company_id && obj.floor_id) {
            $.post("{{ route('admin.store.get-room') }}", {
                _token: '{{ csrf_token() }}',
                company_id: obj.company_id,
                floor_id: obj.floor_id
            })
            .done((res) => {
                res.forEach(room => {
                    const roomText = `${room.room_number} - ${room.nickname} (${room.phone})`;
                    $('#show_room_id').append(new Option(roomText, room.room_id));
                });

                // ตั้งค่า room_id ใน select หลังจากโหลดเสร็จ
                $('#show_room_id').val(obj.room_id).trigger('change');
            })
            .fail(xhr => console.error('Error:', xhr));
        }

        // กำหนดค่าให้ฟิลด์ต่าง ๆ
        ['list1', 'list2', 'list3', 'list6', 'list7'].forEach(id =>
            $(`#show_${id}`).val(obj[id]).trigger('change')
        );

        ['price_unit1', 'price_unit2', 'price_unit3', 'price_unit6', 'price_unit7', 'price_unit8'].forEach(id =>
            $(`#show_${id}`).val(obj[id]).trigger('change')
        );

        ['unit_befor2', 'unit_after2', 'unit_befor3', 'unit_after3'].forEach(id =>
            $(`#show_${id}`).val(obj[id]).trigger('change')
        );

        // แสดง modal
        $('#simpleModalF1').modal('show');
    }



    //F2
    // function showInfoF2(obj) {
    //     $('#modal_titleF2').text('Edit Floor 2');
    //     $('#id').val(obj.id);
    //     $('#show_room_id_f2').val(obj.room_id).trigger('change');
    //     $('#show_company_id_f2').val(obj.company_id).trigger('change');

    //     $('#show_list1_f2').val(obj.list1).trigger('change');
    //     $('#show_list2_f2').val(obj.list2).trigger('change');
    //     $('#show_list3_f2').val(obj.list3).trigger('change');
    //     $('#show_list6_f2').val(obj.list6).trigger('change');
    //     $('#show_list7_f2').val(obj.list7).trigger('change');

    //     $('#show_price_unit1_f2').val(obj.price_unit1).trigger('change');
    //     $('#show_price_unit2_f2').val(obj.price_unit2).trigger('change');
    //     $('#show_price_unit3_f2').val(obj.price_unit3).trigger('change');
    //     $('#show_price_unit6_f2').val(obj.price_unit6).trigger('change');
    //     $('#show_price_unit7_f2').val(obj.price_unit7).trigger('change');
    //     $('#show_price_unit8_f2').val(obj.price_unit8).trigger('change');

    //     $('#show_unit_befor2_f2').val(obj.unit_befor2).trigger('change');
    //     $('#show_unit_after2_f2').val(obj.unit_after2).trigger('change');

    //     $('#show_unit_befor3_f2').val(obj.unit_befor3).trigger('change');
    //     $('#show_unit_after3_f2').val(obj.unit_after3).trigger('change');

    //     $('#simpleModalF2').modal("show");
    // }

     //F3
    //  function showInfoF3(obj) {
    //     $('#modal_titleF3').text('Edit Floor 3');
    //     $('#id').val(obj.id);
    //     $('#show_room_id_f3').val(obj.room_id).trigger('change');
    //     $('#show_company_id_f3').val(obj.company_id).trigger('change');

    //     $('#show_list1_f3').val(obj.list1).trigger('change');
    //     $('#show_list2_f3').val(obj.list2).trigger('change');
    //     $('#show_list3_f3').val(obj.list3).trigger('change');
    //     $('#show_list6_f3').val(obj.list6).trigger('change');
    //     $('#show_list7_f3').val(obj.list7).trigger('change');

    //     $('#show_price_unit1_f3').val(obj.price_unit1).trigger('change');
    //     $('#show_price_unit2_f3').val(obj.price_unit2).trigger('change');
    //     $('#show_price_unit3_f3').val(obj.price_unit3).trigger('change');
    //     $('#show_price_unit6_f3').val(obj.price_unit6).trigger('change');
    //     $('#show_price_unit7_f3').val(obj.price_unit7).trigger('change');
    //     $('#show_price_unit8_f3').val(obj.price_unit8).trigger('change');

    //     $('#show_unit_befor2_f3').val(obj.unit_befor2).trigger('change');
    //     $('#show_unit_after2_f3').val(obj.unit_after2).trigger('change');

    //     $('#show_unit_befor3_f3').val(obj.unit_befor3).trigger('change');
    //     $('#show_unit_after3_f3').val(obj.unit_after3).trigger('change');

    //     $('#simpleModalF3').modal("show");
    // }
</script>
