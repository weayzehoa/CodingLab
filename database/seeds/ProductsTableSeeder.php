<?php

use Illuminate\Database\Seeder;

use App\Product as ProductEloquent;
use App\ProductType as ProductTypeEloquent;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //在product_type資料表建立5筆
        $productTypes = factory(ProductTypeEloquent::class, 5)->create();
        //在products資料表建立50筆, 且用each方法一個一個處理
        //並用 use 帶入 $productTypes 上面的5筆其中一筆.
        $i = 1;
        $products = factory(ProductEloquent::class, 50)->create()->each(function($product) use ($productTypes){
            $product->type = $productTypes[mt_rand(0, (count($productTypes)-1))]->id;
            $product->save();
        });
    }
}
