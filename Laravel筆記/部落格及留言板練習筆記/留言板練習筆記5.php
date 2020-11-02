<?php
/*
    在部落格上面加上留言版
    4. 第三方登入
        第三方登入套件安裝與設定好後，便會把資料帶入控制器並寫入資料表中
        資料表基本上只會存取使用者id、信箱及頭像
*/
/*
    修改login.blade.php
*/
/*
    建立 SocialUserController 並且放在 Controller\Auth 目錄下
    php artisan make:controller Auth\SocialController
*/
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

            if(!empty($user)){
                $login_user = $user;
                $s_user = $login_user->socialUser;

                if (!empty($s_user)) {
                    return Redirect::route('login')->withErrors([
                            'msg' => '此email已被其他帳號綁定了，請使用其他登入方式'
                        ]);
                }else{
                    $login_user->socialUser = SocialUserEloquent::create([
                        'provider_user_id' => $socialite_user->id,
                        'provider' => $provider,
                        'user_id' => $login_user->id
                    ]);
                }
            }else{ //如果沒有使用者紀錄 將資料建立在 User 資料表中
                $login_user = UserEloquent::create([
                    'email' => $socialite_user->email,
                    'password' => bcrypt(Str::random(8)),
                    'name' => $socialite_user->name,
                      'avatar' => $socialite_user->avatar,
                ]);

                $login_user->socialUser = SocialUserEloquent::create([
                    'provider_user_id' => $socialite_user->id,
                    'provider' => $provider,
                    'user_id' => $login_user->id
                ]);
            }
        }
        //登入
        if(!is_null($login_user)){
            Auth::login($login_user);
            return Redirect::route('index');
        }
        return App::abort(500);
    }
}
