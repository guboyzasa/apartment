@extends('admin-layouts.master')

@section('title')
    Management
@endsection

@section('css')
    <style>
        
    </style>
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        @endslot
        @slot('title')
            Management
        @endslot
    @endcomponent

    <div class="row">
        <div class="card" style="border-radius: 10px">
            <div class="card-body">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                    <li class="nav-item text-success" role="presentation">
                        <a class="nav-link active text-success" data-bs-toggle="tab" href="#floor1" role="tab" aria-selected="true">
                            <span class="d-block d-sm-none">F1</span>
                            <span class="d-none d-sm-block">Floor 1</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-warning" data-bs-toggle="tab" href="#floor2" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span class="d-block d-sm-none">F2</span>
                            <span class="d-none d-sm-block">Floor 2</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-danger" data-bs-toggle="tab" href="#floor3" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span class="d-block d-sm-none">F3</span>
                            <span class="d-none d-sm-block">Floor 3</span>
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content p-3 text-muted">
                    <div class="tab-pane active show" id="floor1" role="tabpanel">
                        <div class="row">
                            @csrf
                            <div class="mb-1">
                                <span for="name" class="form-label badge bg-success font-size-16">Floor
                                    1</span>
                            </div>
                            {{-- <div class="row"> --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <select name="name" id="name_id" class="form-control">
                                            <option value="">Select Room F1</option>
                                            @foreach ($cusOne as $detail)
                                                <option value="{{ $detail->id }}">{{ $detail->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <select name="company" id="company_id" class="form-control">
                                            {{-- <option value="">Company</option> --}}
                                            @foreach ($company as $detail)
                                                <option value="{{ $detail->id }}">{{ $detail->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            {{-- </div> --}}
                            {{-- <div class="doc-image"> --}}
                            <div class="table-responsive">
                                <table class="table table-success dt-responsive nowrap w-100">
                                    <tr class="text-center">
                                        {{-- <th>จำนวนหน่วยที่ใช้</th> --}}
                                        <th>รายการ</th>
                                        <th>ราคา/หน่วย</th>
                                        <th colspan="2">จำนวนหน่วย</th>
                                        {{-- <th>จำนวนเงิน</th> --}}
                                    </tr>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" class="formInput form-control" id="list1"
                                                    value="ค่าห้อง" name="list1" placeholder="ค่าห้อง" required>
                                            </td>
                                            <td>
                                                {{-- <input type="number" class="formInput form-control" id="price_unit1"
                                                    value="" name="price_unit1" placeholder="0" required> --}}
                                                    <select name="price_unit1" id="price_unit1" class="form-control">
                                                        <option value="1500">1500</option>
                                                        <option value="1800">1800</option>
                                                        <option value="2000">2000</option>
                                                        <option value="2300">2300</option>
                                                        <option value="2500">2500</option>
                                                        <option value="2900">2900</option>
                                                    </select>
                                                </td>
                                                <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="formInput form-control" id="list2"
                                                    value="ค่าไฟฟ้า" name="list2" placeholder="ค่าไฟฟ้า" required>
                                            </td>
                                            <td>
                                                {{-- <input type="number" class="formInput form-control" id="price_unit2"
                                                    value="9" name="price_unit2" placeholder="9" required readonly> --}}
                                                    <select name="price_unit2" id="price_unit2" class="form-control">
                                                        <option value="10">10</option>
                                                        <option value="120">120</option>
                                                    </select>
                                                </td>
                                            <td>
                                                <div class="input-group">
                                                    <span class="input-group-text"
                                                        id="inputGroup-sizing-default">ก่อน</span>
                                                    <input type="number" class="form-control"
                                                        aria-label="Sizing example input"
                                                        aria-describedby="inputGroup-sizing-default" id="unit_befor2"
                                                        value="" name="unit_befor2" placeholder="0" required>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <span class="input-group-text"
                                                        id="inputGroup-sizing-default">หลัง</span>
                                                    <input type="number" class="form-control"
                                                        aria-label="Sizing example input"
                                                        aria-describedby="inputGroup-sizing-default" id="unit_after2"
                                                        value="" name="unit_after2" placeholder="0" required>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="formInput form-control" id="list3"
                                                    value="ค่าน้ำประปา" name="list3" placeholder="ค่าน้ำประปา" required></td>
                                            <td>
                                                {{-- <input type="number" class="formInput form-control" id="price_unit3"
                                                    value="" name="price_unit3" placeholder="0" required> --}}
                                                    <select name="price_unit3" id="price_unit3" class="form-control">
                                                        <option value="30">30</option>
                                                        <option value="150">150</option>
                                                        
                                                    </select>
                                                </td>
                                            <td>
                                                <div class="input-group">
                                                    <span class="input-group-text"
                                                        id="inputGroup-sizing-default">ก่อน</span>
                                                    <input type="number" class="form-control"
                                                        aria-label="Sizing example input"
                                                        aria-describedby="inputGroup-sizing-default" id="unit_befor3"
                                                        value="" name="unit_befor3" placeholder="0" required>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <span class="input-group-text"
                                                        id="inputGroup-sizing-default">หลัง</span>
                                                    <input type="number" class="form-control"
                                                        aria-label="Sizing example input"
                                                        aria-describedby="inputGroup-sizing-default" id="unit_after3"
                                                        value="" name="unit_after3" placeholder="0" required>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="formInput form-control" id="list6"
                                                    value="อื่นๆ (Net)" name="list6" placeholder="อื่นๆ (Net)" required>
                                            </td>
                                            <td><input type="number" class="formInput form-control" id="price_unit6"
                                                    value="" name="price_unit6" placeholder="0" required></td>
                                                    <td colspan="2"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            {{-- </div> --}}
                        </div>
                        <div class="mt-3 d-grid gap-1">
                            <button type="button" class="btn btn-outline-success waves-effect waves-light"
                                id="saveCusBtnF1">บันทึก</button>
                        </div>

                    </div>
                    <div class="tab-pane" id="floor2" role="tabpanel">
                        <div class="row">
                            @csrf
                            <div class="mb-1">
                                <span for="name" class="form-label badge bg-warning font-size-16">Floor
                                    2</span>
                            </div>
                            {{-- <div class="row"> --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <select name="name" id="name_id_f2" class="form-control">
                                            <option value="">Select Room F2</option>
                                            @foreach ($cusTwo as $detail)
                                                <option value="{{ $detail->id }}">{{ $detail->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <select name="company" id="company_id_f2" class="form-control">
                                            {{-- <option value="">Company</option> --}}
                                            @foreach ($company as $detail)
                                                <option value="{{ $detail->id }}">{{ $detail->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            {{-- </div> --}}

                            <div class="table-responsive">
                                <table class="table table-warning dt-responsive nowrap w-100">
                                    <tr class="text-center">
                                        {{-- <th>จำนวนหน่วยที่ใช้</th> --}}
                                        <th>รายการ</th>
                                        <th>ราคา/หน่วย</th>
                                        <th colspan="2">จำนวนหน่วย</th>
                                        {{-- <th>จำนวนเงิน</th> --}}
                                    </tr>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" class="formInput form-control" id="list1_f2"
                                                    value="ค่าห้อง" name="list1" placeholder="ค่าห้อง" required>
                                            </td>
                                            <td>
                                                {{-- <input type="number" class="formInput form-control" id="price_unit1_f2"
                                                    value="" name="price_unit1" placeholder="0" required> --}}
                                                    <select name="price_unit1" id="price_unit1_f2" class="form-control">
                                                        <option value="1500">1500</option>
                                                        <option value="1800">1800</option>
                                                        <option value="2000">2000</option>
                                                        <option value="2300">2300</option>
                                                        <option value="2500">2500</option>
                                                        <option value="2900">2900</option>
                                                    </select>
                                                </td>
                                                <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="formInput form-control" id="list2_f2"
                                                    value="ค่าไฟฟ้า" name="list2" placeholder="ค่าไฟฟ้า" required>
                                            </td>
                                            <td>
                                                {{-- <input type="number" class="formInput form-control" id="price_unit2_f2"
                                                    value="9" name="price_unit2" placeholder="9" required readonly> --}}
                                                    <select name="price_unit2" id="price_unit2_f2" class="form-control">
                                                        <option value="10">10</option>
                                                        <option value="120">120</option>
                                                    </select>
                                                </td>
                                            <td>
                                                <div class="input-group">
                                                    <span class="input-group-text"
                                                        id="inputGroup-sizing-default">ก่อน</span>
                                                    <input type="number" class="form-control"
                                                        aria-label="Sizing example input"
                                                        aria-describedby="inputGroup-sizing-default" id="unit_befor2_f2"
                                                        value="" name="unit_befor2" placeholder="0" required>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <span class="input-group-text"
                                                        id="inputGroup-sizing-default">หลัง</span>
                                                    <input type="number" class="form-control"
                                                        aria-label="Sizing example input"
                                                        aria-describedby="inputGroup-sizing-default" id="unit_after2_f2"
                                                        value="" name="unit_after2" placeholder="0" required>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="formInput form-control" id="list3_f2"
                                                    value="ค่าน้ำประปา" name="list3" placeholder="ค่าน้ำประปา" required></td>
                                            <td>
                                                {{-- <input type="number" class="formInput form-control" id="price_unit3_f2"
                                                    value="" name="price_unit3" placeholder="0" required> --}}
                                                    <select name="price_unit3" id="price_unit3_f2" class="form-control">
                                                        <option value="30">30</option>
                                                        <option value="150">150</option>
                                                    </select>
                                                </td>
                                            <td>
                                                <div class="input-group">
                                                    <span class="input-group-text"
                                                        id="inputGroup-sizing-default">ก่อน</span>
                                                    <input type="number" class="form-control"
                                                        aria-label="Sizing example input"
                                                        aria-describedby="inputGroup-sizing-default" id="unit_befor3_f2"
                                                        value="" name="unit_befor3" placeholder="0" required>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <span class="input-group-text"
                                                        id="inputGroup-sizing-default">หลัง</span>
                                                    <input type="number" class="form-control"
                                                        aria-label="Sizing example input"
                                                        aria-describedby="inputGroup-sizing-default" id="unit_after3_f2"
                                                        value="" name="unit_after3" placeholder="0" required>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="formInput form-control" id="list6_f2"
                                                    value="อื่นๆ (Net)" name="list6" placeholder="อื่นๆ (Net)" required>
                                            </td>
                                            <td><input type="number" class="formInput form-control" id="price_unit6_f2"
                                                    value="" name="price_unit6" placeholder="0" required></td>
                                                    <td colspan="2"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="mt-3 d-grid gap-1">
                            <button type="button" class="btn btn-outline-warning waves-effect waves-light"
                                id="saveCusBtnF2">บันทึก</button>
                        </div>
                    </div>
                    <div class="tab-pane" id="floor3" role="tabpanel">
                        <div class="row">
                            @csrf
                            <div class="mb-1">
                                <span for="name" class="form-label badge bg-danger font-size-16">Floor
                                    3</span>
                            </div>
                            {{-- <div class="row"> --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <select name="name" id="name_id_f3" class="form-control">
                                            <option value="">Select Room F3</option>
                                            @foreach ($cusTree as $detail)
                                                <option value="{{ $detail->id }}">{{ $detail->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <select name="company" id="company_id_f3" class="form-control">
                                            {{-- <option value="">Company</option> --}}
                                            @foreach ($company as $detail)
                                                <option value="{{ $detail->id }}">{{ $detail->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            {{-- </div> --}}

                            <div class="table-responsive">
                                <table class="table table-danger dt-responsive nowrap w-100">
                                    <tr class="text-center">
                                        {{-- <th>จำนวนหน่วยที่ใช้</th> --}}
                                        <th>รายการ</th>
                                        <th>ราคา/หน่วย</th>
                                        <th colspan="2">จำนวนหน่วย</th>
                                        {{-- <th>จำนวนเงิน</th> --}}
                                    </tr>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" class="formInput form-control" id="list1_f3"
                                                    value="ค่าห้อง" name="list1" placeholder="ค่าห้อง" required>
                                            </td>
                                            <td>
                                                {{-- <input type="number" class="formInput form-control" id="price_unit1_f3"
                                                    value="" name="price_unit1" placeholder="0" required> --}}
                                                    <select name="price_unit1" id="price_unit1_f3" class="form-control">
                                                        <option value="1500">1500</option>
                                                        <option value="1800">1800</option>
                                                        <option value="2000">2000</option>
                                                        <option value="2300">2300</option>
                                                        <option value="2500">2500</option>
                                                        <option value="2900">2900</option>
                                                    </select>
                                                </td>
                                                <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="formInput form-control" id="list2_f3"
                                                    value="ค่าไฟฟ้า" name="list2" placeholder="ค่าไฟฟ้า" required>
                                            </td>
                                            <td>
                                                {{-- <input type="number" class="formInput form-control" id="price_unit2_f3"
                                                    value="9" name="price_unit2" placeholder="9" required readonly> --}}
                                                    <select name="price_unit2" id="price_unit2_f3" class="form-control">
                                                        <option value="10">10</option>
                                                        <option value="120">120</option>
                                                    </select>
                                                </td>
                                            <td>
                                                <div class="input-group">
                                                    <span class="input-group-text"
                                                        id="inputGroup-sizing-default">ก่อน</span>
                                                    <input type="number" class="form-control"
                                                        aria-label="Sizing example input"
                                                        aria-describedby="inputGroup-sizing-default" id="unit_befor2_f3"
                                                        value="" name="unit_befor2" placeholder="0" required>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <span class="input-group-text"
                                                        id="inputGroup-sizing-default">หลัง</span>
                                                    <input type="number" class="form-control"
                                                        aria-label="Sizing example input"
                                                        aria-describedby="inputGroup-sizing-default" id="unit_after2_f3"
                                                        value="" name="unit_after2" placeholder="0" required>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="formInput form-control" id="list3_f3"
                                                    value="ค่าน้ำประปา" name="list3" placeholder="ค่าน้ำประปา"
                                                    required></td>
                                            <td>
                                                {{-- <input type="number" class="formInput form-control" id="price_unit3_f3"
                                                    value="" name="price_unit3" placeholder="0" required> --}}
                                                    <select name="price_unit3" id="price_unit3_f3" class="form-control">
                                                        <option value="30">30</option>
                                                        <option value="150">150</option>
                                                    </select>
                                                </td>
                                            <td>
                                                <div class="input-group">
                                                    <span class="input-group-text"
                                                        id="inputGroup-sizing-default">ก่อน</span>
                                                    <input type="number" class="form-control"
                                                        aria-label="Sizing example input"
                                                        aria-describedby="inputGroup-sizing-default" id="unit_befor3_f3"
                                                        value="" name="unit_befor3" placeholder="0" required>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <span class="input-group-text"
                                                        id="inputGroup-sizing-default">หลัง</span>
                                                    <input type="number" class="form-control"
                                                        aria-label="Sizing example input"
                                                        aria-describedby="inputGroup-sizing-default" id="unit_after3_f3"
                                                        value="" name="unit_after3" placeholder="0" required>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="formInput form-control" id="list6_f3"
                                                    value="อื่นๆ (Net)" name="list6" placeholder="อื่นๆ (Net)" required>
                                            </td>
                                            <td><input type="number" class="formInput form-control" id="price_unit6_f3"
                                                    value="" name="price_unit6" placeholder="0" required></td>
                                                    <td colspan="2"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mt-3 d-grid gap-1">
                            <button type="button" class="btn btn-outline-danger waves-effect waves-light"
                                id="saveCusBtnF3">บันทึก</button>
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
                        <a class="nav-link active text-success" data-bs-toggle="tab" href="#fl1" role="tab"
                            aria-selected="false" tabindex="-1">
                            <span class="d-block d-sm-none">F1</span>
                            <span class="d-none d-sm-block">Floor 1</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-warning" data-bs-toggle="tab" href="#fl2" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span class="d-block d-sm-none">F2</span>
                            <span class="d-none d-sm-block">Floor 2</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-danger" data-bs-toggle="tab" href="#fl3" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span class="d-block d-sm-none">F3</span>
                            <span class="d-none d-sm-block">Floor 3</span>
                        </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content p-3 text-muted">
                    <div class="tab-pane active show" id="fl1" role="tabpanel">
                        <div class="col-12">
                            <p class="badge bg-success font-size-16"><b>Floor 1</b></p>
                            <div class="table-responsive">
                                <table id="simple_table_f1" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th>ROOM</th>
                                            <th>COM</th>
                                            <th>ค่าห้อง</th>
                                            <th>ค่าไฟ</th>
                                            <th>ค่าน้ำ</th>
                                            <th>อื่นๆ</th>
                                            <th>รวม</th>
                                            <th>STATUS</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- end col -->
                    </div>
                    <div class="tab-pane" id="fl2" role="tabpanel">
                        <div class="col-12">
                            <p class="badge bg-warning font-size-16"><b>Floor 2</b></p>
                            <div class="table-responsive">
                                <table id="simple_table_f2" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th>ROOM</th>
                                            <th>COM</th>
                                            <th>ค่าห้อง</th>
                                            <th>ค่าไฟ</th>
                                            <th>ค่าน้ำ</th>
                                            <th>อื่นๆ</th>
                                            <th>รวม</th>
                                            <th>STATUS</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- end col -->
                    </div>
                    <div class="tab-pane" id="fl3" role="tabpanel">
                        <div class="col-12">
                            <p class="badge bg-danger font-size-16"><b>Floor 3</b></p>
                            <div class="table-responsive">
                                <table id="simple_table_f3" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr class="text-center">
                                            <th>#</th>
                                            <th>ROOM</th>
                                            <th>COM</th>
                                            <th>ค่าห้อง</th>
                                            <th>ค่าไฟ</th>
                                            <th>ค่าน้ำ</th>
                                            <th>อื่นๆ</th>
                                            <th>รวม</th>
                                            <th>STATUS</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- end col -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit F1 -->
    <div class="modal fade" id="simpleModalF1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span class="badge bg-success font-size-16"
                            id="modal_titleF1"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @csrf
                        <input type="hidden" class="formEdit form-control" name="id" id="id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Room</label>
                                    <span class="text-danger">*</span>
                                    <select name="name" id="show_name_id" class="form-control" readonly>
                                        @foreach ($cusOne as $detail)
                                            <option value="{{ $detail->id }}">{{ $detail->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Company</label>
                                    <span class="text-danger">*</span>
                                    <select name="company" id="show_company_id" class="form-control" readonly>
                                        @foreach ($company as $detail)
                                            <option value="{{ $detail->id }}">{{ $detail->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered dt-responsive nowrap w-100">
                                <tr class="text-center">
                                    {{-- <th>จำนวนหน่วยที่ใช้</th> --}}
                                    <th>รายการ</th>
                                    <th>ราคา/หน่วย</th>
                                    <th colspan="2">จำนวนหน่วย</th>
                                    {{-- <th>จำนวนเงิน</th> --}}
                                </tr>
                                <tbody>
                                    <tr>
                                        <td><input type="text" class="formInput form-control" id="show_list1"
                                                value="ค่าห้อง" name="show_list1" placeholder="" required readonly>
                                        </td>
                                        <td><input type="number" class="formInput form-control" id="show_price_unit1"
                                                value="" name="show_price_unit1" placeholder="0" required></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="formInput form-control" id="show_list2"
                                                value="ค่าไฟฟ้า" name="show_list2" placeholder="" required readonly>
                                        </td>
                                        <td><input type="number" class="formInput form-control" id="show_price_unit2"
                                                value="" name="show_price_unit2" placeholder="0" required></td>
                                        <td>
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroup-sizing-default">ก่อน</span>
                                                <input type="number" class="form-control"
                                                    aria-label="Sizing example input"
                                                    aria-describedby="inputGroup-sizing-default" id="show_unit_befor2"
                                                    value="" name="show_unit_befor2" placeholder="0" required>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroup-sizing-default">หลัง</span>
                                                <input type="number" class="form-control"
                                                    aria-label="Sizing example input"
                                                    aria-describedby="inputGroup-sizing-default" id="show_unit_after2"
                                                    value="" name="show_unit_after2" placeholder="0" required>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="formInput form-control" id="show_list3"
                                                value="ค่าน้ำประปา" name="show_list3" placeholder="" required readonly>
                                        </td>
                                        <td><input type="number" class="formInput form-control" id="show_price_unit3"
                                                value="" name="show_price_unit3" placeholder="0" required></td>
                                        <td>
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroup-sizing-default">ก่อน</span>
                                                <input type="number" class="form-control"
                                                    aria-label="Sizing example input"
                                                    aria-describedby="inputGroup-sizing-default" id="show_unit_befor3"
                                                    value="" name="show_unit_befor3" placeholder="0" required>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroup-sizing-default">หลัง</span>
                                                <input type="number" class="form-control"
                                                    aria-label="Sizing example input"
                                                    aria-describedby="inputGroup-sizing-default" id="show_unit_after3"
                                                    value="" name="show_unit_after3" placeholder="0" required>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="formInput form-control" id="show_list6"
                                                value="อื่นๆ" name="show_list6" placeholder="" required readonly>
                                        </td>
                                        <td><input type="number" class="formInput form-control" id="show_price_unit6"
                                                value="" name="show_price_unit6" placeholder="0" required></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-3 d-grid gap-1">
                        <button type="button" class="btn btn-primary waves-effect waves-light"
                            id="editCusBtnF1">บันทึก</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit F2 -->
    <div class="modal fade" id="simpleModalF2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span class="badge bg-warning font-size-16"
                            id="modal_titleF2"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @csrf
                        <input type="hidden" class="formEdit form-control" name="id" id="id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Room</label>
                                    <span class="text-danger">*</span>
                                    <select name="name" id="show_name_id_f2" class="form-control" readonly>
                                        @foreach ($cusTwo as $detail)
                                            <option value="{{ $detail->id }}">{{ $detail->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Company</label>
                                    <span class="text-danger">*</span>
                                    <select name="company" id="show_company_id_f2" class="form-control" readonly>
                                        @foreach ($company as $detail)
                                            <option value="{{ $detail->id }}">{{ $detail->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered dt-responsive nowrap w-100">
                                <tr class="text-center">
                                    {{-- <th>จำนวนหน่วยที่ใช้</th> --}}
                                    <th>รายการ</th>
                                    <th>ราคา/หน่วย</th>
                                    <th colspan="2">จำนวนหน่วย</th>
                                    {{-- <th>จำนวนเงิน</th> --}}
                                </tr>
                                <tbody>
                                    <tr>
                                        <td><input type="text" class="formInput form-control" id="show_list1_f2"
                                                value="ค่าห้อง" name="show_list1_f2" placeholder="" required readonly>
                                        </td>
                                        <td><input type="number" class="formInput form-control" id="show_price_unit1_f2"
                                                value="" name="show_price_unit1_f2" placeholder="0" required></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="formInput form-control" id="show_list2_f2"
                                                value="ค่าไฟฟ้า" name="show_list2_f2" placeholder="" required readonly>
                                        </td>
                                        <td><input type="number" class="formInput form-control" id="show_price_unit2_f2"
                                                value="" name="show_price_unit2_f2" placeholder="0" required></td>
                                        <td>
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroup-sizing-default">ก่อน</span>
                                                <input type="number" class="form-control"
                                                    aria-label="Sizing example input"
                                                    aria-describedby="inputGroup-sizing-default" id="show_unit_befor2_f2"
                                                    value="" name="show_unit_befor2_f2" placeholder="0" required>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroup-sizing-default">หลัง</span>
                                                <input type="number" class="form-control"
                                                    aria-label="Sizing example input"
                                                    aria-describedby="inputGroup-sizing-default" id="show_unit_after2_f2"
                                                    value="" name="show_unit_after2_f2" placeholder="0" required>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="formInput form-control" id="show_list3_f2"
                                                value="ค่าน้ำประปา" name="show_list3_f2" placeholder="" required
                                                readonly></td>
                                        <td><input type="number" class="formInput form-control" id="show_price_unit3_f2"
                                                value="" name="show_price_unit3_f2" placeholder="0" required></td>
                                        <td>
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroup-sizing-default">ก่อน</span>
                                                <input type="number" class="form-control"
                                                    aria-label="Sizing example input"
                                                    aria-describedby="inputGroup-sizing-default" id="show_unit_befor3_f2"
                                                    value="" name="show_unit_befor3_f2" placeholder="0" required>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroup-sizing-default">หลัง</span>
                                                <input type="number" class="form-control"
                                                    aria-label="Sizing example input"
                                                    aria-describedby="inputGroup-sizing-default" id="show_unit_after3_f2"
                                                    value="" name="show_unit_after3_f2" placeholder="0" required>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="formInput form-control" id="show_list6_f2"
                                                value="อื่นๆ" name="show_list6_f2" placeholder="" required readonly>
                                        </td>
                                        <td><input type="number" class="formInput form-control" id="show_price_unit6_f2"
                                                value="" name="show_price_unit6_f2" placeholder="0" required></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-3 d-grid gap-1">
                        <button type="button" class="btn btn-primary waves-effect waves-light"
                            id="editCusBtnF2">บันทึก</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit F3 -->
    <div class="modal fade" id="simpleModalF3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span class="badge bg-danger font-size-16"
                            id="modal_titleF3"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @csrf
                        <input type="hidden" class="formEdit form-control" name="id" id="id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Room</label>
                                    <span class="text-danger">*</span>
                                    <select name="name" id="show_name_id_f3" class="form-control" readonly>
                                        @foreach ($cusTree as $detail)
                                            <option value="{{ $detail->id }}">{{ $detail->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Company</label>
                                    <span class="text-danger">*</span>
                                    <select name="company" id="show_company_id_f3" class="form-control" readonly>
                                        @foreach ($company as $detail)
                                            <option value="{{ $detail->id }}">{{ $detail->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered dt-responsive nowrap w-100">
                                <tr class="text-center">
                                    {{-- <th>จำนวนหน่วยที่ใช้</th> --}}
                                    <th>รายการ</th>
                                    <th>ราคา/หน่วย</th>
                                    <th colspan="2">จำนวนหน่วย</th>
                                    {{-- <th>จำนวนเงิน</th> --}}
                                </tr>
                                <tbody>
                                    <tr>
                                        <td><input type="text" class="formInput form-control" id="show_list1_f3"
                                                value="ค่าห้อง" name="show_list1_f3" placeholder="" required readonly>
                                        </td>
                                        <td><input type="number" class="formInput form-control" id="show_price_unit1_f3"
                                                value="" name="show_price_unit1_f3" placeholder="0" required></td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="formInput form-control" id="show_list2_f3"
                                                value="ค่าไฟฟ้า" name="show_list2_f3" placeholder="" required readonly>
                                        </td>
                                        <td><input type="number" class="formInput form-control" id="show_price_unit2_f3"
                                                value="" name="show_price_unit2_f3" placeholder="0" required></td>
                                        <td>
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroup-sizing-default">ก่อน</span>
                                                <input type="number" class="form-control"
                                                    aria-label="Sizing example input"
                                                    aria-describedby="inputGroup-sizing-default" id="show_unit_befor2_f3"
                                                    value="" name="show_unit_befor2_f3" placeholder="0" required>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroup-sizing-default">หลัง</span>
                                                <input type="number" class="form-control"
                                                    aria-label="Sizing example input"
                                                    aria-describedby="inputGroup-sizing-default" id="show_unit_after2_f3"
                                                    value="" name="show_unit_after2_f3" placeholder="0" required>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="formInput form-control" id="show_list3_f3"
                                                value="ค่าน้ำประปา" name="show_list3_f3" placeholder="" required
                                                readonly></td>
                                        <td><input type="number" class="formInput form-control" id="show_price_unit3_f3"
                                                value="" name="show_price_unit3_f3" placeholder="0" required></td>
                                        <td>
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroup-sizing-default">ก่อน</span>
                                                <input type="number" class="form-control"
                                                    aria-label="Sizing example input"
                                                    aria-describedby="inputGroup-sizing-default" id="show_unit_befor3_f3"
                                                    value="" name="show_unit_befor3_f3" placeholder="0" required>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                <span class="input-group-text" id="inputGroup-sizing-default">หลัง</span>
                                                <input type="number" class="form-control"
                                                    aria-label="Sizing example input"
                                                    aria-describedby="inputGroup-sizing-default" id="show_unit_after3_f3"
                                                    value="" name="show_unit_after3_f3" placeholder="0" required>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" class="formInput form-control" id="show_list6_f3"
                                                value="อื่นๆ" name="show_list6_f3" placeholder="" required readonly>
                                        </td>
                                        <td><input type="number" class="formInput form-control" id="show_price_unit6_f3"
                                                value="" name="show_price_unit6_f3" placeholder="0" required></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-3 d-grid gap-1">
                        <button type="button" class="btn btn-primary waves-effect waves-light"
                            id="editCusBtnF3">บันทึก</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('admins.stores.showTables')
    @include('admins.stores.saveBtn')
    <script>
        $(document).ready(function() {
            var simple = '';
        });

        //แก้ไข F1
        $('#editCusBtnF1').click(function() {
            var id = $('#id').val();
            var name_id = $('#show_name_id').val();
            var company_id = $('#show_company_id').val();
            var status_id = 1;

            var list1 = $('#show_list1').val();
            var list2 = $('#show_list2').val();
            var list3 = $('#show_list3').val();
            var list6 = $('#show_list6').val();

            var price_unit1 = $('#show_price_unit1').val();
            var price_unit2 = $('#show_price_unit2').val();
            var price_unit3 = $('#show_price_unit3').val();
            var price_unit6 = $('#show_price_unit6').val();

            var unit_befor2 = $('#show_unit_befor2').val();
            var unit_befor3 = $('#show_unit_befor3').val();

            var unit_after2 = $('#show_unit_after2').val();
            var unit_after3 = $('#show_unit_after3').val();

            if (name_id == '' || name_id == null) {
                Swal.fire('แจ้งเตือน!', 'กรุณากรอกข้อมูลให้ครบถ้วน ', 'warning');
            } else {
                $.post("{{ route('admin.store.update') }}", data = {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        name_id: name_id,
                        company_id: company_id,
                        status_id: status_id,

                        list1: list1,
                        list2: list2,
                        list3: list3,
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
                        // simple.ajax.reload();
                        Swal.fire(res.title, res.msg, res.status);
                        $('#simpleModalF1').modal("hide");
                        location.reload();
                        closeLoading();

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

            var list1 = $('#show_list1_f2').val();
            var list2 = $('#show_list2_f2').val();
            var list3 = $('#show_list3_f2').val();
            var list6 = $('#show_list6_f2').val();

            var price_unit1 = $('#show_price_unit1_f2').val();
            var price_unit2 = $('#show_price_unit2_f2').val();
            var price_unit3 = $('#show_price_unit3_f2').val();
            var price_unit6 = $('#show_price_unit6_f2').val();

            var unit_befor2 = $('#show_unit_befor2_f2').val();
            var unit_befor3 = $('#show_unit_befor3_f2').val();

            var unit_after2 = $('#show_unit_after2_f2').val();
            var unit_after3 = $('#show_unit_after3_f2').val();

            if (name_id == '' || name_id == null) {
                Swal.fire('แจ้งเตือน!', 'กรุณากรอกข้อมูลให้ครบถ้วน ', 'warning');
            } else {
                $.post("{{ route('admin.store.update') }}", data = {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        name_id: name_id,
                        company_id: company_id,
                        status_id: status_id,

                        list1: list1,
                        list2: list2,
                        list3: list3,
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
                        // simple.ajax.reload();
                        Swal.fire(res.title, res.msg, res.status);
                        $('#simpleModalF2').modal("hide");
                        location.reload();
                        closeLoading();

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

            var list1 = $('#show_list1_f3').val();
            var list2 = $('#show_list2_f3').val();
            var list3 = $('#show_list3_f3').val();
            var list6 = $('#show_list6_f3').val();

            var price_unit1 = $('#show_price_unit1_f3').val();
            var price_unit2 = $('#show_price_unit2_f3').val();
            var price_unit3 = $('#show_price_unit3_f3').val();
            var price_unit6 = $('#show_price_unit6_f3').val();

            var unit_befor2 = $('#show_unit_befor2_f3').val();
            var unit_befor3 = $('#show_unit_befor3_f3').val();

            var unit_after2 = $('#show_unit_after2_f3').val();
            var unit_after3 = $('#show_unit_after3_f3').val();

            if (name_id == '' || name_id == null) {
                Swal.fire('แจ้งเตือน!', 'กรุณากรอกข้อมูลให้ครบถ้วน ', 'warning');
            } else {
                $.post("{{ route('admin.store.update') }}", data = {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        name_id: name_id,
                        company_id: company_id,
                        status_id: status_id,

                        list1: list1,
                        list2: list2,
                        list3: list3,
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
                        // simple.ajax.reload();
                        Swal.fire(res.title, res.msg, res.status);
                        $('#simpleModalF3').modal("hide");
                        location.reload();
                        closeLoading();

                    },
                );
            }
        });

        //ลบข้อมูลยอด
        function destroy(id) {
            Swal.fire({
                title: 'คุณมั่นใจหรือไม่ ?',
                text: 'ที่จะลบรายการนี้',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#7A7978',
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก',

            }).then((result) => {
                if (result.isConfirmed) {
                    // openLoading();
                    $.post("{{ route('admin.store.destroy') }}", data = {
                            _token: '{{ csrf_token() }}',
                            id: id,
                        },
                        function(res) {
                            simple.ajax.reload();
                            closeLoading();
                            Swal.fire(res.title, res.msg, res.status);
                            location.reload();
                        },
                    );

                }
            });
        }

        //button switch
        setStatus = (id) => {
            // openLoading()
            $.ajax({
                type: "method",
                method: "POST",
                url: "{{ route('admin.store.set-active') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                },
                success: function(res) {
                    closeLoading()
                    simple.ajax.reload();
                }
            });
        }

        //addCommas
        function addCommas(nStr) {
            nStr += '';
            var x = nStr.split('.');
            var x1 = x[0];
            var x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }
    </script>
    @include('admins.stores.showinfo')
    {{-- @include('admins.stores.checkbox') --}}
@endsection
