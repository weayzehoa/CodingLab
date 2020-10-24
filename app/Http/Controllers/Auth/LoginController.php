<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Arcanedev\NoCaptcha\Rules\CaptchaRule;
use Auth;
use App\User as UserEloquent;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    //登入
    public function login(Request $request)
    {
        // 驗證表單資料
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:4',
            'captchacode' => 'required|captcha',
            'g-recaptcha-response' => ['required', new CaptchaRule],
        ]);
        // 將表單資料送去Auth::gurard()驗證
        if (Auth::guard()->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            //登入成功紀錄
            $user = UserEloquent::find(Auth::guard()->id());
            activity('前台會員')->causedBy($user)->log('登入成功');
            //驗證無誤轉入 index
            return redirect()->intended(route('index'));
        }

        //登入失敗紀錄 (可能會有機器人嘗試登入造成太多紀錄，取消紀錄登入失敗功能)
        // $user = UserEloquent::where('email','=',$request->email)->first();
        // activity('前台會員')->causedBy($user)->log('登入失敗');

        // 驗證失敗 返回並拋出表單內容 只拋出 email 與 remember 欄位資料,
        // withErrors(['email' => trans('auth.failed')])用來覆蓋掉email欄位的錯誤訊息
        // trans('auth.failed) 系統預設語言拋出
        // 訊息 [使用者名稱或密碼錯誤] 為了不讓別人知道到底帳號是否存在
        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors(['email' => trans('auth.failed')]);
    }
    //登出
    public function logout()
    {
        //登出成功紀錄
        $user = UserEloquent::find(Auth::guard()->id());
        activity('前台會員')->causedBy($user)->log('登出成功');
        //清除紀錄並轉向回 首頁
        Auth::guard()->logout();
        return redirect()->route('index');
    }
}
