<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User as UserEloquent;
use App\ProductOrder as ProductOrderEloquent;
//使用記錄功能
use Spatie\Activitylog\Traits\LogsActivity;
//使用軟刪除功能
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use LogsActivity;

    // //要記錄的欄位 ['*'] 全部
    protected static $logAttributes = ['*'];

    // //log_name 欄位資料
    protected static $logName = '訂單資料';

    protected $fillable = [
        'user_id', 'payMethod','total', 'status'
    ];

    //使用軟刪除
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    //與users資料表一對一關聯 (從訂單中找出購買者)
    public function user(){
        return $this->belongsTo(UserEloquent::class);
    }
    //與product_orders資料表一對多關聯 (從中繼表中找出相關產品資料)
    public function productOrders(){
        return $this->hasMany(ProductOrderEloquent::class);
    }
}
