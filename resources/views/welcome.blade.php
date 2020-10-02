@extends('layouts.master')

@section('title', '首頁')

@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">首頁</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('index') }}">CodingLab</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('index') }}">首頁</a></li>
                       </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container">
                <div class="row">

                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    {{-- Dashboard PAGE PLUGINS --}}
    <script src="{{ asset('plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
    <script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/dashboard2.js') }}"></script>
@endsection
