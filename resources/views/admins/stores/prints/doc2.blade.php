@extends('admin-layouts.master-layouts2')

@section('title')
    Floor 2
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
    @include('admins.stores.view-make.print-doc2')
@endsection
@section('script')
    <script>
        window.setTimeout('window.print()', 1500);
    </script>
@endsection
