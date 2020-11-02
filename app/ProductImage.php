<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//使用產品資料資料表
use App\Product as ProductEloquent;

//使用記錄功能
// use Spatie\Activitylog\Traits\LogsActivity;

class ProductImage extends Model
{
    // use LogsActivity;

    //可讓使用者新增編輯的欄位名稱
      protected $fillable = [
        'title', 'description', 'filename', 'filepath', 'ext', 'size','product_id'
    ];

    // //要記錄的欄位 ['*'] 全部
    protected static $logAttributes = ['*'];

    // //log_name 欄位資料
    protected static $logName = '產品圖片';

    public function product(){
        return $this->belongsTo(ProductEloquent::class);
    }
}
