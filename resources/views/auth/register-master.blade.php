@extends('layouts.master-without-nav')

@section('title')
    {{-- @lang('translation.Register') --}}
    สมัครสมาชิก
@endsection
@section('css')
    <meta property="og:title" content="สมัครสมาชิก" />
    <meta property="og:image" content="{{ URL::asset('/assets/images/bank_img/logo.png') }}" />
    <meta property="og:site_name" content="#" />
    <link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css">
    <style>
        textarea:focus,
        input[type="text"]:focus,
        input[type="password"]:focus,
        input[type="datetime"]:focus,
        input[type="datetime-local"]:focus,
        input[type="date"]:focus,
        input[type="month"]:focus,
        input[type="time"]:focus,
        input[type="week"]:focus,
        input[type="number"]:focus,
        input[type="email"]:focus,
        input[type="url"]:focus,
        input[type="search"]:focus,
        input[type="tel"]:focus,
        input[type="color"]:focus,
        .uneditable-input:focus {
            border-color: rgba(45, 143, 241, 0.8);
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(31, 96, 236, 0.6);
            outline: 0 none;
        }

        .animated-button1 {
            /* background: linear-gradient(-30deg, #3d0b0b 50%, #2b0808 50%); */
            padding: 20px 40px;
            margin: 12px;
            display: inline-block;
            -webkit-transform: translate(0%, 0%);
            transform: translate(0%, 0%);
            overflow: hidden;
            color: #f7d4d4;
            font-size: 20px;
            letter-spacing: 2.5px;
            text-align: center;
            text-transform: uppercase;
            text-decoration: none;
            /* -webkit-box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
                        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5); */
        }

        .animated-button1::before {
            content: '';
            position: absolute;
            top: 0px;
            left: 0px;
            width: 100%;
            height: 100%;
            /* background-color: #ad8585; */
            opacity: 0;
            -webkit-transition: .2s opacity ease-in-out;
            transition: .2s opacity ease-in-out;
        }

        .animated-button1:hover::before {
            opacity: 0.2;
        }

        .animated-button1 span {
            position: absolute;
        }

        .animated-button1 span:nth-child(1) {
            top: 0px;
            left: 0px;
            width: 100%;
            height: 2px;
            background: -webkit-gradient(linear, right top, left top, from(rgba(43, 8, 8, 0)), to(#6fec41));
            background: linear-gradient(to left, rgba(43, 8, 8, 0), #6fec41);
            -webkit-animation: 2s animateTop linear infinite;
            animation: 2s animateTop linear infinite;
        }

        @keyframes animateTop {
            0% {
                -webkit-transform: translateX(100%);
                transform: translateX(100%);
            }

            100% {
                -webkit-transform: translateX(-100%);
                transform: translateX(-100%);
            }
        }

        .animated-button1 span:nth-child(2) {
            top: 0px;
            right: 0px;
            height: 100%;
            width: 2px;
            background: -webkit-gradient(linear, right top, left top, from(rgba(43, 8, 8, 0)), to(#ecbe41));
            background: linear-gradient(to left, rgba(43, 8, 8, 0), #ecbe41);
            -webkit-animation: 2s animateRight linear -1s infinite;
            animation: 2s animateRight linear -1s infinite;
        }

        @keyframes animateRight {
            0% {
                -webkit-transform: translateY(100%);
                transform: translateY(100%);
            }

            100% {
                -webkit-transform: translateY(-100%);
                transform: translateY(-100%);
            }
        }

        .animated-button1 span:nth-child(3) {
            bottom: 0px;
            left: 0px;
            width: 100%;
            height: 2px;
            background: -webkit-gradient(linear, right top, left top, from(rgba(43, 8, 8, 0)), to(#ec416f));
            background: linear-gradient(to left, rgba(43, 8, 8, 0), #ec416f);
            -webkit-animation: 2s animateBottom linear infinite;
            animation: 2s animateBottom linear infinite;
        }

        @keyframes animateBottom {
            0% {
                -webkit-transform: translateX(-100%);
                transform: translateX(-100%);
            }

            100% {
                -webkit-transform: translateX(100%);
                transform: translateX(100%);
            }
        }

        .animated-button1 span:nth-child(4) {
            top: 0px;
            left: 0px;
            height: 100%;
            width: 2px;
            background: -webkit-gradient(linear, right top, left top, from(rgba(43, 8, 8, 0)), to(#ecbe41));
            background: linear-gradient(to left, rgba(43, 8, 8, 0), #ecbe41);
            -webkit-animation: 2s animateLeft linear -1s infinite;
            animation: 2s animateLeft linear -1s infinite;
        }

        @keyframes animateLeft {
            0% {
                -webkit-transform: translateY(-100%);
                transform: translateY(-100%);
            }

            100% {
                -webkit-transform: translateY(100%);
                transform: translateY(100%);
            }
        }

        body {
            min-height: 100%;
            position: relative;
            padding-bottom: 3rem;
            margin: 0;
            padding: 0;
            /* text-align: center; */
            width: 100%;
            /* background: linear-gradient(170deg, rgba(49, 57, 73, 0.8) 20%, rgba(49, 57, 73, 0.5) 20%, rgba(49, 57, 73, 0.5) 35%, rgba(41, 48, 61, 0.6) 35%, rgba(41, 48, 61, 0.8) 45%, rgba(31, 36, 46, 0.5) 45%, rgba(31, 36, 46, 0.8) 75%, rgba(49, 57, 73, 0.5) 75%), linear-gradient(45deg, rgba(20, 24, 31, 0.8) 0%, rgba(41, 48, 61, 0.8) 50%, rgba(82, 95, 122, 0.8) 50%, rgba(133, 146, 173, 0.8) 100%) #313949; */
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        .group {
            position: relative;
        }

        .group input:focus {
            outline: none !important;
        }

        .group label {
            color: #999;
            font-size: 13px;
            font-weight: normal;
            position: absolute;
            pointer-events: none;
            left: 13px;
            top: 8px;
            transition: 0.2s ease all;
            -moz-transition: 0.2s ease all;
            -webkit-transition: 0.2s ease all;
        }

        .group input:focus~label,
        input:valid~label {
            top: -10px;
            left: 4px;
            font-size: 10px;
            background-color: #fff !important;
            padding: 0 3px;
            z-index: 10;
        }

        @media (max-width:576px) {
            .p-xs-1 {
                padding: 1rem !important;
            }
        }

        @media (max-width:1000px) {
            .part-logo {
                padding-bottom: 0 !important;
            }
        }

        .plan-box .plan-btn:before {
            content: "";
            position: absolute;
            width: 100%;
            height: 2px;
            background: #f6f6f6;
            left: 0;
            right: 0;
            top: 12px;
        }

        .part-logo {
            display: flex;
            background: var(--bs-blue);
            flex-direction: column;
            justify-content: center !important;
            /* padding-bottom: 2rem; */
        }
        .row {
            -ms-flex-negative: 0;
            flex-shrink: 0;
            /* width: 100%; */
            /* max-width: 100%; */
            padding-right: calc(var(--bs-gutter-x)/2);
            padding-left: calc(var(--bs-gutter-x)/2);
            margin-top: var(--bs-gutter-y);
        }

    </style>
@endsection
@section('body')

    <body>
    @endsection

    @section('content')
        <nav class="navbar navbar-expand-xl nav-white bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">Apartment <span class="badge bg-primary">th</span></a>
                <button class="navbar-toggler text-primary" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon text-center mt-0"><i class='bx bx-menu bx-tada'
                            style="font-size: 25px"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('show-package') }}">Package</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-dark" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                How To
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"
                                        target="blank">ระบบรายงาน</a></li>
                                <li><a class="dropdown-item" href="#"
                                        target="blank">เพิ่มใบเสนอราคา</a></li>
                                <li><a class="dropdown-item" href="#"
                                        target="blank">เพิ่มรับงานซ่อม</a></li>
                                <li><a class="dropdown-item" href="#"
                                        target="blank">ระบบแจ้งเตือนไลน์</a></li>
                                <li><a class="dropdown-item" href="#"
                                        target="blank">เกี่ยวกับระบบ</a></li>
                                <li><a class="dropdown-item" href="#"
                                        target="blank">ภาพรวมระบบ</a></li>
                                <li><a class="dropdown-item" href="#"
                                        target="blank">เกี่ยวกับเรา</a></li>
                            </ul>

                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-dark" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Support
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#"
                                        target="blank">กลุ่ม FaceBook</a></li>
                                <li><a class="dropdown-item" href="#" target="blank">กลุ่ม
                                        Line</a></li>
                                <li><a class="dropdown-item"
                                        href="#"
                                        target="blank">แจ้งระบบขัดข้อง</a></li>
                                <li><a class="dropdown-item" href="#"
                                        target="blank">ติดตามข่าวสาร</a></li>
                            </ul>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="#"
                                target="blank">About</a>
                        </li>
                    </ul>
                    <a href="/" class="btn btn-outline-primary btn-sm" type="button">เข้าสู่ระบบ</a>
                </div>
            </div>
        </nav>

        <div class="account-pages my-4 pt-sm-4">
            <div class="container">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-6 col-xl-6">
                            <div class="wrapper wrapper-content">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }} <a href="/"> เข้าสู่ระบบ </a>
                                    </div>
                                @endif
                                {{-- @dd($errors->all()) --}}
                                {{-- @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="mdi mdi-alert-outline me-2"></i>
                                        {{ $error }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endforeach --}}
                                @yield('content')
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-8 col-xl-8">
                            <div class="card overflow-hidden shadow-lg" style="border-radius: 0.75rem">
                                <div class="row">
                                    <div class="col-lg-6 part-logo">
                                        <div class="text-center pt-3 pb-2">
                                            <h3 class="position-relative" href="/login">
                                                <span class="text-white">  Apartment</span>
                                                <span class="badge text-primary bg-white"
                                                    style="position: relative;top: 1px;">
                                                    th</span>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card-body">
                                            <form id="form-register" method="POST"
                                                class="form-horizontal"action="{{ route('register-store') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-3 mt-3">
                                                    <h3 class="">
                                                        <span>Sign Up</span>
                                                    </h3>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="group">
                                                        <input type="text"
                                                            class="form-control @error('username') is-invalid @enderror"
                                                            value="{{ old('username') }}" id="username" name="username"
                                                            autofocus required>
                                                        <label for="username">ชื่อผู้ใช้สำหรับเข้าสู่ระบบ</label>
                                                        @error('username')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="group">
                                                        <input type="password"
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            id="userpassword" name="password" autofocus required>
                                                        <label for="">รหัสผ่าน</label>
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="group">
                                                        <input type="password"
                                                            class="form-control @error('confirmpassword') is-invalid @enderror"
                                                            id="confirmpassword" name="password_confirmation" autofocus
                                                            required>
                                                        <label for="">ยืนยันรหัสผ่าน</label>
                                                        @error('password_confirmation')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="group">
                                                        <input type="text"
                                                            class="form-control @error('company_phone') is-invalid @enderror"
                                                            id="companyphone" name="company_phone"
                                                            value="{{ old('company_phone') }}" maxlength="10"
                                                            minlength="9" autofocus required>
                                                        <label for="">เบอร์โทร</label>
                                                        @error('company_phone')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="group">
                                                        <input type="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            id="useremail" value="{{ old('email') }}" name="email"
                                                            autofocus required>
                                                        <label for="">E-mail</label>
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="d-grid gap-2">
                                                        <button
                                                            class="btn btn-primary waves-effect w-lg waves-light animated-button1 m-0"
                                                            type="submit">
                                                            <span></span>
                                                            <span></span>
                                                            <span></span>
                                                            <span></span>
                                                            ลงทะเบียน
                                                        </button>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="mb-3 text-center">
                                                    <p>
                                                        คุณมีบัญชีอยู่แล้ว ?
                                                        <a href="/" class="fw-medium text-primary">เข้าสู่ระบบ</a>
                                                    </p>
                                                    <p class="text-muted font-size-12">©
                                                        <script>
                                                            document.write(new Date().getFullYear())
                                                        </script> Apartment
                                                        <i class="mdi mdi-heart text-danger"></i>
                                                    </p>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endsection
    @section('script')
        <script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

        <script>
            $("#form-register").on('submit', function() {
                openLoading()
            })

            $(function() {
                $("#username").keypress(function(event) {
                    var ew = event.which;
                    if (ew == 32)
                        return true;
                    if (48 <= ew && ew <= 57)
                        return true;
                    if (65 <= ew && ew <= 90)
                        return true;
                    if (97 <= ew && ew <= 122)
                        return true;
                    return false;
                });
            });


            $(function() {
                $("#companyphone").keyup(function(event) {
                    $(this).val($(this).val().replace(/[^0-9]/g, ''));
                });
            });


            $(function() {
                $("#confirmpassword").keyup(function(event) {
                    let pass = $('#userpassword').val()
                    let conf = $('#confirmpassword').val()

                    if (pass != conf) {
                        $("#confirmpassword").css("border", "1px solid red")
                    } else {
                        $("#confirmpassword").css('border', '1px solid #ced4da')
                    }
                });
            });

            $(function() {
                $("#userpassword").keyup(function(event) {
                    let pass = $('#userpassword').val()
                    let conf = $('#confirmpassword').val()

                    if (pass != conf) {
                        $("#confirmpassword").css("border", "1px solid red")
                    } else {
                        $("#confirmpassword").css('border', '1px solid #ced4da')
                    }
                });
            });
        </script>
    @endsection
