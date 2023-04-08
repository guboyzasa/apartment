@extends('layouts.master-without-nav')

@section('title')
    Floor 3
@endsection

@section('css')
    <style>
        @media print {
            @page {
                margin-left: 0.5in;
                margin-right: 0.5in;
                margin-top: 2px 2px 0 0;
                margin-bottom: 0;
            }
        }
    </style>
@endsection

@section('content')
    @include('admins.stores.view-make.print-doc3')
@endsection
@section('script')
    <script>
        window.setTimeout('window.print()', 1500);
    </script>
@endsection
