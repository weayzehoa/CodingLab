@extends('layouts.master')

@section('title', '購物車')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container bg-white">
            <div class="card card-danger card-outline">
                <div class="card-body box-profile">
                    <h3 class="profile-username text-center">購物車頁面</h3>
                    <i class="fas fa-info text-danger"></i> 當使用者登入後，會將該使用者所有購物車未購買的資料列出，並計算出總共金額。<br>
                    <i class="fas fa-info text-danger"></i> 按確定下單按鈕，將所有購物車資料轉換為訂單資料，並進入到訂單清單畫面。<br>
                </div>
            </div>
            <div class="card card-primary card-outline">
                {{-- alert訊息 --}}
                @include('admin.layouts.alert_message')
                <div class="card-body">
                    @if($carts->first())
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th width="10%">產品編號</th>
                                <th width="45%">產品名稱</th>
                                <th class="text-center" width="10%">單價</th>
                                <th class="text-center" width="20%">數量</th>
                                <th width="15%" class="text-right">小計</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($carts as $cart)
                            <tr>
                                <td class="align-middle">{{ $cart->productPrice->product->no }}</td>
                                <td class="align-middle">
                                    <div class="row">
                                        <div class="user-block col-1 mr-2">
                                            <img class="img-bordered-sm" src="{{ $cart->productPrice->product->imagepath ?? '' }}" alt="User Image">
                                        </div>
                                        <div class="user-block col-10">
                                            <a href="{{ url('shopping/' . $cart->productPrice->product->id) }}">
                                                {{ $cart->productPrice->product->name }}
                                            </a>
                                            <br />
                                            <small>
                                                {{ $cart->productPrice->product->title }}
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center align-middle">{{ $cart->productPrice->price }}</td>
                                <td class="align-middle">
                                    <form action="{{ route('cart.update', $cart->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="PATCH">
                                        <div class="input-group">
                                            <div class="input-group-prepend" onclick="dopost('PATCH', {{ $cart->id }}, 'decrease' )">
                                                <span class="input-group-text text-danger">
                                                    <i class="fas fa-minus"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control text-center" name="qty" value="{{ $cart->qty }}" cartid="{{ $cart->id }}">
                                            <div class="input-group-append">
                                                <div class="input-group-text text-info"><i class="fas fa-plus" onclick="dopost('PATCH', {{ $cart->id }}, 'increase' )"></i></div>
                                            </div>
                                            <div class="input-group-append" onclick="dopost('DELETE', {{ $cart->id }}, 'delete' )">
                                                <div class="input-group-text bg-danger">
                                                    <i class="fas fa-trash"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                                <td class="text-right align-middle">{{ number_format($cart->productPrice->price * $cart->qty)." 元" }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td class="align-middle"></td>
                                <td class="align-middle"></td>
                                <td class="align-middle"></td>
                                <td class="align-middle"></td>
                                <td class="text-right align-middle">總計： {{ number_format( $total )." 元" }}</td>
                            </tr>
                        </tbody>
                    </table>
                    @else
                    <h3>目前購物車是空的，去瞎拚一下吧！</h3>
                    @endif
                    <hr>
                    <div class="card-footer">
                        <div class="float-right">
                            @if($carts->first())
                            {{-- <a href="{{ route('order.create') }}" class="btn btn-danger btn-lg btn-flat mr-3">
                                <i class="fas fa-cash-register fa-lg mr-2"></i>結帳買單
                            </a> --}}
                            <form class="float-right" action="{{ route('order.store') }}" method="POST">
                                @csrf
                                @foreach($carts as $cart)
                                <input type="hidden" name="productId[]" value="{{ $cart->productPrice->product->id }}">
                                <input type="hidden" name="price[]" value="{{ $cart->productPrice->price }}">
                                <input type="hidden" name="qty[]" value="{{ $cart->qty }}">
                                @endforeach
                                <button type="submit" class="btn btn-danger btn-lg btn-flat mr-3">
                                    <i class="fas fa-cash-register fa-lg mr-2"></i>確定下單
                                </button>
                            </form>
                            @endif
                        </div>
                        <div>
                            <a href="{{ url('shopping') }}" class="btn btn-primary btn-lg btn-flat mr-3">
                                <i class="fas fa-shopping-cart fa-lg mr-2"></i>{{ $carts->first() ? '繼續購物' : '去瞎拚' }}
                            </a>
                            <a href="{{ url('order') }}" class="btn btn-danger btn-lg btn-flat">
                                <i class="fas fa-cash-register fa-lg mr-2"></i>我的訂單
                            </a>
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
<script>
    function dopost(method, id, action) {
        if (method === 'DELETE') {
            if (confirm('請確認是否刪除?\n請注意！按確認後該筆資料將會被永久刪除。')) {
                $.ajax({
                    type: "post",
                    url: window.location.href + '/destroy',
                    data: {
                        _method: method,
                        id: id,
                        action: action,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        // console.log(data);
                        location.reload();
                    }
                });
            }
        } else if (method === 'PATCH') {
            $.ajax({
                type: "post",
                url: window.location.href + '/update',
                data: {
                    _method: method,
                    id: id,
                    action: action,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    // console.log(data);
                    location.reload();
                }
            });
        }
    }

    $('input[name=qty]').change(function (e) {
        let val = $(this).val();
        let id = $(this).attr('cartid');
        reg = new RegExp('^[0-9]+$');
        if(val.match(reg)){
            $.ajax({
                type: "post",
                url: window.location.href + '/update',
                data: {
                    _method: 'PATCH',
                    id: id,
                    qty: val,
                    action: 'modify',
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    // console.log(data);
                    location.reload();
                }
            });
        }else{
            alert('請輸入數字');
        }
    });
</script>
@endsection
