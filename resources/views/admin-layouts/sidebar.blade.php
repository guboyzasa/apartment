<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title " key="t-menu">@lang('translation.Menu')</li>

                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect">
                        <i class='bx bxs-dashboard' ></i>
                        <span key="t-dashboards"> Dashboard </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.store.index') }}" class="waves-effect">
                        <i class='bx bx-calendar-check'></i>
                        <span key="t-stores"> ออกบิลค่าห้อง </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.list-payment.index') }}" class="waves-effect">
                        <i class='bx bx-list-ol'></i>
                        <span key="t-stores"> รายการเรียกเก็บ </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.room.index') }}" class="waves-effect">
                        <i class='bx bx-buildings' ></i>
                        <span key="t-rooms"> ห้องพัก </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.room-rates.index') }}" class="waves-effect">
                        <i class='bx bx-dollar-circle' ></i>
                        <span key="t-room-rates"> ราคา/หน่วย </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.room-floor.index') }}" class="waves-effect">
                        <i class='bx bxl-stack-overflow'></i>
                        <span key="t-room-rates"> ชั้น </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.con-customer.index') }}" class="waves-effect">
                        <i class='bx bx-user-check' ></i>
                        <span key="t-con-customer"> สัญญาเช่า/ลูกค้า </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.condition.index') }}" class="waves-effect">
                        <i class='bx bx-list-check'></i>
                        <span key="t-condition"> เงื่อนไขสัญญาเช่า </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.location.index') }}" class="waves-effect">
                        <i class='bx bx-store-alt' ></i>
                        <span key="t-loaction"> ตั้งค่าสถานที่ </span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
