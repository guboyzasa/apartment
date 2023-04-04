<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title " key="t-menu">@lang('translation.Menu')</li>

                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards"> Dashboard </span>
                    </a>
                </li>

                <li class="{{ Route::is('work-today.*') ? 'mm-active' : '' }}">
                    <a href="{{ route('work-today.index') }}" class="waves-effect">
                        <i class='bx bx-calendar-check'></i>
                        <span key="t-work-today"> งานวันนี้ </span>
                    </a>
                </li>

                <li class="{{ Route::is('work.*') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class='bx bx-wrench'></i>
                        <span key="t-work">งานซ่อม-บริการ</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <li>
                                <a href="{{ route('work.get-work.index') }}" key="t-get-work"
                                    class="{{ Route::is('work.get-work.*') ? 'mm-active' : '' }}"> รับงานซ่อม-บริการ </a>
                            </li>
                            <li>
                                <a href="{{ route('work.work-history.index') }}" key="t-work-history"
                                    class="{{ Route::is('work.work-history.*') ? 'mm-active' : '' }}"> ประวัติการซ่อม </a>
                            </li>
                        </li>
                    </ul>
                </li>

            <li class="{{ Route::is('document.*') || Route::is('quotation.*') ? 'mm-active' : '' }}">
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class='bx bx-printer'></i>
                    <span key="t-document">งานเอกสาร</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li class="mb-1 {{ Route::is('quotation.*') ? 'mm-active' : '' }}">
                        <a href="{{ route('quotation.index') }}" key="t-get-documents-create_quotation"> 
                             <span key="t-documents">สร้างใบเสนอราคา</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <span key="t-documents">พิมพ์เอกสารลูกค้า</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <li>
                                    <a href="{{ route('document.customer-doc.doc1') }}" key="t-documents-repair">พิมพ์ใบรับซ่อม </a>
                                </li>
                                <li>
                                    <a href="{{ route('document.customer-doc.doc2') }}" key="t-documents-product">พิมพ์ใบรับสินค้าซ่อมคืน </a>
                                </li>
                                <li>
                                    <a href="{{ route('document.customer-doc.doc4') }}" key="t-get-documents-invoices">พิมพ์ใบเสร็จรับเงิน </a>
                                </li>
                                <li>
                                    <a href="{{ route('document.customer-doc.doc3') }}" key="t-get-documents-quotation">พิมพ์ใบเสนอราคา </a>
                                </li>
                            </li>
                        </ul>
                    </li>

                    <li class="">
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <span key="t-documentp">พิมพ์เอกสารสินค้า</span>
                        </a>
                        <ul class="sub-menu3" aria-expanded="false">
                            <li>
                                {{-- <li><a href="{{ route('document.customer-doc.doc5') }}" key="t-documentp-purchase-order"> พิมพ์ใบสั่งซื้อสินค้า </a></li> --}}
                            <li><a href="{{ route('document.customer-doc.doc6') }}" key="t-documentp-purchase">
                                    พิมพ์ใบรับเข้าสินค้า </a></li>
                            <li><a href="{{ route('document.customer-doc.doc7') }}" key="t-documentp-receipt">
                                    พิมพ์ใบเบิกสินค้า </a></li>
                    </li>
                    </ul>
                    </li>
                </ul>
            </li>



            <li class="{{ Route::is('customer.*') || Route::is('vendor.*') ? 'mm-active' : '' }}">
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class='bx bx-user'></i>
                    <span key="t-customer-vendor">ลูกค้า - ร้านค้า</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li>
                        <a href="{{ route('customer.index') }}" key="t-customer"> ลูกค้า </a>
                    </li>
                    <li>
                        <a href="{{ route('vendor.index') }}" key="t-vendor"> ร้านค้า </a>
                    </li>
                </ul>
            </li>

            <li class="{{ Route::is('set-product.*') ? 'mm-active' : '' }}">
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class='bx bx-store-alt'></i>
                    <span key="t-product-service">สินค้า-บริการ</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li>
                    <li>
                        <a href="{{ route('set-product.product.index') }}" key="t-product"> สินค้า-บริการ </a>
                    </li>
                    <li>
                        <a href="{{ route('set-product.product-cat.index') }}" key="t-product-cat"> หมวดหมู่สินค้า </a>
                    </li>
                    <li><a href="{{ route('set-product.product-brand.index') }}" key="t-product-brand"> แบรนด์สินค้า
                        </a></li>
                    <li><a href="{{ route('set-product.product-model.index') }}" key="t-product-model"> โมเดลสินค้า
                        </a></li>
                    <li><a href="{{ route('set-product.unit.index') }}" key="t-product-model"> หน่วยสินค้า </a></li>
            </li>
            </ul>
            </li>


            <li class="{{ Route::is('receive-product.*') ? 'mm-active' : '' }}">
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class='bx bx-import'></i>
                    <span key="t-product-service">รับสินค้าเข้า</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li>
                        <a href="{{ route('receive-product.index') }}" key="t-product">รับสินค้าเข้า</a>
                    </li>
                </ul>
            </li>


            @if (Auth::user()->company->companyPackage->package->is_fn_stock == 1)
                @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                <li class="{{ Route::is('show-stock.*') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class='bx bx-package'></i>
                        <span key="t-stock">Stock</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                 
                            <li>
                                <a href="{{ route('show-stock.index') }}" key="t-stock1"> Stock Card </a>
                            </li>
          
                            <li>
                                <a href="{{ route('show-stock.out') }}" key="t-stock1"> ประวัติการเบิกใช้สินค้า </a>
                            </li>
   
                            <li>
                                <a href="{{ route('show-stock.in') }}" key="t-stock2"> ประวัติการรับเข้าสินค้า </a>
                            </li>
                        </li>
                    </ul>
                </li>
                @endif
            @endif

            @if (Auth::user()->company->companyPackage->package->is_fn_report == 1)
                @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                    <li class="{{ Route::is('reports.*') ? 'mm-active' : '' }}">
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class='bx bx-list-check'></i>
                            <span key="t-report">รายงาน</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li>
                                <li>
                                    <a href="{{ route('reports.report1.index') }}" key="t-report1"> รายงานรับซ่อม-บริการ</a>
                                </li>
                                <li>
                                    <a href="{{ route('reports.report2.index') }}" key="t-report2"> รายงานการจ่ายงาน </a>
                                </li>
                                <li>
                                    <a href="{{ route('reports.report3.index') }}" key="t-report3">รายงานรับซ่อม-บริการคงค้าง</a>
                                </li>
                                <li>
                                    <a href="{{ route('reports.report4.index') }}" key="t-report4"> รายงานรายได้ (ยอดขาย)</a>
                                </li>
                                <li>
                                    <a href="{{ route('reports.report5.index') }}" key="t-report5">รายงานการเบิกใช้สินค้า </a>
                                </li>
                                <li>
                                    <a href="{{ route('reports.report7.index') }}" key="t-report7">รายงานการรับเข้าสินค้า </a>
                                </li>
                                @if (Auth::user()->company->companyPackage->package->is_fn_stock == 1)
                                <li>
                                    <a href="{{ route('reports.report8.index') }}" key="t-report6">รายงานสินค้าคงเหลือ </a>
                                </li>
                                <li>
                                    <a href="{{ route('reports.report6.index') }}" key="t-report6">รายงานสินค้าที่ต้องสั่งซื้อ </a>
                                </li>
                                @endif
                        
                            </li>
                        </ul>
                    </li>
                @endif
            @endif

            @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                <li>
                    <a href="{{ route('set-user.index') }}" class="waves-effect">
                        <i class='bx bxs-user-detail'></i>
                        <span key="t-user"> ผู้ใช้ </span>
                    </a>
                </li>
            @endif

            @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                <li class="{{ Route::is('setting.*') ? 'mm-active' : '' }}">
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class='bx bx-cog'></i>
                        <span key="t-setting">ตั้งค่า</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <li>
                                <a href="{{ route('setting.company.index') }}" key="t-setting-company"> ตั้งค่าข้อมูลร้าน </a>
                            </li>
                            <li>
                                <a href="{{ route('setting.set-docs.index') }}" key="t-setting-setdoc"> ตั้งค่าหัวเอกสาร</a>
                            </li>
                            <li>
                                <a href="{{ route('setting.enddoc.index') }}" key="t-setting-enddoc"> ตั้งค่าท้ายเอกสาร</a>
                            </li>
                            <li>
                                <a href="{{ route('setting.work-type.index') }}" key="t-setting-worktype">
                                    ตั้งค่าประเภทงาน
                                </a>
                            </li>
                        </li>
                    </ul>
                </li>
            @endif


            </ul>
        </div>
        <!-- Sidebar -->
        <!-- เปลี่ยนแพ็คเกจ -->
        @if (Auth::user()->role_id == 1)
            <div class="navbar-brand-box">
                <a href="{{ route('select-package.index') }}" class="logo logo-dark">
                    <h5 class="text-truncate font-size-14"> <span id=""><img class=""
                                srcset="{{ URL::asset('assets/images/bank_img/diamond.png') }}, {{ URL::asset('assets/images/bank_img/diamond.png') }} 2x"
                                src="{{ URL::asset('assets/images/bank_img/diamond.png') }}" alt=""
                                width="25" height="25">
                            <span style="margin: 2px;color: rgb(255, 255, 255)"> เปลี่ยนแพ็คเกจ</span></span>
                        <img srcset="{{ URL::asset('assets/images/bank_img/diamond.png') }}, {{ URL::asset('assets/images/bank_img/diamond.png') }} 2x"
                            src="{{ URL::asset('assets/images/bank_img/diamond.png') }}" alt="" width="25"
                            height="25">
                    </h5>
                </a>

                <a href="{{ route('select-package.index') }}" class="logo logo-light">
                    <h5 class="text-truncate font-size-14"> <span id=""><img
                                srcset="{{ URL::asset('assets/images/bank_img/diamond.png') }}, {{ URL::asset('assets/images/bank_img/diamond.png') }} 2x"
                                src="{{ URL::asset('assets/images/bank_img/diamond.png') }}" alt=""
                                width="25" height="25">
                            <span style="margin: 2px;color: rgb(255, 255, 255)"> เปลี่ยนแพ็คเกจ</span></span>
                        <img srcset="{{ URL::asset('assets/images/bank_img/diamond.png') }}, {{ URL::asset('assets/images/bank_img/diamond.png') }} 2x"
                            src="{{ URL::asset('assets/images/bank_img/diamond.png') }}" alt="" width="25"
                            height="25">
                    </h5>
                </a>
            </div>
         @endif
    </div>
</div>
<!-- Left Sidebar End -->
