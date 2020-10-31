<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product as ProductEloquent;
use App\ProductImage as ProductImageEloquent;
use Carbon\Carbon; //時間格式套件
use Auth;   //使用者驗證
use View;   //視圖
use Redirect; //轉向

class ShoppingController extends Controller
{
    public function __construct(){
        $this->middleware('auth', [
            'except' => [
                'index', 'show'
            ]
        ]);

        //檢查email是否驗證過
        $this->middleware('verified', [
            'except' => [
                'index', 'show'
            ]
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = ProductEloquent::paginate(12);
        foreach($products as $product){
            //找出產品最新的價格
            $product->price = ProductEloquent::find($product->id)->productPrice()->orderBy('created_at','DESC')->first();
        }
        return View::make('shopping.index', compact('products'));
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
        $product = ProductEloquent::findOrFail($id);
        $product->price = ProductEloquent::find($product->id)->productPrice()->orderBy('created_at','DESC')->first();
        return View::make('shopping.show', compact('product'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addToCart(Request $request)
    {
        // dd($request);
        return View::make('shopping.cart');
    }
}
