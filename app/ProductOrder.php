<?php
/*
    產品與訂單的中繼資料表
*/
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order as OrderEloquent;
use App\Product as ProductEloquent;

class ProductOrder extends Model
{
    protected $fillable = [
        'product_id', 'order_id','price', 'qty'
    ];
    //與products資料表一對一關聯 (可以從訂單中找出對應的產品)
    public function product(){
        return $this->belongsTo(ProductEloquent::class);
    }
    //與orders資料表一對多關聯 (可以從產品中找出有哪些訂單)
    public function orders(){
        return $this->belongsToMany(OrderEloquent::class)
        ->withTimestamps()
        ->withPivot('price','qty');
    }
}
