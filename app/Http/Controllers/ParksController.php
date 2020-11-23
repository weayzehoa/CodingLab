<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Park as ParkEloquent;
use Redirect;
use View;
use DB;
use File;
use Response;
use Ixudra\Curl\Facades\Curl;
use App\Exports\ParksExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Redis;
use PDF;
class ParksController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parks = ParkEloquent::all();
        return view('parks.index',compact('parks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $getParks = Redis::get('parks');
        if($getParks){
            $parks = json_decode($getParks);
            foreach($parks as $park){
                if($park->id == $id){
                    $response = $park;
                }
            }
        }else{
            $parks = ParkEloquent::all();
            Redis::set('parks', $parks);
            foreach($parks as $park){
                if($park->id == $id){
                    $response = $park;
                }
            }
        }
        $park = $response;
        return view('parks.show',compact('park'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /*
        顯示Json資料
        使用原生方式將資料編碼成json格式
    */
    public function showJson()
    {
        $parks = ParkEloquent::all();
        $jsonData = json_encode($parks,true);
        return view('parks.index',compact('jsonData'));
    }
    /*
        另開視窗，顯示Json資料
        使用response將資料編碼成json格式
    */
    public function openJson()
    {
        $parks = ParkEloquent::all();
        return response()
        ->json($parks)
        ->header('Content-Type','application/json; charset=utf-8');
    }
    /*
        下載Json檔案
        使用原生方式將資料編碼成json格式並將檔案儲存後提供下載，下載完成直接刪除該檔案
    */
    public function downJson()
    {
        $parks = ParkEloquent::all();
        $jsonData = json_encode($parks,true);
        $fileName='臺北市公園基本資料.json';
        $destPath = 'upload';
        if(!file_exists(public_path() . '/' . $destPath)){
            File::makeDirectory(public_path() . '/' . $destPath, 0755, true);
        }
        File::put(public_path('/upload/'.$fileName),$jsonData);
        return response()->download(public_path('/upload/'.$fileName))->deleteFileAfterSend();
    }
    /*
        下載 CSV 檔案
        使用laravel/excel - 匯入匯出 試算表 套件拋出csv檔案
    */
    public function csv()
    {
        $fileName='臺北市公園基本資料.csv';
        return Excel::download(new ParksExport, $fileName);
    }
    /*
        下載 XLS 檔案
        使用laravel/excel - 匯入匯出 試算表 套件拋出xls檔案
    */
    public function xls()
    {
        $fileName='臺北市公園基本資料.xls';
        return Excel::download(new ParksExport, $fileName);
    }
    /*
        下載 XLSX 檔案
        使用laravel/excel - 匯入匯出 試算表 套件拋出xlsx檔案
    */
    public function xlsx()
    {
        $fileName='臺北市公園基本資料.xlsx';
        return Excel::download(new ParksExport, $fileName);
    }
    /*
        下載 ODS 檔案
        使用laravel/excel - 匯入匯出 試算表 套件拋出ods檔案
    */
    public function ods()
    {
        $fileName='臺北市公園基本資料.ods';
        return Excel::download(new ParksExport, $fileName);
    }
    /*
        下載 XML 檔案
        使用 bmatovu/laravel-xml (v1.0 for Laravel6)- 匯入匯出 XML 套件，儲存後拋出xml檔案，並刪除該檔案
    */
    public function xml()
    {
        $parks = ParkEloquent::all();
        $xml = response()->xml(['parks' => $parks->toArray()]);
        $fileName='臺北市公園基本資料.xml';
        $destPath = 'upload';
        if(!file_exists(public_path() . '/' . $destPath)){
            File::makeDirectory(public_path() . '/' . $destPath, 0755, true);
        }
        File::put(public_path('/upload/'.$fileName),$xml);
        return response()->download(public_path('/upload/'.$fileName))->deleteFileAfterSend();
    }

    /*
        下載 PDF 檔案
        使用 barryvdh/laravel-dompdf - 匯入匯出 PDF 套件
    */
    public function pdf()
    {
        // 取出資料
        // $parks = ParkEloquent::all();
        $parks = ParkEloquent::paginate(50);
        //設定為橫式, 使用 wt011 字型
        $pdf = PDF::loadView('parks.pdf_view', compact('parks'))
                    ->setPaper('A4', 'landscape')
                    ->setOptions(['defaultFont' => 'wt011']);
        //將資料拋出直接下載
        return $pdf->download('臺北市公園基本資料.pdf');
    }

    /*
        台北市公園資訊跨資料庫測試
        use DB;
    */
    public function cdb()
    {
        $parks = DB::connection('parktaipei')->table('parkmanagement')->get();
        return view('parks.cdb',compact('parks'));
    }
    /*
        台北市公園資訊Curl測試2
        use Ixudra\Curl\Facades\Curl;
    */
    public function curl()
    {
        $jsonString = Curl::to('https://parks.taipei/parks/api/')->get();
        $parks2 = json_decode($jsonString);
        return view('parks.curl',compact('parks2'));
    }
}
