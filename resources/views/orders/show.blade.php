@extends('layouts.master')

@section('title', '訂單')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container bg-white">
            <div class="card card-danger card-outline">
                <div class="card-body box-profile">
                    <h3 class="profile-username text-center">訂單頁面</h3>
                    <i class="fas fa-info text-danger"></i> 此頁面，會將使用者選擇修改訂單的資料列出，並計算出總共金額。<br>
                    <i class="fas fa-info text-danger"></i> 使用者可以調整訂單的產品數量或刪除不需要的產品，若所有產品都被刪除，則該筆訂單也將被刪除。<br>
                    <i class="fas fa-info text-danger"></i> 按下確定修改按鈕，會將頁面上所有資料更新至訂單中。<br>
                </div>
            </div>
            <div class="card card-primary card-outline">
                {{-- alert訊息 --}}
                @include('admin.layouts.alert_message')
                <div class="card-header">
                    <span>訂單編號：{{ $order->id }}</span>
                    <span class="float-right">訂單日期：{{ $order->created_at }}</span>
                </div>
                <div class="card-body">
                    @if($order)
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
                            @foreach($order->productOrders as $po)
                            <tr>
                                <td class="align-middle">{{ $po->product->no }}</td>
                                <td class="align-middle">
                                    <div class="row">
                                        <div class="user-block col-1 mr-2">
                                            <img class="img-bordered-sm" src="{{ $po->product->imagepath ?? '' }}" alt="User Image">
                                        </div>
                                        <div class="user-block col-10">
                                            <a href="{{ url('shopping/' . $po->product->id) }}">
                                                {{ $po->product->name }}
                                            </a>
                                            <br />
                                            <small>
                                                {{ $po->product->title }}
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center align-middle">{{ $po->price }}</td>
                                <td class="align-middle">
                                    <form action="{{ route('po.destroy', $po->id) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <div class="input-group">
                                            <div class="input-group-prepend" onclick="dopost('PATCH', {{ $po->id }}, 'decrease' )">
                                                <span class="input-group-text text-danger">
                                                    <i class="fas fa-minus"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control text-center" name="qty" value="{{ $po->qty }}" poid="{{ $po->id }}">
                                            <div class="input-group-append">
                                                <div class="input-group-text text-info"><i class="fas fa-plus" onclick="dopost('PATCH', {{ $po->id }}, 'increase' )"></i></div>
                                            </div>
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-sm input-group-text bg-danger"><i class="fas fa-trash"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                                <td class="text-right align-middle">{{ number_format($po->price * $po->qty)." 元" }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td class="align-middle"></td>
                                <td class="align-middle"></td>
                                <td class="align-middle"></td>
                                <td class="align-middle"></td>
                                <td class="text-right align-middle">總計： {{ number_format( $order->total )." 元" }}</td>
                            </tr>
                        </tbody>
                    </table>
                    @else
                    <h3>目前購物車是空的，去瞎拚一下吧！</h3>
                    @endif
                    <hr>
                    <div class="card-footer">
                        <div class="input-group">
                            <a href="{{ url('shopping') }}" class="btn btn-primary btn-lg btn-flat mr-3">
                                <i class="fas fa-shopping-cart fa-lg mr-2"></i>繼續購物
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
        if (method === 'PATCH') {
            $.ajax({
                type: "post",
                url: '{{ url("po/update") }}',
                data: {
                    _method: method,
                    id: id,
                    action: action,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    data > 0 ? location.reload() : location.href = '{{ url("order") }}';
                }
            });
        }
    }

    $('input[name=qty]').change(function(e) {
        let val = $(this).val();
        let id = $(this).attr('poid');
        reg = new RegExp('^[0-9]+$');
        if (val.match(reg)) {
            $.ajax({
                type: "post",
                url: '{{ url("po/update") }}',
                data: {
                    _method: 'PATCH',
                    id: id,
                    qty: val,
                    action: 'modify',
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    if(data == '數量錯誤'){
                        alert('數量輸入錯誤，不可小於等於0');
                        location.reload();
                    }else if(data > 0){
                        location.reload();
                    }else{
                        location.href = '{{ url("order") }}';
                    }
                }
            });
        } else {
            alert('請輸入數字');
        }
    });
</script>
@endsection