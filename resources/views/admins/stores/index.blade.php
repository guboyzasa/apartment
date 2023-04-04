@extends('admin-layouts.master')

@section('title')
    Management
@endsection

@section('css')
    <style>
        @media (min-width: 992px) {
            .col-md-center {
                float: none;
                margin-left: auto;
                margin-right: auto;
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
            Management
        @endslot
    @endcomponent

    <div class="row">
        <div class="card" style="border-radius: 10px">
            <div class="card-body">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#floor1" role="tab" aria-selected="true">
                            <span class="d-block d-sm-none">F1</span>
                            <span class="d-none d-sm-block">Floor 1</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#floor2" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span class="d-block d-sm-none">F2</span>
                            <span class="d-none d-sm-block">Floor 2</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#floor3" role="tab" aria-selected="false"
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
                            <div class="mb-3">
                                <label for="name" class="form-label badge bg-success font-size-16">Floor 1</label>
                                <select name="name" id="name_id" class="form-control">
                                    <option value="">Select Room F1</option>
                                    @foreach ($cusOne as $detail)
                                        <option value="{{ $detail->id }}">{{ $detail->name }}</option>
                                    @endforeach
                                </select>
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
                                            {{-- <td><input type="number" class="formInput form-control" id="unit1"
                                                    value="" name="unit1" placeholder="" required readonly></td> --}}
                                            <td><input type="text" class="formInput form-control" id="list1"
                                                    value="ค่าห้อง" name="list1" placeholder="ค่าห้อง" required readonly>
                                            </td>
                                            <td><input type="number" class="formInput form-control" id="price_unit1"
                                                    value="" name="price_unit1" placeholder="0" required></td>
                                            <td><input type="number" class="formInput form-control" id="unit_befor1"
                                                    value="" name="unit_befor1" placeholder="" required readonly></td>
                                            <td><input type="number" class="formInput form-control" id="unit_after1"
                                                    value="" name="unit_after1" placeholder="" required readonly></td>
                                            {{-- <td><input type="number" class="formInput form-control" id="amount1"
                                                    value="" name="amount1" placeholder="" required readonly></td> --}}
                                        </tr>
                                        <tr>
                                            {{-- <td><input type="number" class="formInput form-control" id="unit2"
                                                    value="" name="unit2" placeholder="" required readonly></td> --}}
                                            <td><input type="text" class="formInput form-control" id="list2"
                                                    value="ค่าไฟฟ้า" name="list2" placeholder="ค่าไฟฟ้า" required
                                                    readonly>
                                            </td>
                                            <td><input type="number" class="formInput form-control" id="price_unit2"
                                                    value="" name="price_unit2" placeholder="0" required></td>
                                            <td><input type="number" class="formInput form-control" id="unit_befor2"
                                                    value="" name="unit_befor2" placeholder="0" required></td>
                                            <td><input type="number" class="formInput form-control" id="unit_after2"
                                                    value="" name="unit_after2" placeholder="0" required></td>
                                            {{-- <td><input type="number" class="formInput form-control" id="amount2"
                                                    value="" name="amount2" placeholder="" required readonly></td> --}}
                                        </tr>
                                        <tr>
                                            {{-- <td><input type="number" class="formInput form-control" id="unit3"
                                                    value="" name="unit3" placeholder="" required readonly></td> --}}
                                            <td><input type="text" class="formInput form-control" id="list3"
                                                    value="ค่าน้ำประปา" name="list3" placeholder="ค่าน้ำประปา" required
                                                    readonly></td>
                                            <td><input type="number" class="formInput form-control" id="price_unit3"
                                                    value="" name="price_unit3" placeholder="0" required></td>
                                            <td><input type="number" class="formInput form-control" id="unit_befor3"
                                                    value="" name="unit_befor3" placeholder="0" required></td>
                                            <td><input type="number" class="formInput form-control" id="unit_after3"
                                                    value="" name="unit_after3" placeholder="0" required></td>
                                            {{-- <td><input type="number" class="formInput form-control" id="amount3"
                                                    value="" name="amount3" placeholder="" required readonly></td> --}}
                                        </tr>
                                        <tr>
                                            {{-- <td><input type="number" class="formInput form-control" id="unit4"
                                                    value="" name="unit4" placeholder="" required readonly></td> --}}
                                            <td><input type="text" class="formInput form-control" id="list4"
                                                    value="ค่าโทรศัพท์" name="list4" placeholder="ค่าโทรศัพท์" required
                                                    readonly></td>
                                            <td><input type="number" class="formInput form-control" id="price_unit4"
                                                    value="" name="price_unit4" placeholder="" required readonly></td>
                                            <td><input type="number" class="formInput form-control" id="unit_befor4"
                                                    value="" name="unit_befor4" placeholder="" required readonly></td>
                                            <td><input type="number" class="formInput form-control" id="unit_after4"
                                                    value="" name="unit_after4" placeholder="" required readonly></td>
                                            {{-- <td><input type="number" class="formInput form-control" id="amount4"
                                                    value="" name="amount4" placeholder="" required readonly></td> --}}
                                        </tr>
                                        <tr>
                                            {{-- <td><input type="number" class="formInput form-control" id="unit5"
                                                    value="" name="unit5" placeholder="" required readonly></td> --}}
                                            <td><input type="text" class="formInput form-control" id="list5"
                                                    value="ค่าเคเบิล TV" name="list5" placeholder="ค่าเคเบิล TV"
                                                    required readonly></td>
                                            <td><input type="number" class="formInput form-control" id="price_unit5"
                                                    value="" name="price_unit5" placeholder="" required readonly></td>
                                            <td><input type="number" class="formInput form-control" id="unit_befor5"
                                                    value="" name="unit_befor5" placeholder="" required readonly></td>
                                            <td><input type="number" class="formInput form-control" id="unit_after5"
                                                    value="" name="unit_after5" placeholder="" required readonly></td>
                                            {{-- <td><input type="number" class="formInput form-control" id="amount5"
                                                    value="" name="amount5" placeholder="" required readonly></td> --}}
                                        </tr>
                                        <tr>
                                            {{-- <td><input type="number" class="formInput form-control" id="unit6"
                                                    value="" name="unit6" placeholder="" required readonly></td> --}}
                                            <td><input type="text" class="formInput form-control" id="list6"
                                                    value="อื่นๆ" name="list6" placeholder="อื่นๆ" required readonly>
                                            </td>
                                            <td><input type="number" class="formInput form-control" id="price_unit6"
                                                    value="" name="price_unit6" placeholder="0" required></td>
                                            <td><input type="number" class="formInput form-control" id="unit_befor6"
                                                    value="" name="unit_befor6" placeholder="" required readonly></td>
                                            <td><input type="number" class="formInput form-control" id="unit_after6"
                                                    value="" name="unit_after6" placeholder="" required readonly></td>
                                            {{-- <td><input type="number" class="formInput form-control" id="amount6"
                                                    value="" name="amount6" placeholder="" required readonly></td> --}}
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="mt-3 d-grid gap-1">
                            <button type="button" class="btn btn-primary waves-effect waves-light"
                                id="saveCusBtnF1">บันทึก</button>
                        </div>

                    </div>
                    <div class="tab-pane" id="floor2" role="tabpanel">
                        <div class="row">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label badge bg-warning font-size-16">Floor 2</label>
                                <select name="name" id="name_id_f2" class="form-control">
                                    <option value="">Select Room F2</option>
                                    @foreach ($cusTwo as $detail)
                                        <option value="{{ $detail->id }}">{{ $detail->name }}</option>
                                    @endforeach
                                </select>
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
                                            {{-- <td><input type="number" class="formInput form-control" id="unit1_f2"
                                                    value="" name="unit1" placeholder="" required readonly></td> --}}
                                            <td><input type="text" class="formInput form-control" id="list1_f2"
                                                    value="ค่าห้อง" name="list1" placeholder="ค่าห้อง" required readonly>
                                            </td>
                                            <td><input type="number" class="formInput form-control" id="price_unit1_f2"
                                                    value="" name="price_unit1" placeholder="0" required></td>
                                            <td><input type="number" class="formInput form-control" id="unit_befor1_f2"
                                                    value="" name="unit_befor1" placeholder="" required readonly></td>
                                            <td><input type="number" class="formInput form-control" id="unit_after1_f2"
                                                    value="" name="unit_after1" placeholder="" required readonly></td>
                                            {{-- <td><input type="number" class="formInput form-control" id="amount1_f2"
                                                    value="" name="amount1" placeholder="" required readonly></td> --}}
                                        </tr>
                                        <tr>
                                            {{-- <td><input type="number" class="formInput form-control" id="unit2_f2"
                                                    value="" name="unit2" placeholder="" required readonly></td> --}}
                                            <td><input type="text" class="formInput form-control" id="list2_f2"
                                                    value="ค่าไฟฟ้า" name="list2" placeholder="ค่าไฟฟ้า" required
                                                    readonly>
                                            </td>
                                            <td><input type="number" class="formInput form-control" id="price_unit2_f2"
                                                    value="" name="price_unit2" placeholder="0" required></td>
                                            <td><input type="number" class="formInput form-control" id="unit_befor2_f2"
                                                    value="" name="unit_befor2" placeholder="0" required></td>
                                            <td><input type="number" class="formInput form-control" id="unit_after2_f2"
                                                    value="" name="unit_after2" placeholder="0" required></td>
                                            {{-- <td><input type="number" class="formInput form-control" id="amount2_f2"
                                                    value="" name="amount2" placeholder="" required readonly></td> --}}
                                        </tr>
                                        <tr>
                                            {{-- <td><input type="number" class="formInput form-control" id="unit3_f2"
                                                    value="" name="unit3" placeholder="" required readonly></td> --}}
                                            <td><input type="text" class="formInput form-control" id="list3_f2"
                                                    value="ค่าน้ำประปา" name="list3" placeholder="ค่าน้ำประปา" required
                                                    readonly></td>
                                            <td><input type="number" class="formInput form-control" id="price_unit3_f2"
                                                    value="" name="price_unit3" placeholder="0" required></td>
                                            <td><input type="number" class="formInput form-control" id="unit_befor3_f2"
                                                    value="" name="unit_befor3" placeholder="0" required></td>
                                            <td><input type="number" class="formInput form-control" id="unit_after3_f2"
                                                    value="" name="unit_after3" placeholder="0" required></td>
                                            {{-- <td><input type="number" class="formInput form-control" id="amount3_f2"
                                                    value="" name="amount3" placeholder="" required readonly></td> --}}
                                        </tr>
                                        <tr>
                                            {{-- <td><input type="number" class="formInput form-control" id="unit4_f2"
                                                    value="" name="unit4" placeholder="" required readonly></td> --}}
                                            <td><input type="text" class="formInput form-control" id="list4_f2"
                                                    value="ค่าโทรศัพท์" name="list4" placeholder="ค่าโทรศัพท์" required
                                                    readonly></td>
                                            <td><input type="number" class="formInput form-control" id="price_unit4_f2"
                                                    value="" name="price_unit4" placeholder="" required readonly></td>
                                            <td><input type="number" class="formInput form-control" id="unit_befor4_f2"
                                                    value="" name="unit_befor4" placeholder="" required readonly></td>
                                            <td><input type="number" class="formInput form-control" id="unit_after4_f2"
                                                    value="" name="unit_after4" placeholder="" required readonly></td>
                                            {{-- <td><input type="number" class="formInput form-control" id="amount4_f2"
                                                    value="" name="amount4" placeholder="" required readonly></td> --}}
                                        </tr>
                                        <tr>
                                            {{-- <td><input type="number" class="formInput form-control" id="unit5_f2"
                                                    value="" name="unit5" placeholder="" required readonly></td> --}}
                                            <td><input type="text" class="formInput form-control" id="list5_f2"
                                                    value="ค่าเคเบิล TV" name="list5" placeholder="ค่าเคเบิล TV"
                                                    required readonly></td>
                                            <td><input type="number" class="formInput form-control" id="price_unit5_f2"
                                                    value="" name="price_unit5" placeholder="" required readonly></td>
                                            <td><input type="number" class="formInput form-control" id="unit_befor5_f2"
                                                    value="" name="unit_befor5" placeholder="" required readonly></td>
                                            <td><input type="number" class="formInput form-control" id="unit_after5_f2"
                                                    value="" name="unit_after5" placeholder="" required readonly></td>
                                            {{-- <td><input type="number" class="formInput form-control" id="amount5_f2"
                                                    value="" name="amount5" placeholder="" required readonly></td> --}}
                                        </tr>
                                        <tr>
                                            {{-- <td><input type="number" class="formInput form-control" id="unit6_f2"
                                                    value="" name="unit6" placeholder="" required readonly></td> --}}
                                            <td><input type="text" class="formInput form-control" id="list6_f2"
                                                    value="อื่นๆ" name="list6" placeholder="อื่นๆ" required readonly>
                                            </td>
                                            <td><input type="number" class="formInput form-control" id="price_unit6_f2"
                                                    value="" name="price_unit6" placeholder="0" required></td>
                                            <td><input type="number" class="formInput form-control" id="unit_befor6_f2"
                                                    value="" name="unit_befor6" placeholder="" required readonly></td>
                                            <td><input type="number" class="formInput form-control" id="unit_after6_f2"
                                                    value="" name="unit_after6" placeholder="" required readonly></td>
                                            {{-- <td><input type="number" class="formInput form-control" id="amount6_f2"
                                                    value="" name="amount6" placeholder="" required readonly></td> --}}
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="mt-3 d-grid gap-1">
                            <button type="button" class="btn btn-primary waves-effect waves-light"
                                id="saveCusBtnF2">บันทึก</button>
                        </div>
                    </div>
                    <div class="tab-pane" id="floor3" role="tabpanel">
                        <div class="row">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label badge bg-danger font-size-16">Floor 3</label>
                                <select name="name" id="name_id_f3" class="form-control">
                                    <option value="">Select Room F3</option>
                                    @foreach ($cusTree as $detail)
                                        <option value="{{ $detail->id }}">{{ $detail->name }}</option>
                                    @endforeach
                                </select>
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
                                            {{-- <td><input type="number" class="formInput form-control" id="unit1_f3"
                                                    value="" name="unit1" placeholder="" required readonly></td> --}}
                                            <td><input type="text" class="formInput form-control" id="list1_f3"
                                                    value="ค่าห้อง" name="list1" placeholder="ค่าห้อง" required readonly>
                                            </td>
                                            <td><input type="number" class="formInput form-control" id="price_unit1_f3"
                                                    value="" name="price_unit1" placeholder="0" required></td>
                                            <td><input type="number" class="formInput form-control" id="unit_befor1_f3"
                                                    value="" name="unit_befor1" placeholder="" required readonly></td>
                                            <td><input type="number" class="formInput form-control" id="unit_after1_f3"
                                                    value="" name="unit_after1" placeholder="" required readonly></td>
                                            {{-- <td><input type="number" class="formInput form-control" id="amount1_f3"
                                                    value="" name="amount1" placeholder="" required readonly></td> --}}
                                        </tr>
                                        <tr>
                                            {{-- <td><input type="number" class="formInput form-control" id="unit2_f3"
                                                    value="" name="unit2" placeholder="" required readonly></td> --}}
                                            <td><input type="text" class="formInput form-control" id="list2_f3"
                                                    value="ค่าไฟฟ้า" name="list2" placeholder="ค่าไฟฟ้า" required
                                                    readonly>
                                            </td>
                                            <td><input type="number" class="formInput form-control" id="price_unit2_f3"
                                                    value="" name="price_unit2" placeholder="0" required></td>
                                            <td><input type="number" class="formInput form-control" id="unit_befor2_f3"
                                                    value="" name="unit_befor2" placeholder="0" required></td>
                                            <td><input type="number" class="formInput form-control" id="unit_after2_f3"
                                                    value="" name="unit_after2" placeholder="0" required></td>
                                            {{-- <td><input type="number" class="formInput form-control" id="amount2_f3"
                                                    value="" name="amount2" placeholder="" required readonly></td> --}}
                                        </tr>
                                        <tr>
                                            {{-- <td><input type="number" class="formInput form-control" id="unit3_f3"
                                                    value="" name="unit3" placeholder="" required readonly></td> --}}
                                            <td><input type="text" class="formInput form-control" id="list3_f3"
                                                    value="ค่าน้ำประปา" name="list3" placeholder="ค่าน้ำประปา" required
                                                    readonly></td>
                                            <td><input type="number" class="formInput form-control" id="price_unit3_f3"
                                                    value="" name="price_unit3" placeholder="0" required></td>
                                            <td><input type="number" class="formInput form-control" id="unit_befor3_f3"
                                                    value="" name="unit_befor3" placeholder="0" required></td>
                                            <td><input type="number" class="formInput form-control" id="unit_after3_f3"
                                                    value="" name="unit_after3" placeholder="0" required></td>
                                            {{-- <td><input type="number" class="formInput form-control" id="amount3_f3"
                                                    value="" name="amount3" placeholder="" required readonly></td> --}}
                                        </tr>
                                        <tr>
                                            {{-- <td><input type="number" class="formInput form-control" id="unit4_f3"
                                                    value="" name="unit4" placeholder="" required readonly></td> --}}
                                            <td><input type="text" class="formInput form-control" id="list4_f3"
                                                    value="ค่าโทรศัพท์" name="list4" placeholder="ค่าโทรศัพท์" required
                                                    readonly></td>
                                            <td><input type="number" class="formInput form-control" id="price_unit4_f3"
                                                    value="" name="price_unit4" placeholder="" required readonly></td>
                                            <td><input type="number" class="formInput form-control" id="unit_befor4_f3"
                                                    value="" name="unit_befor4" placeholder="" required readonly></td>
                                            <td><input type="number" class="formInput form-control" id="unit_after4_f3"
                                                    value="" name="unit_after4" placeholder="" required readonly></td>
                                            {{-- <td><input type="number" class="formInput form-control" id="amount4_f3"
                                                    value="" name="amount4" placeholder="" required readonly></td> --}}
                                        </tr>
                                        <tr>
                                            {{-- <td><input type="number" class="formInput form-control" id="unit5_f3"
                                                    value="" name="unit5" placeholder="" required readonly></td> --}}
                                            <td><input type="text" class="formInput form-control" id="list5_f3"
                                                    value="ค่าเคเบิล TV" name="list5" placeholder="ค่าเคเบิล TV"
                                                    required readonly></td>
                                            <td><input type="number" class="formInput form-control" id="price_unit5_f3"
                                                    value="" name="price_unit5" placeholder="" required readonly></td>
                                            <td><input type="number" class="formInput form-control" id="unit_befor5_f3"
                                                    value="" name="unit_befor5" placeholder="" required readonly></td>
                                            <td><input type="number" class="formInput form-control" id="unit_after5_f3"
                                                    value="" name="unit_after5" placeholder="" required readonly></td>
                                            {{-- <td><input type="number" class="formInput form-control" id="amount5_f3"
                                                    value="" name="amount5" placeholder="" required readonly></td> --}}
                                        </tr>
                                        <tr>
                                            {{-- <td><input type="number" class="formInput form-control" id="unit6_f3"
                                                    value="" name="unit6" placeholder="" required readonly></td> --}}
                                            <td><input type="text" class="formInput form-control" id="list6_f3"
                                                    value="อื่นๆ" name="list6" placeholder="อื่นๆ" required readonly>
                                            </td>
                                            <td><input type="number" class="formInput form-control" id="price_unit6_f3"
                                                    value="" name="price_unit6" placeholder="0" required></td>
                                            <td><input type="number" class="formInput form-control" id="unit_befor6_f3"
                                                    value="" name="unit_befor6" placeholder="" required readonly></td>
                                            <td><input type="number" class="formInput form-control" id="unit_after6_f3"
                                                    value="" name="unit_after6" placeholder="" required readonly></td>
                                            {{-- <td><input type="number" class="formInput form-control" id="amount6_f3"
                                                    value="" name="amount6" placeholder="" required readonly></td> --}}
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mt-3 d-grid gap-1">
                            <button type="button" class="btn btn-primary waves-effect waves-light"
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
                        <a class="nav-link active" data-bs-toggle="tab" href="#fl1" role="tab"
                            aria-selected="false" tabindex="-1">
                            <span class="d-block d-sm-none">F1</span>
                            <span class="d-none d-sm-block">Floor 1</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#fl2" role="tab" aria-selected="false"
                            tabindex="-1">
                            <span class="d-block d-sm-none">F2</span>
                            <span class="d-none d-sm-block">Floor 2</span>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#fl3" role="tab" aria-selected="false"
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
                            <p class="text-muted font-size-16"><b>Floor 1</b></p>
                            <div class="table-responsive">
                                <table id="simple_table_f1" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr class="text-center">
                                            <th>ROOM</th>
                                            <th>ค่าห้อง</th>
                                            <th>ค่าไฟ</th>
                                            <th>ค่าน้ำ</th>
                                            {{-- <th>ค่าโทรศัพท์</th>
                                            <th>ค่าเคเบิล TV</th> --}}
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
                            <p class="text-muted font-size-16"><b>Floor 2</b></p>
                            <div class="table-responsive">
                                <table id="simple_table_f2" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr class="text-center">
                                            <th>ROOM</th>
                                            <th>ค่าห้อง</th>
                                            <th>ค่าไฟ</th>
                                            <th>ค่าน้ำ</th>
                                            {{-- <th>ค่าโทรศัพท์</th>
                                            <th>ค่าเคเบิล TV</th> --}}
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
                            <p class="text-muted font-size-16"><b>Floor 3</b></p>
                            <div class="table-responsive">
                                <table id="simple_table_f3" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr class="text-center">
                                            <th>ROOM</th>
                                            <th>ค่าห้อง</th>
                                            <th>ค่าไฟ</th>
                                            <th>ค่าน้ำ</th>
                                            {{-- <th>ค่าโทรศัพท์</th>
                                            <th>ค่าเคเบิล TV</th> --}}
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

    <!-- Modal Edit V1 -->
    <div class="modal fade" id="simpleModals" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span class="badge bg-success font-size-16"
                            id="modal_titles"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @csrf
                        <input type="hidden" class="formEdit form-control" name="id" id="id">
                        <div class="mb-3">
                            <label for="name" class="form-label">Customer</label>
                            <span class="text-danger">*</span>
                            <select name="name" id="show_name_id" class="form-control" readonly>
                                @foreach ($cusOne as $detail)
                                    <option value="{{ $detail->id }}">{{ $detail->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="">
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit V2 -->
    <div class="modal fade" id="simpleModalV2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span class="badge bg-success font-size-16"
                            id="modal_titleV2"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @csrf
                        <input type="hidden" class="formEdit form-control" name="id" id="id">
                        <div class="mb-3">
                            <label for="name" class="form-label">Customer</label>
                            <span class="text-danger">*</span>
                            <select name="name" id="show_nametwo_id" class="form-control" readonly>
                                @foreach ($cusTwo as $detail)
                                    <option value="{{ $detail->id }}">{{ $detail->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="">
                            
                        </div>
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

        //แก้ไข V1
        $('#editCusBtn').click(function() {
            var id = $('#id').val();
            var name_id = $('#show_name_id').val();
            var status_id = 1;
            var check1 = $('#show_check1').val();
            var check2 = $('#show_check2').val();
            var check3 = $('#show_check3').val();
            var check4 = $('#show_check4').val();
            var check5 = $('#show_check5').val();
            var check6 = $('#show_check6').val();
            var check7 = $('#show_check7').val();
            var check8 = $('#show_check8').val();
            var check9 = $('#show_check9').val();
            var check10 = $('#show_check10').val();
            var check11 = $('#show_check11').val();
            var check12 = $('#show_check12').val();

            if (name_id == '' || name_id == null) {
                Swal.fire('แจ้งเตือน!', 'กรุณากรอกข้อมูลให้ครบถ้วน ', 'warning');
            } else {
                $.post("{{ route('admin.store.update') }}", data = {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        name_id: name_id,
                        status_id: status_id,
                        check1: check1,
                        check2: check2,
                        check3: check3,
                        check4: check4,
                        check5: check5,
                        check6: check6,
                        check7: check7,
                        check8: check8,
                        check9: check9,
                        check10: check10,
                        check11: check11,
                        check12: check12,
                    },
                    function(res) {
                        // simple.ajax.reload();
                        Swal.fire(res.title, res.msg, res.status);
                        $('#simpleModals').modal("hide");
                        location.reload();
                        closeLoading();

                    },
                );
            }
        });

        //แก้ไข V2
        $('#editCusBtns').click(function() {
            var id = $('#id').val();
            var name_id = $('#show_nametwo_id').val();
            var status_id = 2;
            var check1 = $('#show_check01').val();
            var check2 = $('#show_check02').val();
            var check3 = $('#show_check03').val();
            var check4 = $('#show_check04').val();
            var check5 = $('#show_check05').val();
            var check6 = $('#show_check06').val();
            var check7 = $('#show_check07').val();
            var check8 = $('#show_check08').val();
            var check9 = $('#show_check09').val();
            var check10 = $('#show_check010').val();
            var check11 = $('#show_check011').val();
            var check12 = $('#show_check012').val();

            if (name_id == '' || name_id == null) {
                Swal.fire('แจ้งเตือน!', 'กรุณากรอกข้อมูลให้ครบถ้วน ', 'warning');
            } else {
                $.post("{{ route('admin.store.update') }}", data = {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        name_id: name_id,
                        status_id: status_id,
                        check1: check1,
                        check2: check2,
                        check3: check3,
                        check4: check4,
                        check5: check5,
                        check6: check6,
                        check7: check7,
                        check8: check8,
                        check9: check9,
                        check10: check10,
                        check11: check11,
                        check12: check12,
                    },
                    function(res) {
                        // simple.ajax.reload();
                        Swal.fire(res.title, res.msg, res.status);
                        $('#simpleModalV2').modal("hide");
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
    {{-- @include('admins.stores.showinfo') --}}
    {{-- @include('admins.stores.checkbox') --}}
@endsection
