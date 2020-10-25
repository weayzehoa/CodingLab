<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;
use DB;
use Session;
use Spatie\Activitylog\Models\Activity as ActivityEloquent; //使用Activity資料表
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Http\Response;

class LogsController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //這邊練習直接將index當作查詢 網址會變成 https://localhost/admin/logs?action=&keywork=&...
    public function index(Request $request)
    {
        $request->keyword ? $keyword = $request->keyword : $keyword = '';
        $request->action ? $action = $request->action : $action = '';
        $search = '';
        //將搜尋的keyword放入session中
        Session::put('key',$keyword);
        if($action){
            //$action變數中有other時排除掉新增刪除修改的字眼來做搜尋
            if($action == 'other'){
                $where = [
                    ['description','!=' , 'created'],
                    ['description','!=' , 'updated'],
                    ['description','!=' , 'deleted'],
                ];
            }else{
                $where = [['description', '=' , $action]];
            }
            if($keyword){
                //Keyword跟action同時存在時且要查詢的資料內有兩種 title 與 name 需要用 orWhere 來串聯
                $logs = ActivityEloquent::where($where)
                        //由於沒有建立實際的Activity Model需使用此方式，不然可以將此function改到Model內來縮短
                        ->where(function($query){
                            $key = Session::pull('key');
                            $query->where('properties->attributes->title','like',"%$key%")
                                ->orWhere('properties->attributes->name','like',"%$key%");
                        })
                        ->orderBy('created_at','DESC')->paginate(10);
                //提供給View製作頁碼連結用
                $search = array('keyword' => $keyword,'action' => $action );
            }else{
                $logs = ActivityEloquent::where($where)->orderBy('created_at','DESC')->paginate(10);
                $search = array('action' => $action );
            }
        }elseif($keyword){
            //沒有action變數時，直接使用where及orWhere串接即可.
            $logs = ActivityEloquent::where('properties->attributes->title','like', "%$keyword%")
                    ->orWhere('properties->attributes->name','like', "%$keyword%")
                    ->orderBy('created_at','DESC')->paginate(10);
            $search = array('keyword' => $keyword);
        }else{
            $logs = ActivityEloquent::orderBy('created_at','DESC')->paginate(10);
        }
        //資料整理，實際上應該建立 Activity Model 將被紀錄的 table 及 相關管理者 table 全部綁在一起
        //這就不需要做這些變換及整理，有機會在來重寫
        foreach($logs as $log){
            //找出是管理者還是使用者
            $log->causer_type == 'App\Admin' ? $log->causer_type = 'admins' : $log->causer_type = 'users';
            $id = $log->causer_id;
            $causerData = DB::table($log->causer_type)->where('id','=',$id)->get();
            //將找出的name與email資料綁入$log中
            foreach ($causerData as $causer) {
                $log->name = $causer->name;
                $log->email = $causer->email;
            }
            //將json欄位資料轉成陣列，找出的資料標題或名字
            //這邊改變相關Models作完整紀錄。即使沒事按了儲存一樣會紀錄一筆
            $property = $log->properties->toArray();
            if($property){
                if(!empty($property['attributes'])){
                    if(!empty($property['attributes']['title'])){
                        $log->title = $property['attributes']['title'];
                    }elseif(!empty($property['attributes']['name'])){
                        $log->title = $property['attributes']['name'];
                    }else{
                        $log->subject_type == 'App\Post' ? $log->subject_type = 'posts' : '';
                        $log->subject_type == 'App\Park' ? $log->subject_type = 'parks' : '';
                        $sid = $log->subject_id;
                        if($log->subject_type){
                            $subjectData = DB::table($log->subject_type)->where('id','=',$sid)->get()->toArray();
                            if($subjectData){
                                foreach ($subjectData as $subject) {
                                    if(!empty($subject->title)){
                                        $log->title = $subject->title;
                                    }else{
                                        $log->title = $subject->name;
                                    }
                                }
                            }else{
                                $log->title = '該資料已被刪除不存在';
                            }
                        }
                    }
                }
            }
            $log->description == 'updated' ? $log->description = '修改' : '';
            $log->description == 'created' ? $log->description = '新增' : '';
            $log->description == 'deleted' ? $log->description = '刪除' : '';
            $log->url = route('admin.logs.show', $log->id);
        }
        // dd($logs);
        return View::make('admin.logs.index',compact('logs','keyword','action','search'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $log = ActivityEloquent::findOrFail($id);
        $log->causer_type == 'App\Admin' ? $log->causer_type = 'admins' : $log->causer_type = 'users';
        $id = $log->causer_id;
        $log->causer_name = '';
        $log->causer_email = '';
        if($id){
            $causerData = DB::table($log->causer_type)->where('id','=',$id)->get();
            foreach ($causerData as $causer) {
                $log->causer_name = $causer->name;
                $log->causer_email = $causer->email;
            }
        }
        $log->description == 'updated' ? $log->description = '修改' : '';
        $log->description == 'created' ? $log->description = '新增' : '';
        $log->description == 'deleted' ? $log->description = '刪除' : '';
        //將資料轉換成陣列方式
        $logArray = $log->toArray();
        //抽出原始資料與舊資料 (其實不需要多這道手續在view直接用foreach($logArray['properties']['attributes'])就可以將資料拋出)
        $attributes = $logArray['properties']['attributes'];
        !empty($logArray['properties']['old']) ? $oldAttributes = $logArray['properties']['old'] : $oldAttributes = '';
        // dd($logArray);
        return View::make('admin.logs.show',compact('log','logArray','attributes','oldAttributes'));
    }
}
