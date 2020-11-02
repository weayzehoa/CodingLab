@extends('layouts.master')

@section('title', $product->title)

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container bg-white">
            <div class="card card-danger card-outline">
                <div class="card-body box-profile">
                    <h3 class="profile-username text-center">產品頁面</h3>
                    <i class="fas fa-info text-danger"></i> 產品內容與圖片皆使用隨機產生圖文資料。資料內容並不正確。(僅供測試)<br>
                    <i class="fas fa-info text-danger"></i> 輸入數量並點擊購物車，將檢查是否有登入，若無則轉入登入頁面，若有則檢查是否通過驗證過帳號，通過驗證帳號則將資料放入購物車。<br>
                    <i class="fas fa-info text-primary"></i> 請使用 帳號 user@mail.com 密碼 user (已通過驗證) 或 帳號 guest@mail.com 密碼 guest (未通過驗證) 來做測試.
                </div>
            </div>
            <div class="card card-primary card-outline">
                <div class="card-body">
                    {{-- alert訊息 --}}
                    @include('admin.layouts.alert_message')
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <h3 class="d-inline-block d-sm-none">{{ $product->name }}</h3>
                            <div class="col-12">
                                <img src="{{ asset($product->imagepath) }}" class="product-image" alt="Product Image">
                            </div>
                            <div class="col-12 product-image-thumbs">
                                @foreach($product->productImage as $productImage)
                                <div class="product-image-thumb"><img src="{{ $productImage->filepath }}" alt="Product Image"></div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            類別：{{ $product->productType->title }}
                            <h3 class="my-3">{{ $product->title }}</h3>
                            <p>{{ $product->description }}</p>
                            <hr>
                            <div class="bg-gray py-2 px-3 mt-4">
                                <h2 class="mb-0">
                                    $NT: {{ $product->price->price }} 元
                                </h2>
                                <h4 class="mt-0">
                                    <small>原價: {{ $product->defaultprice }} 元</small>
                                </h4>
                            </div>
                            <div class="mt-4">
                                <form action="{{ route('cart.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="productId" value="{{ $product->id }}">
                                    <input type="hidden" name="priceId" value="{{ $product->price->id }}">
                                    <div class="input-group input-group-lg">
                                        <input class="form-control col-6 {{ $errors->has('qty') ? ' is-invalid' : '' }}" type="number" id="qty" name="qty" value="" placeholder="輸入數量點購物車" required>
                                        <span class="input-group-append mr-3">
                                            <button type="submit" class="btn btn-info btn-flat"><i class="fas fa-cart-arrow-down fa-lg mr-2"></i></i>加入購物車</button>
                                        </span>
                                        <span class="input-group-append">
                                            <a href="{{ url('shopping') }}" class="btn btn-primary">產品清單</a>
                                        </span>
                                        @if ($errors->has('qty'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('qty') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    @if($cart)
                                    <hr>
                                    <span class="text-primary">你的購物車已有此產品，共 {{ $cart->qty }} 個，是否還要加購？<br>請在輸入框中輸入數量並按【加入購物車】按鈕來增加數量。</span>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <nav class="w-100">
                            <div class="nav nav-tabs" id="product-tab" role="tablist">
                                <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">產品描述</a>
                                <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">會員留言</a>
                            </div>
                        </nav>
                        <div class="tab-content p-3" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">{!! $product->content !!}</div>
                            <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab">
                                @foreach ($product->productComment as $comment)
                                <div class="post clearfix">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="{{ $comment->user->avatar ? asset($comment->user->avatar) : asset('img/noavatar.png') }}" alt="User Image">
                                        <span class="username">
                                            <a href="javascript:">{{ $comment->user->name }}</a>
                                        </span>
                                        <span class="description">{{ $comment->created_at }} 留言</span>
                                    </div>
                                    <p>{{ $comment->content }}</p>
                                </div>
                                @endforeach
                            </div>
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
