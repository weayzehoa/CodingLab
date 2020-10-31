<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product as ProductEloquent;
//使用記錄功能
use Spatie\Activitylog\Traits\LogsActivity;

class ProductPrice extends Model
{
    use LogsActivity;

    //可讓使用者新增編輯的欄位名稱
      protected $fillable = [
        'price', 'product_id'
    ];

    // //要記錄的欄位 ['*'] 全部
    protected static $logAttributes = ['*'];

    // //log_name 欄位資料
    protected static $logName = '產品價格';

    //建立產品價格與產品資料間的關聯
    public function product(){
        return $this->hasMany(ProductEloquent::class);
    }
}
