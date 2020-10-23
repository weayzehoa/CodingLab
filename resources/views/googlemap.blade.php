@extends('layouts.master')

@section('title', 'Google Map')

@section('content')

<div class="content-wrapper">
    <section class="content">
        <div class="container">
            <div class="container bg-white">
                <div class="card card-danger card-outline">
                    <div class="card-body box-profile">
                        <h3 class="profile-username text-center">Google Map</h3>
                        <i class="fas fa-info text-danger"></i> 說明
                    </div>
                </div>
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                    {{-- 這邊開始放置 內容頁面 --}}


                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('css')
{{-- 這邊放置 CSS 用 (在頁面上方) --}}
@endsection

@section('script')
    {{-- 這邊放置 JS套件 程式用 (在頁面上方) --}}
@endsection

@section('CustomScript')
    {{-- 這邊放置 Script 程式用 (在頁面下方) --}}
@endsection
