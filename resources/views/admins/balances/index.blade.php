@extends('admin-layouts.master')

@section('title')
    Dashboard
@endsection

@section('css')
    <style>
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
                zoom: 1;
            }
        }
    </style>
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        @endslot
        @slot('title')
            Dashboard
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-md-6">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                            <p class="text-muted fw-medium">Apartment <b class="text-success">V1</b></p>
                            <h4 class="mb-0 text-success">{{ @number_format(@$countV1) }} คน</h4>
                        </div>
                        <div class="mini-stat-icon avatar-sm rounded-circle bg-success align-self-center">
                            <span class="avatar-title bg-success">
                                <i class='bx bx-user bx-flashing font-size-24'></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                            <p class="text-muted fw-medium">Apartment <b class="text-warning">V2</b></p>
                            <h4 class="mb-0 text-warning">{{ @number_format(@$countV2) }} คน</h4>
                        </div>
                        <div class="mini-stat-icon avatar-sm rounded-circle bg-warning align-self-center">
                            <span class="avatar-title bg-warning">
                                <i class='bx bx-user bx-flashing font-size-24'></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" data-bs-toggle="tab" href="#v1" role="tab" aria-selected="false"
                        tabindex="-1">
                        <span class="d-block d-sm-none">V1</span>
                        <span class="d-none d-sm-block">Apartment V1</span>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#v2" role="tab" aria-selected="false"
                        tabindex="-1">
                        <span class="d-block d-sm-none">V2</span>
                        <span class="d-none d-sm-block">Apartment V2</span>
                    </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content p-3 text-muted">
                <div class="tab-pane active show" id="v1" role="tabpanel">
                    <div class="text-center"><b class="badge bg-success font-size-18 ">Apartment V1</b><br>
                        <span class="text-danger text-center font-size-12"> ชำระทุกวันที่ 29 ของเดือน</span>
                    </div>
                    <br>
                    <div class="row">
                        <div class="">
                            <div id="doc-image">
                                <table id="" class="table table-bordered dt-responsive nowrap w-100"
                                    style="">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="text-center font-size-16" style="width:10%;height: 2%">Customer
                                            </th>
                                            <th class="text-center font-size-16" style="width:4%;height: 2%">29 ม.ค</th>
                                            <th class="text-center font-size-16" style="width:4%;height: 2%">29 ก.พ</th>
                                            <th class="text-center font-size-16" style="width:4%;height: 2%">29 มี.ค
                                            </th>
                                            <th class="text-center font-size-16" style="width:4%;height: 2%">29 เม.ย
                                            </th>
                                            <th class="text-center font-size-16" style="width:4%;height: 2%">29 พ.ค</th>
                                            <th class="text-center font-size-16" style="width:4%;height: 2%">29 มิ.ย
                                            </th>
                                            <th class="text-center font-size-16" style="width:4%;height: 2%">29 ก.ค</th>
                                            <th class="text-center font-size-16" style="width:4%;height: 2%">29 ส.ค</th>
                                            <th class="text-center font-size-16" style="width:4%;height: 2%">29 ก.ย</th>
                                            <th class="text-center font-size-16" style="width:4%;height: 2%">29 ต.ค</th>
                                            <th class="text-center font-size-16" style="width:4%;height: 2%">29 พ.ย</th>
                                            <th class="text-center font-size-16" style="width:4%;height: 2%">29 ธ.ค</th>
                                            {{-- <th>STATUS</th> --}}
                                            {{-- <th></th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($storeV1 as $detail)
                                            <tr>
                                                <td class="text-center font-size-16" style="height: 2%">
                                                    {{ $detail->customer->name }}
                                                </td>
                                                <td class="text-center">
                                                    @if ($detail->january == 1)
                                                        <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                    @elseif ($detail->january == 2)
                                                        <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                    @elseif ($detail->january == 3)
                                                        <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($detail->february == 1)
                                                        <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                    @elseif ($detail->february == 2)
                                                        <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                    @elseif ($detail->february == 3)
                                                        <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($detail->march == 1)
                                                        <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                    @elseif ($detail->march == 2)
                                                        <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                    @elseif ($detail->march == 3)
                                                        <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($detail->april == 1)
                                                        <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                    @elseif ($detail->april == 2)
                                                        <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                    @elseif ($detail->april == 3)
                                                        <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($detail->may == 1)
                                                        <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                    @elseif ($detail->may == 2)
                                                        <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                    @elseif ($detail->may == 3)
                                                        <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($detail->june == 1)
                                                        <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                    @elseif ($detail->june == 2)
                                                        <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                    @elseif ($detail->june == 3)
                                                        <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($detail->july == 1)
                                                        <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                    @elseif ($detail->july == 2)
                                                        <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                    @elseif ($detail->july == 3)
                                                        <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($detail->august == 1)
                                                        <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                    @elseif ($detail->august == 2)
                                                        <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                    @elseif ($detail->august == 3)
                                                        <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($detail->september == 1)
                                                        <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                    @elseif ($detail->september == 2)
                                                        <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                    @elseif ($detail->september == 3)
                                                        <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($detail->october == 1)
                                                        <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                    @elseif ($detail->october == 2)
                                                        <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                    @elseif ($detail->october == 3)
                                                        <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($detail->november == 1)
                                                        <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                    @elseif ($detail->november == 2)
                                                        <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                    @elseif ($detail->november == 3)
                                                        <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($detail->december == 1)
                                                        <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                    @elseif ($detail->december == 2)
                                                        <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                    @elseif ($detail->december == 3)
                                                        <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="text-center font-size-18">สถานะ :
                                    <i class='bx bxs-check-circle text-success font-size-20'></i> ชำระแล้ว
                                    <i class='bx bxs-x-circle text-danger font-size-20'></i> ยังไม่ชำระ
                                    <i class='bx bxs-check-circle text-warning font-size-20'></i> จ่ายรายปี
                                </div>
                                <div class="text-center font-size-18">ช่องทางชำระ : พร้อมเพย์ 0935287744 รชต
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="v2" role="tabpanel">
                    <div class="text-center"><b class="badge bg-warning font-size-18 ">Apartment V2</b><br>
                        <span class="text-danger text-center font-size-12"> ชำระทุกวันที่ 29 ของเดือน</span>
                    </div>
                    <br>
                    <div class="row">
                        <div class="">
                            <div id="doc-image">
                                <table id="" class="table table-bordered dt-responsive nowrap w-100"
                                    style="">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="text-center font-size-16" style="width:10%;height: 2%">Customer
                                            </th>
                                            <th class="text-center font-size-16" style="width:4%;height: 2%">29 ม.ค
                                            </th>
                                            <th class="text-center font-size-16" style="width:4%;height: 2%">29 ก.พ
                                            </th>
                                            <th class="text-center font-size-16" style="width:4%;height: 2%">29 มี.ค
                                            </th>
                                            <th class="text-center font-size-16" style="width:4%;height: 2%">29 เม.ย
                                            </th>
                                            <th class="text-center font-size-16" style="width:4%;height: 2%">29 พ.ค
                                            </th>
                                            <th class="text-center font-size-16" style="width:4%;height: 2%">29 มิ.ย
                                            </th>
                                            <th class="text-center font-size-16" style="width:4%;height: 2%">29 ก.ค
                                            </th>
                                            <th class="text-center font-size-16" style="width:4%;height: 2%">29 ส.ค
                                            </th>
                                            <th class="text-center font-size-16" style="width:4%;height: 2%">29 ก.ย
                                            </th>
                                            <th class="text-center font-size-16" style="width:4%;height: 2%">29 ต.ค
                                            </th>
                                            <th class="text-center font-size-16" style="width:4%;height: 2%">29 พ.ย
                                            </th>
                                            <th class="text-center font-size-16" style="width:4%;height: 2%">29 ธ.ค
                                            </th>
                                            {{-- <th>STATUS</th> --}}
                                            {{-- <th></th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($storeV2 as $detail)
                                            <tr>
                                                <td class="text-center font-size-16" style="height: 2%">
                                                    {{ $detail->customer->name }}
                                                </td>
                                                <td class="text-center">
                                                    @if ($detail->january == 1)
                                                        <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                    @elseif ($detail->january == 2)
                                                        <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                    @elseif ($detail->january == 3)
                                                        <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($detail->february == 1)
                                                        <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                    @elseif ($detail->february == 2)
                                                        <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                    @elseif ($detail->february == 3)
                                                        <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($detail->march == 1)
                                                        <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                    @elseif ($detail->march == 2)
                                                        <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                    @elseif ($detail->march == 3)
                                                        <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($detail->april == 1)
                                                        <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                    @elseif ($detail->april == 2)
                                                        <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                    @elseif ($detail->april == 3)
                                                        <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($detail->may == 1)
                                                        <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                    @elseif ($detail->may == 2)
                                                        <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                    @elseif ($detail->may == 3)
                                                        <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($detail->june == 1)
                                                        <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                    @elseif ($detail->june == 2)
                                                        <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                    @elseif ($detail->june == 3)
                                                        <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($detail->july == 1)
                                                        <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                    @elseif ($detail->july == 2)
                                                        <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                    @elseif ($detail->july == 3)
                                                        <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($detail->august == 1)
                                                        <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                    @elseif ($detail->august == 2)
                                                        <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                    @elseif ($detail->august == 3)
                                                        <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($detail->september == 1)
                                                        <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                    @elseif ($detail->september == 2)
                                                        <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                    @elseif ($detail->september == 3)
                                                        <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($detail->october == 1)
                                                        <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                    @elseif ($detail->october == 2)
                                                        <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                    @elseif ($detail->october == 3)
                                                        <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($detail->november == 1)
                                                        <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                    @elseif ($detail->november == 2)
                                                        <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                    @elseif ($detail->november == 3)
                                                        <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($detail->december == 1)
                                                        <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                    @elseif ($detail->december == 2)
                                                        <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                    @elseif ($detail->december == 3)
                                                        <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="text-center font-size-18">สถานะ :
                                    <i class='bx bxs-check-circle text-success font-size-20'></i> ชำระแล้ว
                                    <i class='bx bxs-x-circle text-danger font-size-20'></i> ยังไม่ชำระ
                                    <i class='bx bxs-check-circle text-warning font-size-20'></i> จ่ายรายปี
                                </div>
                                <div class="text-center font-size-18">ช่องทางชำระ : พร้อมเพย์ 0935287744 รชต
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row">
        <div class="card" style="border-radius: 10px">
            <div class="card-body">
                <div class="text-center"><b class="badge bg-success font-size-18 ">Apartment V1</b><br>
                    <span class="text-danger text-center font-size-12"> ชำระทุกวันที่ 29 ของเดือน</span>
                </div>
                <br>
                <div class="row">
                    <div class="">
                        <div id="doc-image">
                            <table id="" class="table table-bordered dt-responsive nowrap w-100" style="">
                                <thead>
                                    <tr class="text-center">
                                        <th class="text-center font-size-16" style="width:10%;height: 2%">Customer</th>
                                        <th class="text-center font-size-16" style="width:4%;height: 2%">29 ม.ค</th>
                                        <th class="text-center font-size-16" style="width:4%;height: 2%">29 ก.พ</th>
                                        <th class="text-center font-size-16" style="width:4%;height: 2%">29 มี.ค</th>
                                        <th class="text-center font-size-16" style="width:4%;height: 2%">29 เม.ย</th>
                                        <th class="text-center font-size-16" style="width:4%;height: 2%">29 พ.ค</th>
                                        <th class="text-center font-size-16" style="width:4%;height: 2%">29 มิ.ย</th>
                                        <th class="text-center font-size-16" style="width:4%;height: 2%">29 ก.ค</th>
                                        <th class="text-center font-size-16" style="width:4%;height: 2%">29 ส.ค</th>
                                        <th class="text-center font-size-16" style="width:4%;height: 2%">29 ก.ย</th>
                                        <th class="text-center font-size-16" style="width:4%;height: 2%">29 ต.ค</th>
                                        <th class="text-center font-size-16" style="width:4%;height: 2%">29 พ.ย</th>
                                        <th class="text-center font-size-16" style="width:4%;height: 2%">29 ธ.ค</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($storeV1 as $detail)
                                        <tr>
                                            <td class="text-center font-size-16" style="height: 2%">
                                                {{ $detail->customer->name }}
                                            </td>
                                            <td class="text-center">
                                                @if ($detail->january == 1)
                                                    <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                @elseif ($detail->january == 2)
                                                    <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                @elseif ($detail->january == 3)
                                                    <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($detail->february == 1)
                                                    <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                @elseif ($detail->february == 2)
                                                    <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                @elseif ($detail->february == 3)
                                                    <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($detail->march == 1)
                                                    <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                @elseif ($detail->march == 2)
                                                    <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                @elseif ($detail->march == 3)
                                                    <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($detail->april == 1)
                                                    <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                @elseif ($detail->april == 2)
                                                    <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                @elseif ($detail->april == 3)
                                                    <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($detail->may == 1)
                                                    <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                @elseif ($detail->may == 2)
                                                    <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                @elseif ($detail->may == 3)
                                                    <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($detail->june == 1)
                                                    <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                @elseif ($detail->june == 2)
                                                    <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                @elseif ($detail->june == 3)
                                                    <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($detail->july == 1)
                                                    <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                @elseif ($detail->july == 2)
                                                    <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                @elseif ($detail->july == 3)
                                                    <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($detail->august == 1)
                                                    <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                @elseif ($detail->august == 2)
                                                    <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                @elseif ($detail->august == 3)
                                                    <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($detail->september == 1)
                                                    <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                @elseif ($detail->september == 2)
                                                    <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                @elseif ($detail->september == 3)
                                                    <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($detail->october == 1)
                                                    <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                @elseif ($detail->october == 2)
                                                    <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                @elseif ($detail->october == 3)
                                                    <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($detail->november == 1)
                                                    <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                @elseif ($detail->november == 2)
                                                    <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                @elseif ($detail->november == 3)
                                                    <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($detail->december == 1)
                                                    <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                @elseif ($detail->december == 2)
                                                    <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                @elseif ($detail->december == 3)
                                                    <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="text-center font-size-18">สถานะ :
                                <i class='bx bxs-check-circle text-success font-size-20'></i> ชำระแล้ว
                                <i class='bx bxs-x-circle text-danger font-size-20'></i> ยังไม่ชำระ
                                <i class='bx bxs-check-circle text-warning font-size-20'></i> จ่ายรายปี
                            </div>
                            <div class="text-center font-size-18">ช่องทางชำระ : พร้อมเพย์ 0935287744 รชต
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="card" style="border-radius: 10px">
            <div class="card-body">
                <div class="text-center"><b class="badge bg-warning font-size-18 ">Apartment V2</b><br>
                    <span class="text-danger text-center font-size-12"> ชำระทุกวันที่ 29 ของเดือน</span>
                </div>
                <br>
                <div class="row">
                    <div class="">
                        <div id="doc-image">
                            <table id="" class="table table-bordered dt-responsive nowrap w-100" style="">
                                <thead>
                                    <tr class="text-center">
                                        <th class="text-center font-size-16" style="width:10%;height: 2%">Customer</th>
                                        <th class="text-center font-size-16" style="width:4%;height: 2%">29 ม.ค</th>
                                        <th class="text-center font-size-16" style="width:4%;height: 2%">29 ก.พ</th>
                                        <th class="text-center font-size-16" style="width:4%;height: 2%">29 มี.ค</th>
                                        <th class="text-center font-size-16" style="width:4%;height: 2%">29 เม.ย</th>
                                        <th class="text-center font-size-16" style="width:4%;height: 2%">29 พ.ค</th>
                                        <th class="text-center font-size-16" style="width:4%;height: 2%">29 มิ.ย</th>
                                        <th class="text-center font-size-16" style="width:4%;height: 2%">29 ก.ค</th>
                                        <th class="text-center font-size-16" style="width:4%;height: 2%">29 ส.ค</th>
                                        <th class="text-center font-size-16" style="width:4%;height: 2%">29 ก.ย</th>
                                        <th class="text-center font-size-16" style="width:4%;height: 2%">29 ต.ค</th>
                                        <th class="text-center font-size-16" style="width:4%;height: 2%">29 พ.ย</th>
                                        <th class="text-center font-size-16" style="width:4%;height: 2%">29 ธ.ค</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($storeV2 as $detail)
                                        <tr>
                                            <td class="text-center font-size-16" style="height: 2%">
                                                {{ $detail->customer->name }}
                                            </td>
                                            <td class="text-center">
                                                @if ($detail->january == 1)
                                                    <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                @elseif ($detail->january == 2)
                                                    <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                @elseif ($detail->january == 3)
                                                    <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($detail->february == 1)
                                                    <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                @elseif ($detail->february == 2)
                                                    <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                @elseif ($detail->february == 3)
                                                    <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($detail->march == 1)
                                                    <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                @elseif ($detail->march == 2)
                                                    <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                @elseif ($detail->march == 3)
                                                    <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($detail->april == 1)
                                                    <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                @elseif ($detail->april == 2)
                                                    <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                @elseif ($detail->april == 3)
                                                    <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($detail->may == 1)
                                                    <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                @elseif ($detail->may == 2)
                                                    <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                @elseif ($detail->may == 3)
                                                    <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($detail->june == 1)
                                                    <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                @elseif ($detail->june == 2)
                                                    <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                @elseif ($detail->june == 3)
                                                    <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($detail->july == 1)
                                                    <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                @elseif ($detail->july == 2)
                                                    <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                @elseif ($detail->july == 3)
                                                    <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($detail->august == 1)
                                                    <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                @elseif ($detail->august == 2)
                                                    <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                @elseif ($detail->august == 3)
                                                    <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($detail->september == 1)
                                                    <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                @elseif ($detail->september == 2)
                                                    <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                @elseif ($detail->september == 3)
                                                    <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($detail->october == 1)
                                                    <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                @elseif ($detail->october == 2)
                                                    <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                @elseif ($detail->october == 3)
                                                    <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($detail->november == 1)
                                                    <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                @elseif ($detail->november == 2)
                                                    <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                @elseif ($detail->november == 3)
                                                    <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($detail->december == 1)
                                                    <i class='bx bxs-check-circle text-success font-size-24'></i>
                                                @elseif ($detail->december == 2)
                                                    <i class='bx bxs-x-circle text-danger font-size-24'></i>
                                                @elseif ($detail->december == 3)
                                                    <i class='bx bxs-check-circle text-warning font-size-24'></i>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="text-center font-size-18">สถานะ :
                                <i class='bx bxs-check-circle text-success font-size-20'></i> ชำระแล้ว
                                <i class='bx bxs-x-circle text-danger font-size-20'></i> ยังไม่ชำระ
                                <i class='bx bxs-check-circle text-warning font-size-20'></i> จ่ายรายปี
                            </div>
                            <div class="text-center font-size-18">ช่องทางชำระ : พร้อมเพย์ 0935287744 รชต
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
@section('script')
    <script></script>
@endsection
