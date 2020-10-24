@extends('layouts.master')

@section('title', '編輯文章')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container bg-white">
            <div class="card card-danger card-outline">
                <div class="card-body box-profile">
                    <h3 class="profile-username text-center">會員個人資料頁面</h3>
                    <i class="fas fa-info text-danger"></i>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 card card-primary card-outline">
                    <div class="card-body box-profile">
                        @if(Auth::user()->avatar)
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle myavatar" src="{{ Auth::user()->getAvatarUrl() }}" alt="User profile picture">
                        </div>
                        @endif
                        <h3 class="profile-username text-center mb-4">{{ Auth::user()->name }}</h3>
                        <form action="{{ route('users.uploadAvatar') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputFile">更換頭像</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" id="avatar" name="avatar" class="custom-file-input" accept="image/*" required>
                                        <label class="custom-file-label" for="avatar">瀏覽選擇新圖片</label>
                                    </div>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-md btn-outline-success btn-block">儲存頭像</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form action="{{ route('users.updateProfile') }}" method="POST">
                            @csrf
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b class="mr-4"><i class="fas fa-venus-mars mr-1"></i>性別</b>
                                    <div class="icheck-primary d-inline mr-3">
                                        <input type="radio" id="gender1" name="gender" value="1" {{ Auth::user()->gender == 1 ? 'checked' : '' }}>
                                        <label for="gender1">男</label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="gender2" name="gender" value="2" {{ Auth::user()->gender == 2 ? 'checked' : '' }}>
                                        <label for="gender2">女</label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-address-book mr-2"></i>名字</span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Name" name="name" value="{{ Auth::user()->name }}">
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone mr-2"></i></i>電話</span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Phone" name="tel" value="{{ Auth::user()->tel }}">
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-building mr-2"></i>地址</span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Address" name="address" value="{{ Auth::user()->address }}">
                                    </div>
                                </li>
                            </ul>
                            <div class="col-md-8 offset-md-2">
                                <button type="submit" class="btn btn-md btn-outline-primary btn-block">儲存資料</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('css')
{{-- 這邊放置 CSS 用 (在頁面上方) --}}
{{-- iCheck for checkboxes and radio inputs --}}
<link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endsection

@section('script')
{{-- 這邊放置 JS套件 程式用 (在頁面上方) --}}
@endsection

@section('CustomScript')
{{-- 這邊放置 Script 程式用 (在頁面下方) --}}
<script>
    imgclass = '.myavatar'; //img的class名稱
    myavatar = $(imgclass).attr('src');
    $('input[name=avatar]').change(function(x) {
        file = x.currentTarget.files;
        if (file.length >= 1) {
            filename = checkMyImage(file);
            console.log(filename);
            if (filename) {
                readURL(this, imgclass);
                $('label[for=avatar]').html(filename);
            } else {
                $(this).val('');
                $('label[for=avatar]').html('瀏覽選擇新圖片');
                $(".myavatar").attr('src', myavatar); //沒照片時還原
            }
        } else {
            $(this).val('');
            $('label[for=avatar]').html('瀏覽選擇新圖片');
            $(".myavatar").attr('src', myavatar); //沒照片時還原
        }
    });

    function readURL(input, imgclass) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(imgclass).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function checkFileName(filename) {
        var chk = 0;
        var specialSymbols = new Array("`", "~", "!", "@", "#", "$", "%", "^", "&", "*", "+", "=", "(", ")", "[", "]", "{", "}", "<", ">", "/", "?", ":", ";", "'", "\"", "\\", "|");
        for (j = 0; j < specialSymbols.length; j++) {
            if (filename.indexOf(specialSymbols[j]) >= 0) {
                chk++;
            }
        }
        if (chk >= 1) {
            alert("檔案名稱中不可含有兩個\"點\"符號或下列特殊符號。\n(  ` ~ ! @ # $ % ^ & * + = ( ) [ ] { } < > / ? : ; ' \" \\ |  )");
            return false;
        } else {
            return true;
        }
    }

    function checkFileSize(size) {
        if (size > 2048 * 1024) {
            alert('檔案大小超過2MB');
            return false;
        } else {
            return true;
        }
    }

    function checkFileExt(ext) {
        if ($.inArray(ext, ['.png', '.jpg', '.jpeg', '.gif', '.svg']) == -1) {
            alert('檔案格式不被允許，限JPG、PNG、GIF或SVG格式');
            return false;
        } else {
            return true;
        }
    }

    function checkMyImage(input) {
        if (input) {
            var filename = input[0].name;
            var size = input[0].size;
            var ext = filename.substring(filename.lastIndexOf('.')).toLowerCase();
            if (checkFileName(filename)) {
                if (checkFileExt(ext)) {
                    if (checkFileSize(size)) {
                        return filename;
                    }
                }
            }
        }
    }
</script>
@endsection
