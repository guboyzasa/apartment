@extends('layouts.master-without-nav')

@section('title')
    เข้าสู่ระบบ
@endsection

@section('css')
    <meta property="og:title" content="เข้าสู่ระบบ" />
    <meta property="og:image" content="{{ URL::asset('/assets/images/bank_img/logo.png') }}" />
    <meta property="og:site_name" content="#" />
@endsection

<style>
    .center-screen {
        position: fixed;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);

    }

    .card {
        padding: 0.5rem 3rem 0.5rem 3rem;
        border-radius: 1.5rem !important;
    }

    .shadow-card {
        box-shadow: 6px 6px 12px #c5c5c5,
            -6px -6px 12px #ffffff !important;
    }

    @media (max-width:768px) {
        .shadow-card {
            box-shadow: 0 0 0 #ffffff,
                0 0 0 #ffffff !important;
        }

        body {
            background-color: #ffffff !important;
        }

        .card {
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
        }
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
</style>

@section('content')
    <div class='center-screen'>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-card">
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }} <a href="{{ route('login') }}"> เข้าสู่ระบบ </a>
                                </div>
                            @endif
                            <div class="mb-2">
                                <span class="avatar-title bg-white">
                                    <img src="{{ URL::asset('/assets/images/bank_img/logo-no-bg.png') }}" width="300"
                                        style="padding: 2rem;">
                                </span>
                            </div>
                            <form id="form-login" class="form-horizontal" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div>
                                    <div class="mb-3">
                                        <label for="username" class="form-label">ชื่อผู้ใช้</label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                                            id="username" placeholder="กรอกชื่อผู้ใช้" name="username">
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">รหัสผ่าน</label>
                                        <div
                                            class="input-group auth-pass-inputgroup @error('password') is-invalid @enderror">
                                            <input name="password" type="password"
                                                class="form-control  @error('password') is-invalid @enderror"
                                                placeholder="กรอกรหัสผ่าน" aria-label="Password"
                                                aria-describedby="password-addon">
                                            <button class="btn btn-light " type="button" id="password-addon"><i
                                                    class="mdi mdi-eye-outline"></i></button>
                                        </div>

                                        @foreach ($errors->all() as $error)
                                            <span class="text-danger" role="alert">{{ $error }}</span>
                                        @endforeach
                                        @if (count($errors->all()) == 0)
                                            <br>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <div class="mt-2 d-grid">
                                            <button class="btn btn-primary waves-effect waves-light animated-button1"
                                                type="submit">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                เข้าสู่ระบบ</button>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="mt-3 text-center">
                                        <a href="{{ route('forgot-password') }}" class="text-muted">
                                            <i class="mdi mdi-lock me-1"></i> ลืมรหัสผ่าน ?
                                        </a>
                                    </div>
                                    <div class="mt-3 text-center">
                                        <div>
                                            <div>
                                                คุณยังไม่มีบัญชีสำหรับเข้าสู่ระบบ ?
                                                <a href="{{ route('register') }}"
                                                    class="fw-medium text-primary">สมัครสมาชิก</a>
                                            </div>
                                            <p class="pb-0">เรามี <a href="{{ route('show-package') }}"
                                                    class="fw-medium text-primary">Package</a> อะไรบ้าง ?</p>
                                            <div class="mt-2 text-center text-muted font-size-12">
                                                ©
                                                <script>
                                                    document.write(new Date().getFullYear())
                                                </script>
                                                Apartment
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="form-container">
    <div class="account-pages my-5 pt-sm-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="wrapper wrapper-content">
                        @yield('content')
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden shadow-lg" style="border-radius: 10px">
                        <div class="card-body pt-0">
                            <div class="auth-logo">
                                <span class="avatar-title bg-white">
                                    <img src="{{ URL::asset('/assets/images/logo-black.png') }}" alt=""
                                        class="" height="100" style="margin-top: 28px">
                                </span>
                            </div>
                            <div class="p-2">
                                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="username" class="form-label">ชื่อผู้ใช้</label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                                            id="username" placeholder="กรอกชื่อผู้ใช้" name="username">
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">รหัสผ่าน</label>
                                        <div
                                            class="input-group auth-pass-inputgroup @error('password') is-invalid @enderror">
                                            <input name="password" type="password"
                                                class="form-control  @error('password') is-invalid @enderror"
                                                placeholder="กรอกรหัสผ่าน" aria-label="Password"
                                                aria-describedby="password-addon">
                                            <button class="btn btn-light " type="button" id="password-addon"><i
                                                    class="mdi mdi-eye-outline"></i></button>
                                        </div>

                                        @foreach ($errors->all() as $error)
                                            <span class="text-danger" role="alert">{{ $error }}</span>
                                        @endforeach
                                        @if (count($errors->all()) == 0)
                                            <br>
                                        @endif
                                    </div>
                        
                                    <div class="mt-2 d-grid">
                                        <button class="btn btn-primary waves-effect waves-light"
                                            type="submit">เข้าสู่ระบบ</button>
                                    </div>

                                    <div class="mt-4 text-center">
                                    </div>
                                    <hr>
                                    <div class="mt-3 text-center">
                                        <a href="{{ route('forgot-password') }}" class="text-muted"><i
                                                class="mdi mdi-lock me-1"></i> ลืมรหัสผ่าน ?</a>

                                    </div>
                                    <div class="mt-3 text-center">

                                        <div>
                                            <div>คุณยังไม่มีบัญชีสำหรับเข้าสู่ระบบ ? <a href="{{ route('register') }}"
                                                    class="fw-medium text-primary">
                                                    สมัครสมาชิก</a> </div>
                                            <p>เรามี <a href="{{ route('show-package') }}" class="fw-medium text-primary">
                                                    Package </a>
                                                อะไรบ้าง ?</p>
                                            <div class="mt-2 text-center text-muted font-size-12">
                                                ©
                                                <script>
                                                    document.write(new Date().getFullYear())
                                                </script> Apartment
                                            </div>
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection

@section('script')
    <script>
        $("#form-login").on('submit', function() {
            openLoading()
        })
    </script>
@endsection
