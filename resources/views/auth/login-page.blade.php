@extends('layouts.master-without-nav')

@section('title')
เคลียร์ยอด
@endsection

@section('css')
    <meta property="og:title" content="Apartment" />
    <meta property="og:image" content="{{ URL::asset('/assets/images/bank_img/logo.png') }}" />
    <meta property="og:site_name" content="#" />
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

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Verdana, sans-serif;
        }

        .mySlides {
            display: none;
        }

        img {
            vertical-align: middle;
        }

        /* Slideshow container */
        .slideshow-container {
            max-width: 1000px;
            position: relative;
            margin: auto;
        }

        /* Caption text */
        /* .text {
                    color: #f2f2f2;
                    font-size: 15px;
                    padding: 8px 12px;
                    position: absolute;
                    bottom: 8px;
                    width: 100%;
                    text-align: center;
                } */

        /* Number text (1/3 etc) */
        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        /* The dots/bullets/indicators */
        .dot {
            height: 10px;
            width: 10px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .active {
            background-color: #929191;
        }

        /* Fading animation */
        .fade {
            animation-name: fade;
            animation-duration: 8s;
        }

        @keyframes fade {
            from {
                opacity: .9
            }

            to {
                opacity: 1
            }
        }

        /* On smaller screens, decrease text size */
        @media only screen and (max-width: 300px) {
            .text {
                font-size: 11px
            }
        }
        .center-screen {
            position: fixed;
            top: 50%;
            left: 50%;
            right: -30%;
            -webkit-transform: translate(-40%, -40%);
            transform: translate(-50%, -50%);

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
@endsection


@section('content')

    <nav class="navbar navbar-expand-xl nav-white bg-white shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Apartment <span class="badge bg-primary">th</span></a>
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
                        <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            How To
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="https://youtu.be/xk34IMRsBpw" target="blank">ระบบรายงาน</a></li>
                            <li><a class="dropdown-item" href="https://youtu.be/zavfD707oUQ" target="blank">เพิ่มใบเสนอราคา</a></li>
                            <li><a class="dropdown-item" href="https://youtu.be/et4bI4VBSU4" target="blank">เพิ่มรับงานซ่อม</a></li>
                            <li><a class="dropdown-item" href="https://youtu.be/W-VHVh2yklo" target="blank">ระบบแจ้งเตือนไลน์</a></li>
                            <li><a class="dropdown-item" href="https://youtu.be/YxdTVN3FkWo" target="blank">เกี่ยวกับระบบ</a></li>
                            <li><a class="dropdown-item" href="https://youtu.be/MhkWfhGFDvA" target="blank">ภาพรวมระบบ</a></li>
                        </ul>

                    </li>
                </ul>
                {{-- <form class="d-flex"> --}}
                    <a href="{{ route('register') }}" class="btn btn-outline-success" type="button" >สมัครสมาชิก</a>
                {{-- </form> --}}
            </div>
        </div>
    </nav>

    <div class="container" style="margin-top: 6%">
        <div class="row">
            <div class="col-md-6">
                <div class="mySlides fade">
                    <img src="{{ URL::asset('/assets/images/slide-page/01.png') }}" style="width:100%">
                </div>
                <div class="mySlides fade">
                    <img src="{{ URL::asset('/assets/images/slide-page/02.png') }}" style="width:100%">
                </div>
                <div class="mySlides fade">
                    <img src="{{ URL::asset('/assets/images/slide-page/03.png') }}" style="width:100%">
                </div>
                <div class="mySlides fade">
                    <img src="{{ URL::asset('/assets/images/slide-page/04.png') }}" style="width:100%">
                </div>
                <div class="mySlides fade">
                    <img src="{{ URL::asset('/assets/images/slide-page/05.png') }}" style="width:100%">
                </div>
                <br>
                <div style="text-align:center">
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </div>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-4">
                {{-- <div class="container"> --}}
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow-lg mt-3" style="border-radius: 15px">
                                <div class="card-body">
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }} <a href="{{ route('login') }}"> เข้าสู่ระบบ </a>
                                        </div>
                                    @endif
                                    
                                    <div class="container mt-2 mb-2">
                                        <div class="mb-0">
                                            <h3 class="text-dark">ลงชื่อเข้าใช้</h3>
                                        </div>
                                    <form id="form-login" class="form-horizontal mt-3" method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div>
                                            <div class="mb-2 text-start">
                                                {{-- <label for="username" class="form-label text-white">ชื่อผู้ใช้</label> --}}
                                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                                    id="username" placeholder="ชื่อผู้ใช้" name="username">
                                                @error('username')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-0 text-start">
                                                {{-- <label class="form-label text-white">รหัสผ่าน</label> --}}
                                                <div
                                                    class="input-group auth-pass-inputgroup @error('password') is-invalid @enderror">
                                                    <input name="password" type="password"
                                                        class="form-control  @error('password') is-invalid @enderror"
                                                        placeholder="รหัสผ่าน" aria-label="Password"
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
                                                <div class="mt-0 d-grid">
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
                                                    <div class="mt-2 text-center text-muted font-size-12">
                                                        ©
                                                        <script>
                                                            document.write(new Date().getFullYear())
                                                        </script>
                                                        Apartment
                                                    </div>
        
                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- </div> --}}
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) {
                slideIndex = 1
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
            setTimeout(showSlides, 2000); // Change image every 2 seconds
        }
    </script>
@endsection
