@extends('layouts.master')

@section('title', 'Shopping購物')

@section('content')

<div class="content-wrapper">
    <section class="content">
        <div class="container">
            <div class="container bg-white">
                <div class="card card-danger card-outline">
                    <div class="card-body box-profile">
                        <h3 class="profile-username text-center">Shopping購物測試</h3>
                        <i class="fas fa-info text-danger"></i> 此部分主要目的做一個簡易的Shopping購物測試，尚未登入前，可將物品放入購物車，登入後可以做結帳，透過串接第三方金流並產生出訂單。<br>
                        <i class="fas fa-info text-danger"></i> 產品內容與圖片皆使用隨機產生圖文資料。資料內容並不正確，只有金額是正確。
                    </div>
                </div>
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        {{-- 這邊開始放置 內容頁面 --}}
                        @if($products)
                        <div class="row">
                            @foreach($products as $product)
                            <div class="col-3">
                                <div class="card">
                                    <div class="card-header">
                                        {{ $product->name }}
                                    </div>
                                    <div class="card-body">
                                        <img width="100%" src="{{ $product->imagepath }}">
                                    </div>
                                    <div class="card-footer">
                                        原價：{{ $product->defaultprice }} 特賣：{{ $product->saleprice }}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                        <div class="row justify-content-center">
                        <div class="text-center">
                            <!-- 判斷有無傳入 keyword 有的話 利用 render 方式 自動建立可以點擊的分頁頁碼 -->
                            @isset($keyword)
                            {{ $products->appends(['keyword' => $keyword])->render() }}
                            @else
                            {{ $products->render() }}
                            @endisset
                        </div>
                        @endif
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
@endsection

@section('script')
{{-- 這邊放置 JS套件 程式用 (在頁面上方) --}}
@endsection

@section('CustomScript')
{{-- 這邊放置 Script 程式用 (在頁面下方) --}}
@endsection
