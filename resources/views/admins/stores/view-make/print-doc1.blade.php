@include('admin-layouts.head-css')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@100&display=swap');

    .page {
        background: rgb(255, 255, 255);
        width: 29.7cm;
        height: auto;
        display: block;
        margin: 0 auto;
        margin - bottom: 0.5cm;
        box - shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
        border: 0px solid black;
        font-family: 'Sarabun', sans-serif;

    }

    .page2 {
        background: rgb(255, 255, 255);
        height: auto;
        display: block;
        margin: 0 auto;
        border: 1px solid black;
        page-break-inside: avoid;
    }

    @media print {
        .page {
            margin: 0;
            box - shadow: 0;
        }
    }

    /* @media print {
        body {
            -webkit-print-color-adjust: avoid;
        }
    } */

    h1,
    h2,
    h3,
    .b {
        -webkit-text-stroke-width: 0.2px;
        -webkit-text-stroke-color: rgb(93, 93, 93);
        font-family: 'Sarabun', sans-serif;

        /* font-family: sans; color: yellow; */
    }

    #doc-image {
        height: auto;
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

<div id="doc-image">
    <div class="row">
        <div class="page mt-2 mb-4">
            <div class="row">
                @foreach ($listF1 as $detail)
                    <div class="col-sm-6 mb-2">
                        <div class="page2 mt-2 mb-0 blockquote" style="padding: 2.5%">
                            <div class="card-body">
                                <div class="text-center">
                                    <div class="invoice-title">
                                        <h4 class="float-start font-size-18 b"><b>No :</b> 0{{ $detail->id }}</h4>
                                    </div>
                                    <p class="text-dark font-size-24 b"><b>ใบแจ้งหนี้/ใบเสร็จรับเงิน</b></p>

                                </div>
                                <span class="text-dark font-size-24 b"><b>{{ $detail->company->name }}</b><span
                                        class="text-dark font-size-18 float-end b"><b>{{ $detail->customer->name }}</b></span></span><br>
                                <span class="text-dark"><b class="b">ที่อยู่ :</b>
                                    {{ $detail->company->address }}<br>{{ $detail->company->address2 }}
                                </span><br>
                                <span class="text-dark"><b class="b">เบอร์โทร/ไลน์ :</b> {{ $detail->company->phone }}</span>
                                <span class="text-danger float-end">* ชำระไม่เกินวันที่ 5 ของทุกเดือน</span>
                                <br>
                                <br>

                                <div class="table-responsive">
                                    <table class="table table-bordered dt-responsive nowrap w-100">
                                        <tr class="text-center">
                                            <th class="b" style="border-color: black">#</th>
                                            <th class="b" style="border-color: black">รายการ</th>
                                            <th class="b" style="border-color: black">ราคา/หน่วย</th>
                                            <th class="b" colspan="2" style="border-color: black">จำนวนหน่วย
                                            </th>
                                            <th class="b" style="border-color: black">จำนวน</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td class="text-center" style="border-color: black">{{ $detail->unit1 }}</td>
                                                <td class="text-center" style="border-color: black">{{ $detail->list1 }}</td>
                                                <td class="text-center" style="border-color: black">{{ number_format($detail->price_unit1) }}</td>
                                                <td class="text-center" style="border-color: black"></td>
                                                <td class="text-center" style="border-color: black"></td>
                                                <td class="text-center" style="border-color: black">{{ number_format($detail->amount1) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" style="border-color: black">{{ $detail->unit2 }}</td>
                                                <td class="text-center" style="border-color: black">{{ $detail->list2 }}</td>
                                                <td class="text-center" style="border-color: black">{{ number_format($detail->price_unit2) }}</td>
                                                <td class="text-center" style="border-color: black">{{ $detail->unit_befor2 }}</td>
                                                <td class="text-center" style="border-color: black">{{ $detail->unit_after2 }}</td>
                                                <td class="text-center" style="border-color: black">{{ number_format($detail->amount2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" style="border-color: black">{{ $detail->unit3 }}</td>
                                                <td class="text-center" style="border-color: black">{{ $detail->list3 }}</td>
                                                <td class="text-center" style="border-color: black">{{ number_format($detail->price_unit3) }}</td>
                                                <td class="text-center" style="border-color: black">{{ $detail->unit_befor3 }}</td>
                                                <td class="text-center" style="border-color: black">{{ $detail->unit_after3 }}</td>
                                                <td class="text-center" style="border-color: black">{{ number_format($detail->amount3) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-center" style="border-color: black">{{ $detail->unit6 }}</td>
                                                <td class="text-center" style="border-color: black">{{ $detail->list6 }}</td>
                                                <td class="text-center" style="border-color: black">{{ number_format($detail->price_unit6) }}</td>
                                                <td class="text-center" style="border-color: black"></td>
                                                <td class="text-center" style="border-color: black"></td>
                                                <td class="text-center" style="border-color: black">{{ number_format($detail->amount6) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-end" colspan="5" style="border-color: black">รวม</td>
                                                <td class="text-center" style="border-color: black">{{ number_format($detail->total_amount) }}</td>
                                            </tr>
                                            {{-- <tr>
                                                <td class="text-end" colspan="5">Vat 7%</td>
                                                <td></td>
                                            </tr> --}}
                                            <tr>
                                                <td class="text-end b" colspan="5" style="border-color: black">
                                                    <b>รวมสุทธิ</b></td>
                                                <td class="b text-center" style="border-color: black">
                                                    <b>{{ number_format($detail->total_amount) }}</b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="font-size-16 b">
                                        <b>ผู้รับ</b>
                                        .........................................................................
                                        <b>วันที่ออกบิล
                                        {{ date_format(date_create(@$detail->created_at), 'd / m / Y') }}</b><br>
                                        <b>ผู้รับเงิน</b>
                                        ...................................................................
                                        <b>วันที่.........../................/..............</b>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
