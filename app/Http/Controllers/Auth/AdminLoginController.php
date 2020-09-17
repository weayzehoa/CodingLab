<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Route;

use Arcanedev\NoCaptcha\Rules\CaptchaRule;

class AdminLoginController extends Controller
{
    //先經過 middleware
    public function __construct()
    {
      $this->middleware('guest:admin', ['except' => ['logout']]);
    }
    //顯示 admin.login 視圖
    public function showLoginForm()
    {
      return view('admin.login');
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
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            //驗證無誤轉入 admin.dashboard
            return redirect()->intended(route('admin.dashboard'));
        }

        // 驗證失敗 返回並拋出表單內容 只拋出 email 與 remember 欄位資料,
        // withErrors(['email' => trans('auth.failed')])用來覆蓋掉email欄位的錯誤訊息
        // trans('auth.failed) 系統預設語言拋出
        // 訊息 [使用者名稱或密碼錯誤] 為了不讓別人知道到底帳號是否存在
        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors(['email' => trans('auth.failed')]);
    }
    //登出
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }
}
