@extends('layouts.master-layouts2')


@section('title')
    สัญญาเช่า "{{ $company->name }}"
@endsection

@section('css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@200&display=swap');

        .page {
            font-family: 'Kanit', sans-serif;
        }

        h1,
        h2,
        h3,
        .b {
            -webkit-text-stroke-width: 0.1px;
            -webkit-text-stroke-color: rgb(93, 93, 93);
            font-family: 'Kanit', sans-serif;
        }

        #doc-image {
            height: auto;
        }

        @media only screen and (max-width: 300px) {
            #doc-image {
                zoom: .3;
            }
        }

        @media only screen and (max-width: 600px) {
            #doc-image {
                zoom: .4;
            }
        }

        @media only screen and (max-width: 800px) {
            #doc-image {
                zoom: .5;
            }
        }

        @media only screen and (min-width: 1000px) {
            #doc-image {
                zoom: .7;
            }
        }

        @media only screen and (min-width: 1500px) {
            #doc-image {
                zoom: .9;
            }
        }
    </style>
@endsection
@if ($company && $company->id)
    @section('content')
        <div class="page">
            <div class="container-xxl">
                <div class="row mt-2 mb-4">
                    <div class="col-md-12 mb-2">
                        {{-- <div class="card"> --}}
                        <div class="card-body">
                            <div class="text-center" style="display: flex; justify-content: space-between;">
                                <div style="margin: auto;">
                                    <p class="text-dark font-size-24 b"><b>สัญญาเช่า<br>{{ $company->name }}</b></p>
                                    <p class="font-size-14">{{ $company->address }}
                                        {{ $company->address2 }}<br>
                                        {{ $company->phone }}
                                </div>
                            </div>
                            <div class="">
                                <h4 class="float-end font-size-16 b"><b>วันที่ :</b> <?php echo date('d/m/Y h:i:s'); ?> น.</h4>
                            </div>

                            <div class="mt-5" id="doc-image">
                                <span class="text-dark font-size-16"><b
                                        class="b">เงื่อนไขและรายละเอียดดังต่อไปนี้</b></span><br>
                                @if ($condition->isEmpty())
                                    <p class="danger">ไม่พบข้อมูล.</p>
                                @else
                                    @foreach ($condition as $conditions)
                                        <span class="text-dark font-size-16 b">
                                            <b class="b">{{ $conditions->point }}.
                                            </b>&nbsp;{{ $conditions->info }}
                                        </span><br>
                                    @endforeach
                                @endif
                            </div>

                            <form class="row g-3 mt-2">
                                @csrf
                                <input type="hidden" lass="form-control" id="CompanyID" value="{{ $company->id }}">

                                <div class="col-md-3">
                                    <label for="inputRoomID" class="form-label">หมายเลขห้องเช่า <span
                                            class="text-danger">*</span></label><br>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select class="selectpicker form-control" name="inputRoomID" id="inputRoomID"
                                                required>
                                                <option value="" disabled selected>กรุณาเลือกหมายเลขห้องเช่า</option>

                                                <optgroup label="ชั้น 1">
                                                    @foreach ($cusOne as $detail)
                                                        <option value="{{ $detail->id }}"
                                                            @if (in_array($detail->id, $occupiedRooms)) disabled>{{ $detail->name }} (ห้องไม่ว่าง)</option>
                                                        @else>{{ $detail->name }}</option> @endif
                                                            @endforeach
                                                </optgroup>

                                                <optgroup label="ชั้น 2">
                                                    @foreach ($cusTwo as $detail)
                                                        <option value="{{ $detail->id }}"
                                                            @if (in_array($detail->id, $occupiedRooms)) disabled>{{ $detail->name }} (ห้องไม่ว่าง)</option>
                                                        @else>{{ $detail->name }}</option> @endif
                                                            @endforeach
                                                </optgroup>

                                                <optgroup label="ชั้น 3">
                                                    @foreach ($cusThree as $detail)
                                                        <option value="{{ $detail->id }}"
                                                            @if (in_array($detail->id, $occupiedRooms)) disabled>{{ $detail->name }} (ห้องไม่ว่าง)</option>
                                                        @else>{{ $detail->name }}</option> @endif
                                                            @endforeach
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="inputNickName" class="form-label">ชื่อเล่นผู้เช่า <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="inputNickName" placeholder="ชื่อเล่น"
                                        required>
                                </div>
                                <div class="col-md-3">
                                    <label for="inputPayment" class="form-label">
                                        ค่าห้อง<span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="inputPayment" placeholder="ค่าห้อง"
                                            aria-label="ค่าห้อง"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                            aria-describedby="basic-addon2" required>
                                        <span class="input-group-text" id="basic-addon2">บาท</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="inputPayment2" class="form-label">
                                        ค่าประกันห้อง<span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" id="inputPayment2"
                                            placeholder="ค่าประกันห้อง" aria-label="ค่าประกันห้อง"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                            aria-describedby="basic-addon2" required>
                                        <span class="input-group-text" id="basic-addon2">บาท</span>
                                    </div>
                                </div>
                                <label class="form-label" for="info">
                                    <b class="text-danger">**กรอกข้อมูลให้ตรงกับบัตรประชาชนหรือที่อยู่ที่สามารถติดต่อ!!</b>
                                </label>
                                <div class="col-md-3">
                                    <label for="inputpersonal_code" class="form-label">เลขบัตรประชาชนผู้เช่า <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="inputpersonal_code" value=""
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                        name="inputpersonal_code" placeholder="เลขบัตรประชาชนผู้เช่า" maxlength="13"
                                        autofocus required>
                                </div>
                                <div class="col-md-3">
                                    <label for="inputName" class="form-label">ชื่อ <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="inputName" placeholder="ชื่อ" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="inputLastName" class="form-label">สกุล <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="inputLastName" placeholder="สกุล"
                                        required>
                                </div>
                                <div class="col-md-3">
                                    <label for="inputPhone" class="form-label">เบอร์โทรศัพท์ <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="inputPhone"
                                        placeholder="เบอร์โทรศัพท์"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                        maxlength="10" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="inputAddress1" class="form-label">ที่อยู่ <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="inputAddress1"
                                        oninput="this.value = this.value.replace(/[^0-9./]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                        placeholder="บ้านเลขที่" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="inputAddress2" class="form-label">หมู่</label>
                                    <input type="text" class="form-control" id="inputAddress2" placeholder="หมู่ที่"
                                        oninput="this.value = this.value.replace(/[^0-9./]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                </div>
                                <div class="col-md-3">
                                    <label for="inputAddress3" class="form-label">ซอย</label>
                                    <input type="text" class="form-control" id="inputAddress3" placeholder="ซอย">
                                </div>
                                <div class="col-md-3">
                                    <label for="inputAddress4" class="form-label">ถนน</label>
                                    <input type="text" class="form-control" id="inputAddress4" placeholder="ถนน">
                                </div>
                                <div class="col-md-3">
                                    <label for="inputAddress5" class="form-label">แขวง/ตำบล <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="inputAddress5"
                                        placeholder="แขวง/ตำบล" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="inputAddress6" class="form-label">อำเภอ <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="inputAddress6" placeholder="อำเภอ"
                                        required>
                                </div>
                                <div class="col-md-3">
                                    <label for="inputAddress7" class="form-label">จังหวัด <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="inputAddress7" placeholder="จังหวัด"
                                        required>
                                </div>
                                <div class="col-md-3">
                                    <label for="inputZip" class="form-label">
                                        รหัสไปรษณีย์ <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="inputZip" placeholder="รหัสไปรษณีย์"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                        maxlength="5" required>
                                </div>
                                <label class="form-label" for="info">
                                    <b class="text-danger">**ข้อมูลบุคคลที่2ที่สามารถติดต่อได้!</b>
                                </label>
                                <div class="col-md-4">
                                    <label for="inputNickName2" class="form-label">ชื่อเล่นของบุคคลที่2 <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="inputNickName2"
                                        placeholder="ชื่อเล่นของบุคคลที่2" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="inputPhone2" class="form-label">เบอร์โทรศัพท์บุคคลที่2 <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="inputPhone2"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                        maxlength="10" placeholder="เบอร์โทรศัพท์บุคคลที่2" required>
                                </div>
                                <div class="col-md-4 text-center">
                                    <div id="showImage" class="text-center"
                                        style="position: relative; display: inline-block;">
                                        <!-- รูปภาพ -->
                                        <img id="output" style="width:270px; height:auto;">

                                        <!-- ลายน้ำ -->
                                        <div
                                            style="
                                            position: absolute;
                                            top: 50%;
                                            left: 50%;
                                            transform: translate(-50%, -50%) rotate(-45deg);
                                            color: rgba(255, 255, 255, 0.6);
                                            font-size: 24px;
                                            font-weight: bold;
                                            pointer-events: none;
                                            white-space: nowrap;
                                        ">
                                            ใช้เพื่อทำสัญญาเช่า
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="image" class="form-label">แนบรูปบัตรประชาชนหรือใบขับขี่เท่านั้น
                                        <span class="text-danger">*</span></label>
                                    <input type="file" onchange="loadFile(event)" class="form-control"
                                        accept="image/*" name="imageFile" id="imageFile" placeholder="กรุณาเลือกรูปภาพ"
                                        required>
                                    <input type="hidden" name="imgbase64" id="imgbase64" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="inputOther" class="form-label">หมายเหตุอื่นๆ</label>
                                    <textarea class="form-control" id="inputOther" rows="3" placeholder="หมายเหตุอื่นๆ"></textarea>
                                </div>
                                <label class="form-label" for="info">
                                    <b class="text-danger">**กรุณาตรวจสอบข้อมูลให้ถูกต้อง!! ก่อนกดบันทึกข้อมูล</b>
                                </label>
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-primary" id="saveCusBtn">บันทึกข้อมูล</button>
                                </div>
                            </form>
                        </div>
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
    @endsection
@else
    <div class="font-size-24 text-center mt-5">
        - ไม่พบข้อมูล -
    </div>
@endif

@section('script')
    <script>
        //บันทึก
        $('#saveCusBtn').click(function(e) {
            e.preventDefault();

            // เก็บค่าจากฟอร์ม
            var CompanyID = $('#CompanyID').val();
            var inputRoomID = $('#inputRoomID').val();
            var inputNickName = $('#inputNickName').val();
            var inputPayment = $('#inputPayment').val();
            var inputPayment2 = $('#inputPayment2').val();
            var inputpersonal_code = $('#inputpersonal_code').val();
            var inputName = $('#inputName').val();
            var inputLastName = $('#inputLastName').val();
            var inputPhone = $('#inputPhone').val();
            var inputAddress1 = $('#inputAddress1').val();
            var inputAddress2 = $('#inputAddress2').val();
            var inputAddress3 = $('#inputAddress3').val();
            var inputAddress4 = $('#inputAddress4').val();
            var inputAddress5 = $('#inputAddress5').val();
            var inputAddress6 = $('#inputAddress6').val();
            var inputAddress7 = $('#inputAddress7').val();
            var inputZip = $('#inputZip').val();
            var inputNickName2 = $('#inputNickName2').val();
            var inputPhone2 = $('#inputPhone2').val();
            var inputOther = $('#inputOther').val();
            var imgbase64 = $('#imgbase64').val();

            if (!inputRoomID || !inputNickName || !inputPayment || !inputPayment2 || !inputLastName ||
                !inputpersonal_code || !inputName || !inputPhone || !inputPhone2 ||
                !inputAddress1 || !inputAddress5 || !inputAddress6 || !inputAddress7 ||
                !inputZip || !inputNickName2) {
                toastr.warning('กรุณากรอกข้อมูลให้ครบถ้วน', 'แจ้งเตือน!', {
                    timeOut: 3000,
                    progressBar: true,
                    tapToDismiss: false
                });
            } else {
                $.post("{{ route('condition.store') }}", {
                        _token: '{{ csrf_token() }}',
                        CompanyID,
                        inputRoomID,
                        inputNickName,
                        inputPayment,
                        inputPayment2,
                        inputpersonal_code,
                        inputName,
                        inputLastName,
                        inputPhone,
                        inputAddress1,
                        inputAddress2,
                        inputAddress3,
                        inputAddress4,
                        inputAddress5,
                        inputAddress6,
                        inputAddress7,
                        inputZip,
                        inputNickName2,
                        inputPhone2,
                        inputOther,
                        imgbase64
                    }).done(function(res) {
                        if (res.status === 'success') {
                            // console.log(res);
                            // ถ้าบันทึกสำเร็จ
                            sessionStorage.setItem('savedId', res.id);
                            $.post('/set-saved-id', {
                                _token: '{{ csrf_token() }}',
                                savedId: res.id
                            }).done(function() {
                                window.location.href =
                                    '/list-condition/view-doc'; // เปลี่ยนหน้าโดยไม่ต้องมี id บน URL
                            });
                            closeLoading();
                            toastr.success(res.msg, res.title, {
                                timeOut: 3000,
                                progressBar: true,
                                tapToDismiss: false,
                            });
                        } else {
                            toastr.error(res.msg, res.title, {
                                timeOut: 3000,
                                progressBar: true,
                                tapToDismiss: false,
                            });
                        }
                    })
                    .fail(function() {
                        toastr.error('ไม่สามารถบันทึกข้อมูลได้', 'ข้อผิดพลาด', {
                            timeOut: 3000,
                            progressBar: true,
                            tapToDismiss: false,
                        });
                    });
            }
        });

        //เช็ค phone หน้าบ้านตอนเพิ่ม
        $("#inputPhone").keyup(function() {
            // console.log('OK');
            if ($(this).val().length == 10) {
                $.post("{{ route('condition.check-phone') }}",
                    data = {
                        _token: '{{ csrf_token() }}',
                        text: $(this).val(),
                    },
                    function(res) {
                        console.log(res)
                        if (res.status == 'warning') {
                            $("#inputPhone").val('');
                            Swal.fire(res.title, res.msg, res.status);
                        }
                    },
                );
            }
        });

        //เช็ค personal_code หน้าบ้านตอนเพิ่ม
        $("#inputpersonal_code").keyup(function() {
            // console.log('OK');
            if ($(this).val().length == 13) {
                $.post("{{ route('condition.check-personal') }}",
                    data = {
                        _token: '{{ csrf_token() }}',
                        text: $(this).val(),
                    },
                    function(res) {
                        console.log(res)
                        if (res.status == 'warning') {
                            $("#inputpersonal_code").val('');
                            Swal.fire(res.title, res.msg, res.status);
                        }
                    },
                );
            }
        });

        //img_resize
        var loadFile = function(event) {
            $('#showImg').show();
            resizeImages(event.target.files[0], function(url) {
                $('#imgbase64').val(url);
            });

            var reader = new FileReader();
            reader.onload = function(e) {
                $('#output').attr('src', e.target.result);
            }
            reader.readAsDataURL(event.target.files[0]);
        };

        function resizeImages(file, com) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = new Image();
                img.onload = function() {
                    com(resizeInCanvas(img));
                };
                img.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }

        function resizeInCanvas(img) {
            var perferedWidth = 600;
            var ratio = perferedWidth / img.width;
            var canvas = $("<canvas>")[0];
            canvas.width = img.width * ratio;
            canvas.height = img.height * ratio;
            var ctx = canvas.getContext("2d");
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
            var imgfile = canvas.toDataURL('image/png', 0);
            return imgfile;
        }
    </script>
@endsection
