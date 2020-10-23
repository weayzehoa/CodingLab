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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    */
    public function showJson()
    {
        $parks = ParkEloquent::all();
        $jsonData = json_encode($parks,true);
        return view('parks.index',compact('jsonData'));
    }
    /*
        另開視窗，顯示Json資料
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
    */
    public function csv()
    {
        return Excel::download(new ParksExport, 'parks.csv');
    }
    /*
        下載 XLS 檔案
    */
    public function xls()
    {
        return Excel::download(new ParksExport, 'parks.xls');
    }
    /*
        下載 XLSX 檔案
    */
    public function xlsx()
    {
        return Excel::download(new ParksExport, 'parks.xlsx');
    }
    /*
        下載 ODS 檔案
    */
    public function ods()
    {
        return Excel::download(new ParksExport, 'parks.ods');
    }
    /*
        下載 XML 檔案
    */
    public function xml()
    {
        $parks = ParkEloquent::all();
        return view('parks.index',compact('parks'));
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
