<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use View;

use App\Post as PostEloquent; //posts資料表

class AdminController extends Controller

{
    /**
     * Create a new controller instance.
     * 進到這個控制器需要透過middleware檢驗是否為後台的使用者
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * 顯示 dashboard.
     * 並將 使用者的資料拋出
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $adminuser = Auth::user();

        //Debugbar用
        \Debugbar::info(Auth::user());
        \Debugbar::error('Error!');
        \Debugbar::warning('Watch out…');
        \Debugbar::addMessage($post_types);
        // \Debugbar::disable();

        return View::make('admin.dashboard', compact('adminuser'));
    }
}
