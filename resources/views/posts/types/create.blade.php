@extends('layouts.master')

@section('title', '建立新分類')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    建立新分類
                </div>
                <div class="card-body">
                    <div class="container-fluid p-0">
                        <form action="{{ route('types.store') }}" method="POST" class="mt-2">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label-sm text-md-right">類別名稱</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-sm" name="name" id="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10 offset-sm-2">
                                    <button type="submit" class="btn btn-md btn-primary">儲存</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop