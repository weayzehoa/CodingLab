<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//關聯使用者
use App\User as UserEloquent;
use App\ProductPrice as ProductPriceEloquent;

//使用記錄功能
// use Spatie\Activitylog\Traits\LogsActivity;

class Cart extends Model
{
    // use LogsActivity;

    protected $fillable = [
        'user_id', 'product_price_id','qty',
    ];

    protected static $logAttributes = ['*'];
    protected static $logName = '購物車';

    //與users資料表一對一關聯
    public function user(){
        return $this->belongsTo(UserEloquent::class);
    }

    //與product_prices資料表一對一關聯
    public function productPrice(){
        return $this->belongsTo(ProductPriceEloquent::class);
    }
}
