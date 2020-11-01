<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart as CartEloquent;
use App\Product as ProductEloquent;
use App\ProductPrice as ProductPriceEloquent;
use Auth;
use View;
use Redirect;
use App\Http\Requests\AddCartRequest;
use Session;
class CartController extends Controller
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
        $carts = CartEloquent::where('user_id',Auth::user()->id)->get();
        $total = null;
        foreach($carts as $cart){
            $total = $total + $cart->productPrice->price * $cart->qty;
        }
        return View::make('shopping.cart',compact('carts','total'));
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
    public function store(AddCartRequest $request)
    {
        $user = Auth::user();
        $productId = $request->productId;
        $priceId = $request->priceId;
        $qty = $request->qty;

        //檢查是否有該產品及價格表，若沒有，可能是外來造假攻擊
        $product = ProductEloquent::findOrFail($productId);
        $productPrice = ProductPriceEloquent::findOrFail($priceId);

        //檢查購物車是否有該筆資料
        //購物車若有該筆資料則用更新的方式，沒有則建立一筆
        $cart = CartEloquent::where('product_price_id',$priceId)->first();
        if($cart){
            $newQty = $cart->qty + $qty;
            $cart->update(['qty' => $newQty]);
        }else{
            CartEloquent::create([
                'user_id' => $user->id,
                'product_price_id' => $priceId,
                'qty' => $qty,
            ]);
        }

        //產品若存在，且儲存成功，加入訊息返回
        if($product){
            $totalPrice = $qty * $productPrice->price;
            $productName = $product->name;
            $message = "您選擇 $productName ， $qty 個，共 $totalPrice 元，已加入購物車";
            Session::put('info',$message);
            return Redirect::back();
        }

        return Redirect::back()->withErrors();
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
    public function update(Request $request, $action)
    {
        $action = $request->action;
        $id = (INT)$request->id;
        $qty = (INT)$request->qty;
        //加一
        if($action === 'increase'){
            CartEloquent::find($id)->increment('qty', 1);
            $cart = CartEloquent::find($id);
        }
        //減一
        elseif($action === 'decrease'){
            CartEloquent::find($id)->decrement('qty', 1);
            $cart = CartEloquent::find($id);
            $cart->qty <= 0 ? $cart->delete() : '';
        }
        elseif($action === 'modify'){
            if($qty>0){
                $cart = CartEloquent::find($id)->update(['qty' => $qty]);
            }
        }
        return json_encode($cart,true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $action = $request->action;
        $id = $request->id;
        if($action === 'delete'){
            CartEloquent::find($id)->delete();
        }
        return $request;
    }
}
