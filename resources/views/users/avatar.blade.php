@extends('layouts.master')

@section('title', '更換頭像')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">更換頭像</div>

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
            </div>
        </div>
    </div>
</div>
@stop
