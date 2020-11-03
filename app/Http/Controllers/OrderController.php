<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use App\Order as OrderEloquent;
use App\Cart as CartEloquent;
use App\Product as ProductEloquent;
use App\ProductPrice as ProductPriceEloquent;
use App\ProductOrder as ProductOrderEloquent;

use App\Http\Requests\OrderRequest;
use Auth;
use View;
use Redirect;

class OrderController extends Controller
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
        $orders = OrderEloquent::where('user_id',Auth::user()->id)->get();
        return View::make('orders.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carts = CartEloquent::where('user_id',Auth::user()->id)->whereNull('status')->get();
        $total = null;
        foreach($carts as $cart){
            $total = $total + $cart->productPrice->price * $cart->qty;
        }
        return View::make('orders.create',compact('carts','total'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        //整理資料
        $produtIds = $request->productId;
        $qtys = $request->qty;
        $prices = $request->price;
        $total = null;

        //檢查價格是否造假
        for($i=0;$i<count($produtIds);$i++){
            $compare = ProductPriceEloquent::where([
                    'product_id' => $produtIds[$i],
                    'price' => $prices[$i],
                ])
                ->orderBy('created_at','DESC')->first();
            //若有造假強制登出
            if(!$compare){
                return Redirect::route('logout');
            }
            $priceId[] = $compare->id;
            $total = $total + ( $prices[$i] * $qtys[$i] );
        }

        //產生訂單
        $order = OrderEloquent::create([
            'user_id' => Auth::user()->id,
            'total' => $total,
            'status' => '已下單',
        ]);

        for($i=0;$i<count($produtIds);$i++){
            ProductOrderEloquent::create([
                'product_id' => $produtIds[$i],
                'order_id' => $order->id,
                'price' => $prices[$i],
                'qty' => $qtys[$i],
            ]);
            //註記購物車狀態
            CartEloquent::where([
                'product_price_id' => $priceId[$i],
                'user_id' => Auth::user()->id,
            ])->update(['status' => '已下單']);
        }
        return Redirect::route('order.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = OrderEloquent::findOrFail($id);
        return View::make('orders.show',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $id
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
     * @param  \App\Order  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = OrderEloquent::findOrFail($id)->update(['status' => '被刪除']);
        OrderEloquent::findOrFail($id)->delete();
        return Redirect::back();
    }
}
