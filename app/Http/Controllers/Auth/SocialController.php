<?php

namespace App\Http\Controllers\Auth;

//使用相關的class
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User as UserEloquent;
use App\SocialUser as SocialUserEloquent;
use App;
use Auth;
use Config;
use Redirect;
use Socialite;

class SocialController extends Controller
{   //套用到 guest 中介層
    public function __construct(){
        $this->middleware('guest');
    }
    //判斷由哪一個第三方平台登入
    public function getSocialRedirect($provider){
        $providerKey = Config::get('services.' . $provider);
        if(empty($providerKey)){
            return App::abort(404);
        }
        return Socialite::driver($provider)->redirect();
    }
    //回傳錯誤
    public function getSocialCallback($provider, Request $request){
        if($request->exists('error_code')){
            return Redirect::route('login')->withErrors([
                'msg' => $provider . '登入或綁定失敗，請重新再試'
            ]);
        }
        //取得第三方登入使用者資料
        $socialite_user = Socialite::with($provider)->user();
        $login_user = null;
        //檢查是否曾經紀錄過
        $s_u = SocialUserEloquent::where('provider_user_id', $socialite_user->id)->where('provider', $provider)->first();
        if(!empty($s_u)){
            $login_user = $s_u->user;
        }else{
            if (empty($socialite_user->email)) {
                return Redirect::route('login')->withErrors([
                    'msg' => '很抱歉，我們無法從您的' . $provider . '帳號抓到信箱，請用其他方式註冊帳號謝謝!'
                ]);
            }
            //比對是否有使用者紀錄
            $user = UserEloquent::where('email', $socialite_user->email)->first();
            if($user){
                $login_user = $user;
                $login_user->socialUser = SocialUserEloquent::create([
                    'provider_user_id' => $socialite_user->id,
                    'provider' => $provider,
                    'user_id' => $login_user->id
                ]);
                // return Redirect::route('login')->withErrors([
                //     'message' => "抱歉!! email帳號: $user->email 已被綁定了，請使用其他登入方式"
                // ]);
            }else{
                //如果沒有使用者紀錄 將資料建立在 User 資料表中
                $login_user = UserEloquent::create([
                    'email' => $socialite_user->email,
                    'password' => bcrypt(Str::random(8)),
                    'name' => $socialite_user->name,
                    'avatar' => $socialite_user->avatar,
                ]);

                //直接讓第三方驗證的帳號通過email驗證
                $login_user->email_verified_at = date('Y-m-d H:i:s');
                $login_user->save();

                $login_user->socialUser = SocialUserEloquent::create([
                    'provider_user_id' => $socialite_user->id,
                    'provider' => $provider,
                    'user_id' => $login_user->id
                ]);
                //紀錄
                $log = "使用 $provider 註冊";
                activity('前台會員')->causedBy($login_user)->log($log);
            }
        }
        //登入
        if(!is_null($login_user)){
            Auth::login($login_user);
            //紀錄
            $log = "使用 $provider 登入";
            activity('前台會員')->causedBy($login_user)->log($log);

            // return Redirect::route('index');
            //返回登入前那一頁
            return Redirect::intended();
        }
        return App::abort(500);
    }
}
