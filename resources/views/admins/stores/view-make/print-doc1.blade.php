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
                                        <h4 class="float-start font-size-18">No : 0{{ $detail->id }}</h4>
                                    </div>
                                    <p class="text-dark font-size-24 b">ใบแจ้งหนี้/ใบเสร็จรับเงิน</p>
                                    
                                </div>
                                <span class="text-dark font-size-24">{{ $detail->company->name }}<span
                                        class="text-dark font-size-18 float-end">{{ $detail->customer->name }}</span></span><br>
                                <span class="text-dark">ที่อยู่ : {{ $detail->company->address }}<br>{{ $detail->company->address2 }}
                                </span><br>
                                <span class="text-dark">เบอร์โทร/ไลน์ : {{ $detail->company->phone}}</span>
                                <span class="text-danger float-end">* ชำระไม่เกินวันที่ 5 ของทุกเดือน</span>

                                <div class="table-responsive">
                                    <table class="table table-bordered dt-responsive nowrap w-100">
                                        <tr class="text-center">
                                            <th>หน่วย</th>
                                            <th>รายการ</th>
                                            <th>ราคา/หน่วย</th>
                                            <th colspan="2">จำนวนหน่วย</th>
                                            <th>จำนวน</th>
                                        </tr>
                                        <tbody>
                                            <tr>
                                                <td>{{ $detail->unit1 }}</td>
                                                <td>{{ $detail->list1 }}</td>
                                                <td>{{ $detail->price_unit1 }}</td>
                                                <td></td>
                                                <td></td>
                                                <td>{{ $detail->amount1 }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ $detail->unit2 }}</td>
                                                <td>{{ $detail->list2 }}</td>
                                                <td>{{ $detail->price_unit2 }}</td>
                                                <td>{{ $detail->unit_befor2 }}</td>
                                                <td>{{ $detail->unit_after2 }}</td>
                                                <td>{{ $detail->amount2 }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ $detail->unit3 }}</td>
                                                <td>{{ $detail->list3 }}</td>
                                                <td>{{ $detail->price_unit3 }}</td>
                                                <td>{{ $detail->unit_befor3 }}</td>
                                                <td>{{ $detail->unit_after3 }}</td>
                                                <td>{{ $detail->amount3 }}</td>
                                            </tr>
                                            <tr>
                                                <td>{{ $detail->unit6 }}</td>
                                                <td>{{ $detail->list6 }}</td>
                                                <td>{{ $detail->price_unit6 }}</td>
                                                <td></td>
                                                <td></td>
                                                <td>{{ $detail->amount6 }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-end" colspan="5">รวม</td>
                                                <td>{{ $detail->total_amount }}</td>
                                            </tr>
                                            {{-- <tr>
                                                <td class="text-end" colspan="5">Vat 7%</td>
                                                <td></td>
                                            </tr> --}}
                                            <tr>
                                                <td class="text-end" colspan="5">รวมสุทธิ</td>
                                                <td class="b">{{ $detail->total_amount }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="font-size-16">
                                        ผู้รับ
                                        .........................................................................
                                        วันที่ออกบิล
                                        {{ date_format(date_create(@$detail->created_at), 'd / m / Y') }}<br>
                                        ผู้รับเงิน
                                        ...................................................................
                                        วันที่.........../................/..............
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
