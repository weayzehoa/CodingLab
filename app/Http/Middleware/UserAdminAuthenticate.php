<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class UserAdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //取得目前使用者資料
        $current_user = Auth::user();
        //取得文章編號
        $id = $request->post;
        //使用者存在且文章編號存在
        if(!empty($current_user) && !empty($id)){
            //檢查是否為該使用者文章或者為管理員
            $post = $current_user->posts()->find($request->post);
            if($current_user->isAdmin() || !empty($post)){
                return $next($request);
            }
        }
        //判斷請求是否為ajax或json，如果不是跳轉文章首頁
        if ($request->ajax() || $request->wantsJson()) {
            return response('您沒有權限操作此項目.', 401);
        } else {
            return redirect()->route('posts.index');
        }
    }
}
