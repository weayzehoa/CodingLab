@extends('layouts.master')

@section('title', '編輯文章')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container bg-white">
            <div class="card card-danger card-outline">
                <div class="card-body box-profile">
                    <h3 class="profile-username text-center">會員更換頭像頁面</h3>
                    <i class="fas fa-info text-danger"></i>
                </div>
            </div>
            <div class="col-md-6 offset-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <form action="{{ route('users.uploadAvatar') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-12 col-form-label text-md-center">目前頭像</label>
                                <div class="col-md-8 offset-md-2 text-center">
                                    <img src="{{ Auth::user()->getAvatarUrl() }}" class="rounded-circle" style="max-height: 150px; max-width: 150px;">
                                </div>
                            </div>
                            <div class="form-group row text-center">
                                <label for="avatar" class="col-md-12 col-form-label">更換頭像</label>
                                <div class="col-md-6 offset-md-3">
                                    <input type="file" id="avatar" name="avatar" class="form-control-file" accept="image/*" required>
                                </div>
                                <p class="form-text text-muted col-md-12">圖片檔(jpeg, png, bmp, gif, svg)</p>
                            </div>
                            <div class="form-group row text-center mt-3 mb-0">
                                <div class="col-md-8 offset-md-2">
                                    <button type="submit" class="btn btn-md btn-outline-success btn-block">儲存</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer bg-primary">
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
