@extends('layouts.master-without-nav')

@section('title')
    @lang('translation.Confirm_Mail')
@endsection

@section('css')
    <style>
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
    </style>
@endsection
@section('body')

    <body>
    @endsection

    @section('content')
        <nav class="navbar navbar-expand-xl nav-white bg-white shadow-sm" style="background-color: #313949">
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
                    {{-- <form class="d-flex"> --}}
                    <a href="/" class="btn btn-primary btn-sm" type="button"
                        style="margin-right: 2px">เข้าสู่ระบบ</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary btn-sm" type="button">สมัครสมาชิก</a>
                    {{-- </form> --}}
                </div>
            </div>
        </nav>
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden shadow-lg" style="border-radius: 10px">
                            {{-- <div class="bg-success bg-soft">
                                <div class="row">
                                    <div class="col-7">
                                        <div class="text-primary p-4">
                                            <h5 class="text-primary"> Reset Password</h5>
                                            <p>Re-Password with Apartment.</p>
                                        </div>
                                    </div>
                                    <div class="col-5 align-self-end">
                                        <img src="{{ URL::asset('/assets/images/profile-img.png') }}" alt=""
                                            class="img-fluid">
                                    </div>
                                </div>
                            </div> --}}
                            <div class="auth-logo">
                                {{-- <a href="index" class="auth-logo-light">
                                        <div class="avatar-md profile-user-wid mb-4">
                                            <span class="avatar-title rounded-circle bg-light">
                                                <img src="{{ URL::asset('/assets/images/logo-light.svg') }}" alt=""
                                                    class="rounded-circle" height="34">
                                            </span>
                                        </div>
                                    </a> --}}
                                {{-- <a href="index" class="auth-logo-dark"> --}}
                                {{-- <div class="avatar-md profile-user-wid mb-4"> --}}
                                <span class="avatar-title bg-white">
                                    <img src="{{ URL::asset('/assets/images/bank_img/logo-no-bg.png') }}" alt=""
                                        class="" height="100" style="margin-top: 28px">
                                </span>
                                {{-- </div> --}}
                                {{-- </a> --}}
                            </div>

                            <div class="p-2">
                                @if (session('status'))
                                    <div class="alert alert-success text-center mb-4" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <div class="container">
                                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="useremail" class="form-label">อีเมล</label>
                                            <input type="email"
                                                class="form-control @error('email') is-invalid @enderror" id="useremail"
                                                name="email" placeholder="Email Address" value="{{ old('email') }}"
                                                id="email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="d-grid">
                                            <button class="btn btn-primary w-md waves-effect waves-light mt-2 mb-2"
                                                type="submit">Reset</button>
                                        </div>
                                        <hr>
                                        <div class="mt-3 text-center">
                                            <p>ฉันจำได้แล้ว ? <a href="/" class="fw-medium text-primary">
                                                    เข้าสู่ระบบ </a>
                                            </p>
                                            <p class="text-muted font-size-12">©
                                                <script>
                                                    document.write(new Date().getFullYear())
                                                </script> Apartment <i
                                                    class="mdi mdi-heart text-danger"></i>
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
    @endsection
