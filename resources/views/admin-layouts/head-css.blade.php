@yield('css')

<!-- Bootstrap Css -->
<link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ URL::asset('/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
<!-- DataTables -->
<link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Sweet Alert-->
<link href="{{ URL::asset('/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- select2 css -->
<link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- dropzone css -->
<link href="{{ URL::asset('/assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet"
    type="text/css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<link type="text/css" rel="stylesheet" href="{{ URL::asset('assets/css/image-uploader.min.css') }}">
<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<style>
        .loader-load {
            position: fixed;
            z-index: 5000;
            top: 45%;
            left: 50%;
            border: 5px solid #f3f3f3;
            border-radius: 50%;
            border-top: 5px solid #6c6d6e;
            width: 50px;
            height: 50px;
            -webkit-animation: spin 0.5s linear infinite;
            /* Safari */
            animation: spin 0.5s linear infinite;
        }

        .loader-bg {
            position: fixed;
            min-width: 100%;
            min-height: 100%;
            width: 100%;
            background: rgba(108, 108, 108, 0.8);
            z-index: 4000;
            -webkit-transition: opacity 3s ease-in-out;
            -moz-transition: opacity 3s ease-in-out;
            -ms-transition: opacity 3s ease-in-out;
            -o-transition: opacity 3s ease-in-out;
            opacity: 1;
        }

        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
</style>

