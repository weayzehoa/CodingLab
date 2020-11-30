<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\User as UserEloquent;

use Illuminate\Support\Facades\Auth;

/**
 *  @OA\Tag(
 *      name="USER",
 *      description="OPERATIONS ABOUT USER"
 *  )
 */

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
     /**
     *  @OA\Post(
     *      path="/api/login",
     *      summary="User Login",
     *      tags={"USER"},
     *      operationId="login",
     *
     *      @OA\Parameter(
     *          name="email",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *               type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="password",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *           description="Success",
     *          @OA\MediaType(
     *               mediaType="application/json",
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated"
     *      ),
     *      @OA\Response(
     *         response=400,
     *         description="Bad Request"
     *      ),
     *  )
     **/
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
    /**
     *  @OA\POST(
     *      path="/api/me",
     *      summary="GET Curent User Information",
     *      tags={"USER"},
     *      operationId="users",
     *      security={{ "apiAuth": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="Success"
     *      ),
     *  )
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
    /**
     *  @OA\POST(
     *      path="/api/logout",
     *      summary="Log the user out (Invalidate the token).",
     *      tags={"USER"},
     *      operationId="users",
     *      security={{ "apiAuth": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="Success"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated"
     *      ),
     *  )
     */
    public function logout()
    {
        //找出登入者資料
        $user = auth('api')->user();

        //JWT RAW data
        // $payload = auth('api')->payload();

        //重新更新token
        // $newtoken = auth('api')->refresh();
        // return $this->respondWithToken($newtoken);

        //抓取是否有返回token
        // $token = request(['token']);

        //如果沒使用者存在則給出錯誤訊息
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        //登出並清除token
        auth('api')->logout();
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

    /**
     *  @OA\Get(
     *      path="/api/users",
     *      tags={"USER"},
     *      summary="GET LIST OF USERS",
     *      operationId="users",
     *      @OA\Response(
     *          response=200,
     *          description="Success"
     *      )
     *  )
     */
    public function users()
    {
        $users = UserEloquent::all();
        return response()->json($users, 200);
    }
}
