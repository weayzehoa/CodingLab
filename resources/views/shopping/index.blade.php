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
                        <i class="fas fa-info text-danger"></i> 此部分主要目的做一個簡易的Shopping購物測試，並非完整購物系統，可能存在一些盲點及錯誤。<br>
                        <i class="fas fa-info text-danger"></i> 產品內容與圖片皆使用隨機產生圖文資料。資料內容並不正確。點擊標題或圖片可以進入產品頁面。<br>
                        <i class="fas fa-info text-danger"></i> 輸入數量並點擊購物車，將檢查是否有登入，若無則轉入登入頁面，若有則檢查是否通過驗證過帳號，通過驗證帳號則將資料放入購物車。<br>
                        <i class="fas fa-info text-primary"></i> 請使用 帳號 user@mail.com 密碼 user (已通過驗證) 或 帳號 guest@mail.com 密碼 guest (未通過驗證) 來做測試.
                    </div>
                </div>
                <div class="card card-primary card-outline">
                    {{-- alert訊息 --}}
                    @include('admin.layouts.alert_message')
                    <div class="card-body">
                       {{-- 這邊開始放置 內容頁面 --}}
                        @if($products)
                        <div class="row">
                            @foreach($products as $product)
                            <div class="col-3">
                                <div class="card">
                                    <div class="card-header">
                                        <a href="{{ route('shopping.show', $product->id) }}">{{ $product->name }}</a>
                                    </div>
                                    <div class="card-body">
                                        <a href="{{ route('shopping.show', $product->id) }}"><img width="100%" src="{{ $product->imagepath }}"></a>
                                    </div>
                                    <div class="card-footer">
                                        <div>特惠價：{!! $product->price->price !!}</div>
                                        <form action="{{ route('cart.store') }}" method="POST">
                                            @csrf
                                            {{-- 帶入產品ID與PriceID 作交叉驗證 避免造假 --}}
                                            <input type="hidden" name="productId" value="{{ $product->id }}">
                                            <input type="hidden" name="priceId" value="{{ $product->price->id }}">
                                            <div class="input-group input-group-sm">
                                                <input class="form-control col-9 {{ $errors->has('qty') ? ' is-invalid' : '' }}" type="number" id="qty{{ $product->id }}" name="qty" value="" placeholder="輸入數量點購物車">
                                                <span class="input-group-append">
                                                  <button type="submit" class="btn btn-info btn-flat"><i class="fas fa-cart-plus fa-lg mr-2"></i>Go!</button>
                                                </span>
                                                @if ($errors->has('qty'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('qty') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                        <div class="row justify-content-center">
                        <div class="text-center">
                            {{-- 判斷有無傳入 keyword 有的話 利用 render 方式 自動建立可以點擊的分頁頁碼 --}}
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
