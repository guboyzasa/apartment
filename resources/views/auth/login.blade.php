@extends('layouts.master-without-nav')

@section('title')
    LOGIN
@endsection

@section('css')
    <meta property="og:title" content="เข้าสู่ระบบ" />
    <meta property="og:image" content="{{ URL::asset('/assets/images/bank_img/logo.png') }}" />
    <meta property="og:site_name" content="#" />
@endsection

<style>
    body {
        min-height: 100%;
        position: relative;
        padding-bottom: 3rem;
        margin: 0;
        padding: 0;
        text-align: center;
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
            opacity: 1
        }

        to {
            opacity: 1
        }
    }

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
        /* border-color: rgba(45, 143, 241, 0.8); */
        /* box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(31, 96, 236, 0.6); */
        padding: 0 5px;
        z-index: 10;
    }

    @media (max-width:576px) {
        .p-xs-1 {
            padding: 1rem !important;
        }
    }
</style>

@section('content')

    <div class="row">
        <div class="container" style="margin-top: 10%">
            <div class="container">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4" >
                        <div class="row">
                            <div class="">
                                <div class="card shadow-lg mt-5" style="border-radius: 10px">
                                    <div class="card-body">
                                        <div class="container mt-2 mb-2">
                                            <div class="mb-0 text-center">
                                                <h3 class="text-primary position-relative" href="/login">
                                                    <span>Apartment</span>
                                                    <span class="badge bg-primary" style="position: relative;top: -1px;">
                                                        th</span>
                                                </h3>
                                            </div>
                                            <form id="form-login" class="form-horizontal mt-3" method="POST"
                                                action="{{ route('login') }}">
                                                @csrf
                                                <div>
                                                    <div class="mb-3 text-start">
                                                        <div class="group">
                                                            <input type="text"
                                                                class="form-control @error('username') is-invalid @enderror"
                                                                id="username" name="username" required>
                                                            <label for="username">username</label>
                                                            @error('username')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="mb-0 text-start">
                                                        <div
                                                            class="group input-group auth-pass-inputgroup @error('password') is-invalid @enderror">
                                                            <input name="password" type="password"
                                                                class="form-control  @error('password') is-invalid @enderror"
                                                                aria-label="Password" aria-describedby="password-addon"
                                                                required>
                                                            <button class="btn btn-light " type="button"
                                                                id="password-addon">
                                                                <i class="mdi mdi-eye-outline"></i>
                                                            </button>
                                                            <label for="">password</label>
                                                        </div>
                                                        @foreach ($errors->all() as $error)
                                                            <span class="text-danger"
                                                                role="alert">{{ $error }}</span>
                                                        @endforeach
                                                        @if (count($errors->all()) == 0)
                                                            <br>
                                                        @endif
                                                    </div>
                                                    <div class="mb-3">
                                                        <div class="mt-0 d-grid">
                                                            <button
                                                                class="btn btn-primary waves-effect waves-light animated-button1"
                                                                type="submit">
                                                                <span></span>
                                                                <span></span>
                                                                <span></span>
                                                                <span></span>
                                                                login</button>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="mt-3 text-center">
                                                        <div class="mt-2 text-center text-muted font-size-11">
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
                    </div>
                    <div class="col-md-4"></div>
                </div>
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

        $("#form-login").on('submit', function() {
            openLoading()
        })
    </script>
@endsection
