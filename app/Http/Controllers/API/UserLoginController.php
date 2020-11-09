<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        //除了 login 其餘 function 都要經過 api 的 middleware 檢查
        $this->middleware('api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        //驗證
        $validator = Validator::make($credentials, [
            'email'   => 'required|email',
            'password' => 'required|min:4',
        ]);

        //驗證失敗返回訊息
        if ($validator->fails()) {
            return response()->json(['error' => '帳號密碼錯誤'], 400);
        }

        //透過Auth取得JWT token
        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => '授權失敗'], 401);
        }

        //將token拋出
        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        //找出登入者資料
        // $user = auth('api')->user();

        //JWT RAW data
        // $payload = auth('api')->payload();

        //重新更新token
        // $newtoken = auth('api')->refresh();
        // return $this->respondWithToken($newtoken);

        //抓取是否有返回token
        $token = request(['token']);
        //如果沒返回token則給出錯誤訊息
        if(!$token){
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        //登出並清除token
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out'], 200);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'user' => auth('api')->user(), //將使用者資料一起帶出
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
