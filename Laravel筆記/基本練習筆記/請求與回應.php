<?php
/*
    Request 請求.
    use Illuminate\Http\Request;
    use App\Http\Requests\EditRequest;

    Request 主要就是 http 請求內容, 只要在控制器中傳入值為 Request 型態.
*/
/*
    Request 內容取得方式
*/
    $request->path(); //回傳值為 eidt/{student_no}
    $request->url(); //取得完整的網址路徑
    $request->input('name'); //取得輸入的資料, 名稱為 name 的請求內容.
    $request->name; //同上
    $request->input('name', 'tel'); //當第一個值找不到時,就會以第二值為預設值.
    $request->has('name'); //has()方法用於判斷目標是否存在, 且不為空字串. 若存在則回傳 true, 可用來做判斷用
    $request->all(); //取得全部
    $request->only(['name']); //只取name欄位資料 [陣列]
    $request->only('name'); // 只取name欄位資料 [動態列表]
    $request->except(['name']); //只取 非name欄位資料 [陣列]
    $request->except('name'); //只取 非name欄位資料 [動態列表]

    $request->flash(); //將輸入資料暫存至Session
    $request->flash('name');
    $request->flashOnly('name'); //只取 name 欄位放入 Session
    $request->flashExcept('name'); //只取 非name欄位資料放入 Session

/*
    SESSION 資料導出
*/
    return redirect()->action('HomeController@index')->withInput($request->only('name'));
    return redirect()->action('${App\Http\Controllers\HomeController@index}', ['parameterKey' => 'value']);
/*
    若要再次取出請求已暫存輸入的資料，可以使用old方式把Session資料取出
    $request->old('name');
    //Laravel也提供全域的old方法能夠在blade顯示
    {{ old('name') }}
*/
/*
    取得請求中的 Cookie 值
    Laravel會對每個建立的cookie加密並加上認證記號, 若要從當次請求中取得cookie值可以使用cookie方法
*/
    $request->cookie('name');
/*
    加入新的Cookie到Response(回應)中
*/
    return $response->withCookie(cookie('name', 'tel'));
/*
    若要建立五年的cookie可以呼叫cookie輔助方法並不代入任何參數，
    接著再用cookie工廠的forever方式串接在回傳的cookie工廠
*/
    $response->withCookie(cookie()->forever('name','tel'));
/*
    !!!!取得上傳檔案!!!!
    file方法可以取得上傳檔案其回傳的物件是
    sympony\Component\HttpFoundation\File\UploadedFile
    而該類別繼承了PHP的SplFileInfo類別，並提供許多檔案互動方式
*/
    $request->file('avatar');
    $request->hasFile('avatar'); //判斷上傳檔案是否存在有則回傳true
    $request->file('avatar')->isValid(); //判斷上傳檔案是否成功
    $request->file('avatar')->move('目標目錄'); //移動已經上傳的檔案到要求的目標目錄中

/*
    Response 回應
    所有的路由或控制器都需要回傳某種類型的回應給瀏覽器。
    Laravel提供幾種不同的回應，常見如下:
*/
    return 'HelloWorld'; //如同 echo 資料
    //回應到視圖
    return view('字串或資料');
    return View::make('edit',['student' => $student]);
    //JSON
    return response()->json(['name' => '小明', 'tel' => '1234567890']);
    //檔案下載, 第一個參數為瀏覽器要下載的檔案路徑, 第二個參數為下載檔案的預設檔名,
    //第三個最後參數則是傳遞HTTP標頭陣列.
    return response()->download(['檔案路徑'],['檔案自訂名稱'],['HTTP標頭']);
    /*
    Redirect 重導向, 分三種導向方式
    1. redirect
    2. route
    3. action
    */
    //第一種 直接導向
    return Redirect::to('some/url');
    return redirect('some/url');
    //第二種 導向到Route
    return Redirect::route('named_route', ['parameterKey' => 'value']);
    return redirect()->route('named_route', ['parameterKey' => 'value']);
    //第三種 導向到Controller
    return Redirect::action('${App\Http\Controllers\HomeController@index}', ['parameterKey' => 'value']);
    return redirect()->action('${App\Http\Controllers\HomeController@index}', ['parameterKey' => 'value']);
/*
    Form Method Spoofing 方法欺騙
    常見表單中的method只有get與post但Laravel還有 put, patch 和 delete
    put 與 patch 是對應更新或編輯資料所使用方法, 而delete是刪除資料.
    所以若要送出上述三種屬性則必須在表單中隱藏 _method 欄位.
    (我常用的 <input type="hidden" name="dopost" value=""> 就是此方式)

    一般寫法
    <form action="{{ route('index') }}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="PUT">
    </form>

    Blade寫法
    <form action="{{ route('index') }}" method="POST">
        @csrf
        @method('PUT')
    </form>
*/
