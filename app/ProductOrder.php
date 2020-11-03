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
    //與products資料表多對多關聯 (可以從訂單中找出哪些產品)
    public function products(){
        return $this->belongsToMany(ProductOrderEloquent::class)
        ->withTimestamps()
        ->withPivot('price','qty');
    }
    //與orders資料表一對多關聯 (可以從產品中找出有哪些訂單)
    public function orders(){
        return $this->belongsToMany(ProductOrderEloquent::class)
        ->withTimestamps()
        ->withPivot('price','qty');
    }
}
