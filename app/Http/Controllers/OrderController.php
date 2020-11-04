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
use Session;;

use ECPay_PaymentMethod;

class OrderController extends Controller
{
    //透過中介層檢驗
    // public function __construct(){
    //     $this->middleware('auth');
    // }

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

    //建立訂單與付款資料傳送至綠界
    public function pay(Request $request)
    {

        $id = $request->orderid;
        $order = OrderEloquent::findOrFail($id);
        $products = ProductOrderEloquent::where('order_id',$order->id)->get();

        $MerchantTradeNo = "OrderTest".time();
        OrderEloquent::find($id)->update(['payMethod' => $MerchantTradeNo ]);
    /**
    *    Credit信用卡付款產生訂單範例
    */
    //載入SDK(路徑可依系統規劃自行調整)
    try {
        $obj = new \ECPay_AllInOne();

        //服務參數 (測試用參數)
        $obj->ServiceURL  = "https://payment-stage.ecpay.com.tw/Cashier/AioCheckOut/V5";   //服務位置
        $obj->HashKey     = '5294y06JbISpM5x9' ;                                           //測試用Hashkey，請自行帶入ECPay提供的HashKey
        $obj->HashIV      = 'v77hoKGq4kWxNNIS' ;                                           //測試用HashIV，請自行帶入ECPay提供的HashIV
        // $obj->MerchantID  = '2000132';                                                     //(有OTP)測試用MerchantID，請自行帶入ECPay提供的MerchantID
        $obj->MerchantID  = '2000214';                                                     //(無OTP)測試用MerchantID，請自行帶入ECPay提供的MerchantID
        $obj->EncryptType = '1';                                                           //CheckMacValue加密類型，請固定填入1，使用SHA256加密

        //基本參數(請依系統規劃自行調整)
        $obj->Send['ReturnURL']         = env('ECPay_CALL_BACK');    //付款完成通知回傳的網址
        $obj->Send['ClientBackURL']         = env('ECPay_CALL_BACK_SUCCESS');    //付款完成通知回傳的網址
        $obj->Send['MerchantTradeNo']   = $MerchantTradeNo;                          //訂單編號
        $obj->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');                       //交易時間
        $obj->Send['TotalAmount']       = $order->total;                                      //交易金額
        $obj->Send['TradeDesc']         = "good to drink" ;                          //交易描述
        $obj->Send['ChoosePayment']     = ECPay_PaymentMethod::Credit ;              //付款方式:Credit
        $obj->Send['IgnorePayment']     = ECPay_PaymentMethod::GooglePay ;           //不使用付款方式:GooglePay

        //訂單的商品資料
        // $items = array('Name' => "歐付寶黑芝麻豆漿", 'Price' => (int)"2000",
        // 'Currency' => "元", 'Quantity' => (int) "1", 'URL' => "dedwed");
        foreach ($products as $product) {
            $items['Name'] = $product->product->name;
            $items['Price'] = $product->price;
            $items['Currency'] = '元';
            $items['Quantity'] = $product->qty;
            $items['URL'] = "dedwed";
            array_push($obj->Send['Items'], $items);
        }

        //Credit信用卡分期付款延伸參數(可依系統需求選擇是否代入)
        //以下參數不可以跟信用卡定期定額參數一起設定
        $obj->SendExtend['CreditInstallment'] = '' ;    //分期期數，預設0(不分期)，信用卡分期可用參數為:3,6,12,18,24
        $obj->SendExtend['InstallmentAmount'] = 0 ;    //使用刷卡分期的付款金額，預設0(不分期)
        $obj->SendExtend['Redeem'] = false ;           //是否使用紅利折抵，預設false
        $obj->SendExtend['UnionPay'] = false;          //是否為聯營卡，預設false;

        //Credit信用卡定期定額付款延伸參數(可依系統需求選擇是否代入)
        //以下參數不可以跟信用卡分期付款參數一起設定
        // $obj->SendExtend['PeriodAmount'] = '' ;    //每次授權金額，預設空字串
        // $obj->SendExtend['PeriodType']   = '' ;    //週期種類，預設空字串
        // $obj->SendExtend['Frequency']    = '' ;    //執行頻率，預設空字串
        // $obj->SendExtend['ExecTimes']    = '' ;    //執行次數，預設空字串

        # 電子發票參數
        /*
        $obj->Send['InvoiceMark'] = ECPay_InvoiceState::Yes;
        $obj->SendExtend['RelateNumber'] = "Test".time();
        $obj->SendExtend['CustomerEmail'] = 'test@ecpay.com.tw';
        $obj->SendExtend['CustomerPhone'] = '0911222333';
        $obj->SendExtend['TaxType'] = ECPay_TaxType::Dutiable;
        $obj->SendExtend['CustomerAddr'] = '台北市南港區三重路19-2號5樓D棟';
        $obj->SendExtend['InvoiceItems'] = array();
        // 將商品加入電子發票商品列表陣列
        foreach ($obj->Send['Items'] as $info)
        {
            array_push($obj->SendExtend['InvoiceItems'],array('Name' => $info['Name'],'Count' =>
                $info['Quantity'],'Word' => '個','Price' => $info['Price'],'TaxType' => ECPay_TaxType::Dutiable));
        }
        $obj->SendExtend['InvoiceRemark'] = '測試發票備註';
        $obj->SendExtend['DelayDay'] = '0';
        $obj->SendExtend['InvType'] = ECPay_InvType::General;
        */

        // dd($obj);

        //產生訂單(auto submit至ECPay)
        $obj->CheckOut();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //綠界返回資料使用
    public function paycallback(Request $request)
    {
        dd($request);
        $order = OrderEloquent::where('payMethod',$request->MerchantTradeNo)->update(['status' => '待出貨' ]);
    }

    //綠界畫面顯示付款成功返回商店時引導回來網址.
    public function paysuccess()
    {
        SESSION::put('success','付款成功');
        return Redirect::route('order');
    }
}
