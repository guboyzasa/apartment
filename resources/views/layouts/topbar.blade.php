<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ route('dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('assets/images/bank_img/l7.png') }}" alt="" height="42">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('assets/images/bank_img/logo-b-white.png') }}" alt="" height="42">
                    </span>
                </a>

                <a href="{{ route('dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('assets/images/bank_img/l7.png') }}" alt="" height="42" style="margin-left: -8px;">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('assets/images/bank_img/logo-b-white.png') }}" alt="" height="42">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
            <form class="app-search d-none d-lg-block" action="{{ route('search') }}" method="GET">
                <div class="position-relative">
                    <input type="text" class="form-control" name="search" placeholder="ค้นหาอะไรดี?">
                    <span class="bx bx-search-alt"></span>
                </div>
            </form>
        </div>

        <div class="text-center text-warning py-1"><span id="dates"></span><span id="clocks"
                onload="currentTimes()"></span></div>
        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3" id="search-form" action="{{ route('search') }}" method="GET">
                        <div class="form-group m-0">
                            <div class="input-group">
                                {{-- <input type="text"> --}}
                                <input type="text" class="form-control" placeholder="@lang('translation.Search')"
                                    aria-label="Search input" name="search" form="search-form">
                                <button class="btn btn-primary" type="submit" form="search-form"><i class="mdi mdi-magnify"></i></button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="bx bx-fullscreen"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="d-none d-xl-inline-block ms-1"
                        key="t-henry">{{ isset(Auth::user()->avatar) ? ucfirst(Auth::user()->name) : '' }}{{Auth::user()->name}} 
                        <i class='bx bx-check-double bx-tada font-size-16 align-middle me-2' style="color: {{ @$currentPackage->package->color }}"></i>
                        </span>
                    <img class="rounded-circle header-profile-user"
                        src="{{ isset(Auth::user()->avatar) ? asset(Auth::user()->avatar) : asset('/assets/images/users/avatars.png') }}"
                        alt="Header Avatar">
                    
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    @if(Auth::user()->role_id == 1)
                    <a class="dropdown-item d-block text-primary" href="{{ route('select-package.index') }}"><i class="bx bx-archive-in font-size-16 align-middle me-1"></i>
                        <span key="t-package">Package</span></a>
                    <div class="dropdown-divider"></div>
                    @endif
                    <a class="dropdown-item d-block" href="#" data-bs-toggle="modal"
                        data-bs-target=".change-password"><i class="bx bx-wrench font-size-16 align-middle me-1"></i>
                        <span key="t-settings">เปลี่ยนรหัสผ่าน</span></a>
                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item d-block text-warning" href="https://liff.line.me/1645278921-kWRPP32q/?accountId=276nqblq" target="blank"><i class="mdi mdi-alert-outline font-size-16 align-middle me-1"></i>
                        <span key="t-package">แจ้งระบบขัดข้อง</span></a>
                    <div class="dropdown-divider"></div>


                    <a class="dropdown-item text-danger" href="javascript:void();"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                            class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span
                            key="t-logout">ออกจากระบบ</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>

        </div>
    </div>
</header>

<!--  Change-Password example -->
<div class="modal fade change-password" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">เปลี่ยนรหัสผ่าน</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" id="change-password">
                    @csrf
                    <input type="hidden" value="{{ Auth::user() ? Auth::user()->id : '' }}" id="data_id" name="id">

                    <div class="mb-3">
                        <label for="newpassword">รหัสผ่านใหม่</label>
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password"
                            autocomplete="new_password" placeholder="กรอกรหัสผ่านใหม่ อย่างน้อย 8 ตัว" minlength="8"> 
                        <div class="text-danger" id="passwordError" data-ajax-feedback="password"></div>
                    </div>

                    <div class="mb-3">
                        <label for="userpassword">ยืนยันรหัสผ่าน</label>
                        <input id="password-confirm" type="password" class="form-control"
                            name="password_confirmation" autocomplete="new_password"
                            placeholder="กรอกรหัสผ่านยืนยันใหม่" minlength="8">
                        <div class="text-danger" id="password_confirmError" data-ajax-feedback="password-confirm">
                        </div>
                    </div>

                    <div class="mt-3 d-grid">
                        <button class="btn btn-primary waves-effect waves-light UpdatePassword"
                            data-id="{{ Auth::user() ? Auth::user()->id : '' }}"
                            type="submit">ยืนยันรหัสผ่าน</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
