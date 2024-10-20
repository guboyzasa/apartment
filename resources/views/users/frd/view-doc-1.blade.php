@if ($customer->company_id == 1)
    @include('admin-layouts.head-css')
    <title>สัญญาเช่าห้อง {{ $customer->room_number }} - {{ $frd->name }}</title>
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
    </style>

    <div class="row">
        <div class="page mt-2 mb-2">
            <div class="row">
                <div class="col-md-12 mb-0">
                    <div class="card-body">
                        <div class="text-center" style="display: flex; justify-content: space-between;">
                            <div style="margin: auto;">
                                <p class="text-dark font-size-20 b"><b>สัญญาเช่า<br>{{ $frd->name }}</b>
                                </p>
                            </div>
                        </div>
                        <div class="">
                            <h4 class="float-end font-size-16">
                                ทำที่...{{ $frd->address }}...<br>วันที่...<?php echo date('d/m/Y'); ?>...</h4>
                        </div>

                        <div class="mt-5">
                            <span class="text-dark font-size-16">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สัญญาเช่าฉบับนี้ทำขึ้นระหว่าง&nbsp;<b
                                    class="b">{{ $frd->name }}</b>&nbsp;โดย&nbsp;<b
                                    class="b">{{ $frd->name_owner }} </b>ซึ่งต่อไปในสัญญานี้จะเรียก&nbsp;<b
                                    class="b">“ผู้ให้เช่า”</b>&nbsp;ฝ่ายหนึ่ง กับ
                            </span>
                            <table class="table table-sm table-borderless">
                                <tbody>
                                    <tr>
                                        <th style="width: 25%">ชื่อ-นามสกุล</th>
                                        <td>{{ $customer->name }} {{ $customer->lastname }} </td>
                                        <th>โทรศัพท์</th>
                                        <td>{{ $customer->phone }}</td>
                                        <th>ห้อง</th>
                                        <td>{{ $customer->room_number }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 25%">บัตรประจำตัวประชาชน</th>
                                        <td>{{ $customer->personal_code }}</td>
                                        <th>วันที่เช่าพัก</th>
                                        <td colspan="3">{{ $customer->created_at->format('d/m/Y') }}</td>

                                    </tr>
                                    <tr>
                                        <th>จำนวนเงินที่ชำระล่วงหน้า</th>
                                        <td>{{ number_format($customer->payment) }} บาท</td>
                                        <th>สถานะ</th>
                                        <td class="text-danger" colspan="3">"ผู้เช่า"</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 25%">ที่อยู่</th>
                                        <td colspan="5">
                                            บ้านเลขที่ {{ $customer->address1 }} หมู่ {{ $customer->address2 }}
                                            ซอย {{ $customer->address3 }} ถนน {{ $customer->address4 }}
                                            แขวง/ตำบล {{ $customer->address5 }} อำเภอ {{ $customer->address6 }}
                                            จังหวัด {{ $customer->address7 }} {{ $customer->zipcode }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        <b class="font-size-14">คู่สัญญาทั้งสองฝ่ายตกลงทำสัญญากันโดยมีเงื่อนไขและรายละเอียดดังต่อไปนี้</b>

                        </div>
                        <div class="mt-0" id="doc-image">
                            @if ($info->isEmpty())
                                <p>No active conditions found.</p>
                            @else
                                @foreach ($info as $condition)
                                    <span class="text-dark font-size-14">
                                        <b class="b">{{ $condition->point }}.
                                        </b>&nbsp;{{ $condition->info }}
                                    </span><br>
                                @endforeach
                            @endif
                        </div>

                        <div class="mt-2 mb-3 text-center">
                            <img src="{{ asset($customer->img) }}" alt="รูปบัตรประชาชน" width="270px" height="150px">
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
                                        ลงชื่อ.........................................................................................ผู้ให้เช่า<br>(&nbsp;&nbsp;{{ $frd->name_owner }}&nbsp;&nbsp;)
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
