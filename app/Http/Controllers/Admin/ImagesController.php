<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use View;
use Redirect;
use File;
use Carbon\Carbon;
use Mail;
use Session;
use Storage;

use App\Http\Requests\Admin\ImageUploadRequest;

class ImagesController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    /**
     * Display the Mail Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function imagesUploadForm()
    {
        return view('admin.images.imagesUploadForm');
    }

    /**
     * 將檔案傳送到 AWS S3 Storage
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     */

    public function imagesUpload(ImageUploadRequest $request)
    {
        // 檢查確認是否可以連線AWS S3
        // $s3 = Storage::cloud();
        // dd($s3);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $destPath = 'upload/images';

            //檢查目錄是否存在，不存在則建立
             if(!Storage::disk('s3')->has($destPath)){
                Storage::disk('s3')->makeDirectory($destPath);
            }

            //抓取原始副檔名
            $ext = $file->getClientOriginalExtension();

            //檔案名稱修改成目前時間標記加上副檔名
            $fileName = (Carbon::now()->timestamp) . '.' . $ext;

            //將檔案傳送至 S3
            //加上 public 讓檔案是 Visibility 不然該檔案是無法被看見的
            Storage::disk('s3')->put("$destPath/$fileName", file_get_contents($file) , 'public');

            //獲取 S3 圖片連結
            $url = Storage::disk('s3')->url("$destPath/$fileName");
        }

        $message = "檔案上傳成功";
        Session::put('success',$message);

        return view('admin.images.imagesUploadForm', compact('url'));
    }
}
