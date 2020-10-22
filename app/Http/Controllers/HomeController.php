<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post as PostEloquent;
use App\PostType as PostTypeEloquent;
use Redirect;
use View;
use DB;
use Ixudra\Curl\Facades\Curl;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
        $qrCode = QrCode::color(0, 0, 255)->generate(env('APP_URL'));
        return view('welcome', compact('qrCode'));
    }

    /*
        台北市公園資訊跨資料庫測試1
        use DB;
    */
    public function parktaipei()
    {
        $parks = DB::connection('parktaipei')->table('parkmanagement')->get();
        if(!empty($_GET['type'])){
            switch ($_GET['type']) {
                case 'json':
                    $jsonData = json_encode($parks,true);
                    $filename=mb_convert_encoding('臺北市公園基本資料', 'big5', 'UTF-8').'.json';
                    return response()
                            ->json($parks)
                            ->header('Content-Type','application/json; charset=utf-8');
                    break;
                case 'json2':
                    $jsonData = json_encode($parks,true);
                    return view('parktaipei',compact('jsonData'));
                    break;
                default:
                    return view('parktaipei');
                    break;
            }
        }else{
            return view('parktaipei',compact('parks'));
        }
    }

    /*
        台北市公園資訊Curl測試2
        use Ixudra\Curl\Facades\Curl;
    */
    public function parktaipei2()
    {
        $jsonString = Curl::to('https://parks.taipei/parks/api/')->get();
        $parks2 = json_decode($jsonString);
        return view('parktaipei2',compact('parks2'));
    }

    /*
        台北市公園資訊跨資料庫測試3
        use DB;
    */
    public function parktaipei3()
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
