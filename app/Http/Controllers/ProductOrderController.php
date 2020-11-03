<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductOrder as ProductOrderEloquent;
use App\Order as OrderEloquent;
use App\Product as ProductEloquent;
use App\Http\Requests\ProductOrderRequest;
use Auth;
use View;
use Redirect;

class ProductOrderController extends Controller
{
    //透過中介層檢驗
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $id = (INT)$request->id;
        $qty = (INT)$request->qty;
        $action = $request->action;
        //加一
        if($action === 'increase'){
            ProductOrderEloquent::find($id)->increment('qty', 1);
        }
        //減一
        elseif($action === 'decrease'){
            ProductOrderEloquent::find($id)->decrement('qty', 1);
        }
        elseif($action === 'modify'){
            if($qty>0){
                $productOrder = ProductOrderEloquent::find($id)->update(['qty' => $qty]);
            }else{
                return '數量錯誤';
            }
        }
        //重新計算order總金額並更新到訂單中
        $productOrder = ProductOrderEloquent::find($id);
        $productOrder->qty <= 0 ? $productOrder->delete() : '';

        $orderId = $productOrder->order_id;
        $productOrders = ProductOrderEloquent::where([
            'order_id' => $orderId,
        ])->get();
        $total = 0;
        foreach($productOrders as $po){
            $total = $total + ( $po->price * $po->qty );
        }
        if($total != 0){
            $order = OrderEloquent::find($orderId)->update(['total' => $total]);
        }else{
            $order = OrderEloquent::find($orderId)->update(['total' => 0, 'status' => '被刪除']);
            $order = OrderEloquent::find($orderId)->delete();
        }
        return $total;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productOrder = ProductOrderEloquent::findOrFail($id);
        //重新計算order總金額並更新到訂單中
        $orderId = $productOrder->order_id;
        $productOrder->delete();
        $productOrders = ProductOrderEloquent::where([
                'order_id' => $orderId,
            ])->get();
        $total = 0;
        foreach($productOrders as $po){
            $total = $total + ( $po->price * $po->qty );
        }
        if($total != 0){
            $order = OrderEloquent::find($orderId)->update(['total' => $total]);
            return Redirect::back();
        }else{
            $order = OrderEloquent::find($orderId)->update(['status' => '被刪除']);
            $order = OrderEloquent::find($orderId)->delete();
            return Redirect::route('order.index');
        }
    }
}
