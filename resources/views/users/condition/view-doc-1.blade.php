@if (isset($customer) && isset($company) && $customer->company_id)
    @include('admin-layouts.head-css')
    <title>สัญญาเช่าห้อง {{ $customer->room_number }} - {{ $company->name }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@200&display=swap');

        body {
            /* background: white; */
        }

        .page {
            background: rgb(255, 255, 255);
            width: 29.7cm;
            height: auto;
            display: block;
            margin: auto;
            /* margin - left: 2.54cm; */
            margin - bottom: 0.5cm;
            box - shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
            border: 0px solid black;
            font-family: 'Kanit', sans-serif;

        }

        @media print {
            .page {
                margin: 0;
                box - shadow: 0;
            }
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

        .image-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .image-wrapper {
            position: relative;
            display: inline-block;
        }

        .watermarked-image {
            width: 270px;
            height: 150px;
            /* object-fit: cover; */
            /* ปรับให้รูปไม่ยืดเบี้ยว */
        }

        .watermark-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            /* จัดให้อยู่ตรงกลางและหมุน */
            color: rgba(255, 255, 255, 1);
            /* สีดำโปร่งใส */
            font-size: 24px;
            /* ขนาดตัวอักษร */
            font-weight: 900;
            /* น้ำหนักตัวอักษรหนามาก */
            white-space: nowrap;
            pointer-events: none;
            /* ไม่ให้บังการคลิก */
            /* text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); */
            /* เพิ่มเงาให้ชัด */
        }
    </style>

    <div class="row">
        <div class="page mt-2 mb-2">
            <div class="row">
                <div class="col-md-12 mb-0">
                    <div class="card-body">
                        <div class="text-center" style="display: flex; justify-content: space-between;">
                            <div style="margin: auto;">
                                <p class="text-dark font-size-24 b"><b>สัญญาเช่า<br>{{ $company->name }}</b>
                                </p>
                            </div>
                        </div>
                        <div class="">
                            <h4 class="float-end font-size-16">
                                ทำที่...{{ $company->address }}...<br>วันที่...<?php echo date('d/m/Y'); ?>...</h4>
                        </div>

                        <div class="mt-5">
                            <span class="text-dark font-size-16">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สัญญาเช่าฉบับนี้ทำขึ้นระหว่าง&nbsp;<b
                                    class="b">{{ $company->name }}</b>&nbsp;โดย&nbsp;<b
                                    class="b">{{ $company->name_owner }} </b>ซึ่งต่อไปในสัญญานี้จะเรียก&nbsp;<b
                                    class="b">“ผู้ให้เช่า”</b>&nbsp;ฝ่ายหนึ่ง กับ
                            </span>
                            {{-- table-borderless --}}
                            <table class="table table-sm table-striped table-bordered">
                                <tbody>
                                    <tr>
                                        <th style="width: 22%">ชื่อ-นามสกุล</th>
                                        <td>{{ $customer->name }} {{ $customer->lastname }} </td>
                                        <th>โทรศัพท์</th>
                                        <td>{{ $customer->phone }}</td>
                                        <th>ห้อง</th>
                                        <td>{{ $customer->room_number }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 22%">บัตรประจำตัวประชาชน</th>
                                        <td>{{ $customer->personal_code }}</td>
                                        <th>วันที่เช่าพัก</th>
                                        <td>{{ $customer->created_at->format('d/m/Y') }}</td>
                                        <th>ค่าห้อง</th>
                                        <td colspan="2">{{ number_format($customer->payment) }} บาท</td>
                                    </tr>
                                    <tr>
                                        
                                        <th>ค่าประกันห้อง</th>
                                        <td>{{ number_format($customer->payment2) }} บาท</td>
                                        <th>จำนวนเงินที่ชำระล่วงหน้า</th>
                                        <td>{{ number_format($customer->payment_total) }} บาท</td>
                                        <th>สถานะ</th>
                                        <td class="text-danger" colspan="2"><b>"ผู้เช่า"</b></td>
                                    </tr>
                                    <tr>
                                        <th style="width: 22%">ที่อยู่</th>
                                        <td colspan="5">
                                            @if ($customer->address1)
                                                {{ $customer->address1 }}
                                            @endif
                                            @if ($customer->address2)
                                                หมู่ {{ $customer->address2 }}
                                            @endif
                                            @if ($customer->address3)
                                                ซ. {{ $customer->address3 }}
                                            @endif
                                            @if ($customer->address4)
                                                ถ. {{ $customer->address4 }}
                                            @endif
                                            @if ($customer->address5)
                                                ต. {{ $customer->address5 }}
                                            @endif
                                            @if ($customer->address6)
                                                อ. {{ $customer->address6 }}
                                            @endif
                                            @if ($customer->address7)
                                                จ. {{ $customer->address7 }}
                                            @endif
                                            @if ($customer->zipcode)
                                                {{ $customer->zipcode }}
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>


                        </div>
                        <div class="mt-0" id="doc-image">
                            <b class="font-size-14">คู่สัญญาทั้งสองฝ่ายตกลงทำสัญญากันโดยมีเงื่อนไขและรายละเอียดดังต่อไปนี้</b><br>
                            @if ($condition->isEmpty())
                                <p>No active conditions found.</p>
                            @else
                                @foreach ($condition as $conditions)
                                    <span class="text-dark font-size-14">
                                        <b class="b">{{ $conditions->point }}.
                                        </b>&nbsp;{{ $conditions->info }}
                                    </span><br>
                                @endforeach
                            @endif
                        </div>

                        <div class="mt-2 mb-3 text-center image-container">
                            <div class="image-wrapper">
                                <img src="{{ asset($customer->img) }}" alt="รูปบัตรประชาชน" class="watermarked-image">
                                <div class="watermark-text">ใช้เพื่อทำสัญญาเช่า</div>
                            </div>
                        </div>


                        <div class="container-md">
                            <table class="table-sm table-borderless" style="width:100%">
                                <tr>
                                    <th style="text-align: center">
                                        ลงชื่อ.........................................................................................ผู้เช่า<br>(&nbsp;&nbsp;{{ $customer->name }}&nbsp;{{ $customer->lastname }}&nbsp;&nbsp;)<br>โทร:{{ $customer->phone }}
                                    </th>
                                    <th></th>
                                    <th style="text-align: center">
                                        ลงชื่อ.........................................................................................พยาน<br>(&nbsp;&nbsp;&nbsp;{{ $customer->nickname2 }}&nbsp;&nbsp;&nbsp;)<br>โทร:{{ $customer->phone2 }}
                                    </th>
                                </tr>
                            </table>
                        </div>

                        <div class="container-md mt-1">
                            <table class="table-sm table-borderless" style="width:100%">
                                <tr>
                                    <th></th>
                                    <th style="text-align: center">
                                        ลงชื่อ.........................................................................................ผู้ให้เช่า<br>(&nbsp;&nbsp;{{ $company->name_owner }}&nbsp;&nbsp;)
                                    </th>
                                    <th></th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@else
    <div class="font-size-24 text-center mt-5">
        - ไม่พบข้อมูล -
    </div>
@endif
