@extends('layouts.master')

@section('title', '台北公園資訊')

@section('content')

<div class="content-wrapper">
    <section class="content">
        <div class="container bg-white">
            <div class="card card-danger card-outline">
                <div class="card-body box-profile">
                    <h3 class="profile-username text-center">台北公園資訊資料</h3>
                    <i class="fas fa-info text-danger"></i> 這邊嘗試先從Redis中找所有公園的資料，如果有就從所有公園資料中去找到指定id的資料，並將資料拋給前端。<br>
                    <i class="fas fa-info text-danger"></i> 如果判斷沒有所有公園資料，就先將全部公園資料放入Redis中，然後再找出指定id的資料。<br>
                    <i class="fas fa-info text-danger"></i> 這樣一來，下一個讀取公園指定id的資料就不需要在從資料庫中讀取，直接透過Redis讀取，減緩頻繁讀取資料庫的問題。<br>
                </div>
            </div>
            <div class="card card-blue card-outline">
                <div class="card-header">
                    <h3 class="card-title">{{ $park->name }}公園資訊資料顯示</h3><br>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped text-xs">
                        <thead>
                            <tr>
                                <th width="30%">名稱</th>
                                <th width="70%">資料</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>公園名稱</td>
                                <td>{{ $park->name }}</td>
                            </tr>
                            <tr>
                                <td>英文名稱</td>
                                <td>{{ $park->engname }}</td>
                            </tr>
                            <tr>
                                <td>概述</td>
                                <td>{{ $park->overview }}</td>
                            </tr>
                            <tr>
                                <td>行政區</td>
                                <td>{{ $park->dist }}</td>
                            </tr>
                            <tr>
                                <td>經緯度</td>
                                <td>{{ $park->lat.' , '.$park->lon }}</td>
                            </tr>
                            <tr>
                                <td>位置</td>
                                <td>{{ $park->location }}</td>
                            </tr>
                            <tr>
                                <td>類別</td>
                                <td>{{ $park->type }}</td>
                            </tr>
                            <tr>
                                <td>管理單位</td>
                                <td>{{ $park->unit }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('css')
@endsection

@section('script')
@endsection

@section('CustomScript')
@endsection
