<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use View;

use App\Post as PostEloquent; //posts資料表
use Spatie\Activitylog\Models\Activity;
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
        $id = Auth::id();
        $guarder = $_SERVER['REMOTE_ADDR'];
        $lastActivity = Activity::all()->last()->properties;

        //Debugbar用
        \Debugbar::info(Auth::user());
        \Debugbar::error('Error!');
        \Debugbar::warning(Auth::guard('admin'));
        \Debugbar::addMessage($id);
        \Debugbar::addMessage($lastActivity);
        // \Debugbar::disable();

        return View::make('admin.dashboard', compact('adminuser','lastActivity'));
    }
}
