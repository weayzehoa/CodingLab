<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Arcanedev\NoCaptcha\Rules\CaptchaRule;
use Auth;
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
            'g-recaptcha-response' => ['required', new CaptchaRule],
        ]);
        // 將表單資料送去Auth::gurard('admin')驗證
        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            //驗證無誤轉入 index
            return redirect()->intended(route('index'));
        }
        // 驗證失敗 返回並拋出表單內容 只拋出 email 與 remember 欄位資料,
        // withErrors(['email' => trans('auth.failed')])用來覆蓋掉email欄位的錯誤訊息
        // trans('auth.failed) 系統預設語言拋出
        // 訊息 [使用者名稱或密碼錯誤] 為了不讓別人知道到底帳號是否存在
        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors(['email' => trans('auth.failed')]);
    }
}
