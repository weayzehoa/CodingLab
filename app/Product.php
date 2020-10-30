<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//關聯產品圖片資料表
use App\productImage as ProductImageEloquent;
//關聯產品類別資料表
use App\productType as ProductTypeEloquent;
//關聯產品類別資料表
use App\productComment as ProductCommentEloquent;
//使用記錄功能
use Spatie\Activitylog\Traits\LogsActivity;

class Product extends Model
{
    use LogsActivity;

    //可讓使用者新增編輯的欄位名稱
  	protected $fillable = [
        'no', 'title', 'name', 'description', 'content', 'type', 'defaultprice', 'saleprice',
        'onlinedate', 'offlinedate', 'isshow', 'istop', 'sort'
	];

    // //要記錄的欄位 ['*'] 全部
    protected static $logAttributes = ['*'];

    // //log_name 欄位資料
    protected static $logName = '產品資料';

    //與product_images資料表一對多關聯
	public function productImage(){
		return $this->hasMany(ProductImageEloquent::class);
	}
    //type欄位與product_types資料表一對一關聯
	public function productType(){
		return $this->belongsTo(ProductTypeEloquent::class, 'type');
    }
    //關聯productComments
    public function productComment(){
        return $this->hasMany(ProductCommentEloquent::class);
    }
}
