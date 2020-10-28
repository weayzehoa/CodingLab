<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product as ProductEloquent;
use App\PostType as ProductTypeEloquent;

class ProductType extends Model
{
    //資料表名稱
    protected $table = 'product_types';

    //可新增編輯欄位
    protected $fillable = [
        'title'
    ];

    //不使用時間戳記
    public $timestamps = false;

    //建立產品類型與產品資料間的關聯
    public function products(){
        return $this->hasMany(ProductEloquent::class, 'type');
    }
}
