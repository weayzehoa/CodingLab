<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product as ProductEloquent;;
use App\User as UserEloquent;;
//使用記錄功能
// use Spatie\Activitylog\Traits\LogsActivity;

class ProductComment extends Model
{
    // use LogsActivity;

    protected $fillable = [
        'product_id', 'user_id', 'content',
    ];

    //要記錄的欄位 ['*'] 全部
    protected static $logAttributes = ['*'];
    //只記錄有改變的欄位
    protected static $logOnlyDirty = true;
    //將此模型命名在 activity 資料表的 log_name 欄位
    public function getLogNameToUse(string $eventName = ''): string
    {
        return '產品留言';
    }

    public function user(){
        return $this->belongsTo(UserEloquent::class);
    }

    public function product(){
        return $this->belongsTo(ProductEloquent::class);
    }
}
