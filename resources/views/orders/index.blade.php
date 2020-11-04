@extends('layouts.master')

@section('title', '訂單列表')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container bg-white">
            <div class="card card-danger card-outline">
                <div class="card-body box-profile">
                    <h3 class="profile-username text-center">訂單列表頁面</h3>
                    <i class="fas fa-info text-danger"></i> 此頁面，會將該使用者所有訂單資料列出。<br>
                    <i class="fas fa-info text-danger"></i> 付款方式出現按鈕代表尚未選擇付款方式，訂單狀態將呈現已下單。<br>
                    <i class="fas fa-info text-danger"></i> 付款頁面可選擇貨到付款、第三方支付(尚未完成)，若完成付款將轉變為待出貨，並且關閉刪除按鈕。<br>
                </div>
            </div>
            <div class="card card-primary card-outline">
                {{-- alert訊息 --}}
                @include('admin.layouts.alert_message')
                <div class="card-body">
                    @if($orders->first())
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">#</th>
                                <th class="text-center" width="55%">內容</th>
                                <th class="text-right" width="10%">總金額</th>
                                <th class="text-center" width="10%">付款方式</th>
                                <th class="text-center" width="10%">訂單狀態</th>
                                <th class="text-center" width="10%">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td class="text-center align-middle">{{ $order->id }}</td>
                                <td class="text-left align-middle">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th width="10" class="text-sm text-center">#</th>
                                                <th width="70" class="text-sm text-left">產品名稱</th>
                                                <th width="10" class="text-sm text-center">單價</th>
                                                <th width="10" class="text-sm text-center">數量</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $order->productOrders as $po )
                                            <tr>
                                                <td class="text-sm text-center">{{ $loop->iteration }}</td>
                                                <td class="text-sm text-left">
                                                    <a href="{{ url('shopping/' . $po->product->id) }}">
                                                        {{ $po->product->name }}
                                                    </a>
                                                </td>
                                                <td class="text-sm text-center">{{ $po->price }}</td>
                                                <td class="text-sm text-center"><span class="badge bg-danger">{{ $po->qty }}</span></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                                <td class="text-right align-middle">{{ number_format($order->total) }} 元</td>
                                <td class="text-center align-middle">
                                    <a href="#" class="btn btn-sm btn-primary">去付款</a>
                                </td>
                                <td class="text-center align-middle">已下單</td>
                                <td class="text-center align-middle">
                                    @if($order->status == '已下單')
                                    <form action="{{ route('order.destroy', $order->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <a href="{{ route('order.show', $order->id) }}" type="button" class="btn btn-sm btn-primary">
                                            <i class="fas fa-list"></i>
                                        </a>
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </form>
                                    @else
                                    <span>訂單已進入出貨程序不能修改</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <h3>目前訂單是空的，去瞎拚一下吧！</h3>
                    @endif
                </div>
                <hr>
                <div class="card-footer">
                    <div class="float-right">
                        <a href="{{ url('shopping') }}" class="btn btn-primary btn-lg btn-flat mr-3">
                            <i class="fas fa-shopping-cart fa-lg mr-2"></i>去瞎拚
                        </a>
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
    function dopost(method, id, action) {
        if (method === 'DELETE') {
            if (confirm('請確認是否刪除?\n請注意！按確認後該筆資料將會被永久刪除。')) {
                $.ajax({
                    type: "post",
                    url: '{{ url("cart/destroy") }}',
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
                url: '{{ url("cart/update") }}',
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

    $('input[name=qty]').change(function(e) {
        let val = $(this).val();
        let id = $(this).attr('cartid');
        reg = new RegExp('^[0-9]+$');
        if (val.match(reg)) {
            $.ajax({
                type: "post",
                url: '{{ url("cart/update") }}',
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
        } else {
            alert('請輸入數字');
        }
    });
</script>
@endsection