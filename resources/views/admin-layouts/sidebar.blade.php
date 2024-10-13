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
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards"> Dashboard </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.store.index') }}" class="waves-effect">
                        <i class='bx bx-terminal' ></i>
                        <span key="t-company"> Management </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.room.index') }}" class="waves-effect">
                        <i class='bx bx-group'></i>
                        <span key="t-company"> Room </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.room-charge.index') }}" class="waves-effect">
                        <i class='bx bx-group'></i>
                        <span key="t-company"> Room Charge </span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
