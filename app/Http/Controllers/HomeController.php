<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post as PostEloquent;
use App\PostType as PostTypeEloquent;
use Redirect;
use View;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome');
        // return Redirect::action('PostsController@index');
    }

    /*
        跨資料庫測試
        use DB;
    */
    public function parktaipei()
    {
        $parks = DB::connection('parktaipei')->table('parkmanagement')->get();
        return view('parktaipei',compact('parks'));
    }

    public function post()
    {
        return Redirect::action('PostsController@post');
    }

    public function search(Request $request){
        if(!$request->has('keyword')){
            return Redirect::back();
        }
        $keyword = $request->keyword;
        $posts = PostEloquent::where('title', 'LIKE', "%$keyword%")->orderBy('created_at', 'DESC')->paginate(5);
        return View::make('posts.index', compact('posts', 'keyword'));
    }
    public function AdminLTE($getPath)
    {
        if($getPath){
            return View::make('AdminLTE.'.$getPath);
        }else{
            return View::make('AdminLTE.index');
        }
    }
}
