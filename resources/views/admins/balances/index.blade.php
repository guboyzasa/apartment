@extends('admin-layouts.master')

@section('title')
    Dashboard
@endsection

@section('css')
    <style>
        #doc-image {
            height: auto;
        }

        @media only screen and (max-width: 800px) {
            #doc-image {
                zoom: .5;
            }
        }

        @media only screen and (min-width: 1000px) {
            #doc-image {
                zoom: .7;
            }
        }

        @media only screen and (min-width: 1500px) {
            #doc-image {
                zoom: 1;
            }
        }
    </style>
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        @endslot
        @slot('title')
            Dashboard
        @endslot
    @endcomponent
<div class="card" style="border-radius: 10px">
    <div class="card-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" data-bs-toggle="tab" href="#floor1" role="tab" aria-selected="true">
                    <span class="d-block d-sm-none">F1</span>
                    <span class="d-none d-sm-block">Floor 1</span>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" href="#floor2" role="tab" aria-selected="false" tabindex="-1">
                    <span class="d-block d-sm-none">F2</span>
                    <span class="d-none d-sm-block">Floor 2</span>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-bs-toggle="tab" href="#floor3" role="tab" aria-selected="false" tabindex="-1">
                    <span class="d-block d-sm-none">F3</span>
                    <span class="d-none d-sm-block">Floor 3</span>
                </a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content p-3 text-muted">
            <div class="tab-pane active show" id="floor1" role="tabpanel">
                <div class="text-center mb-1">
                    <a href="{{ route('admin.store.prints.doc1') }}" target="blank" class="btn btn-success">พิมพ์ใบเสร็จรับเงิน</a>
                </div>
                @include('admins.stores.view-make.print-doc1')
            </div>
            <div class="tab-pane" id="floor2" role="tabpanel">
                <div class="text-center mb-1">
                    <a href="{{ route('admin.store.prints.doc2') }}" target="blank" class="btn btn-warning">พิมพ์ใบเสร็จรับเงิน</a>
                </div>
                @include('admins.stores.view-make.print-doc2')
            </div>
            <div class="tab-pane" id="floor3" role="tabpanel">
                <div class="text-center mb-1">
                    <a href="{{ route('admin.store.prints.doc3') }}" target="blank" class="btn btn-danger">พิมพ์ใบเสร็จรับเงิน</a>
                </div>
                @include('admins.stores.view-make.print-doc3')
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script></script>
@endsection
