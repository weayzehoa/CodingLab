<?php

use Illuminate\Database\Seeder;

use App\Product as ProductEloquent;
use App\ProductType as ProductTypeEloquent;
use App\ProductImage as ProductImageEloquent;
use App\ProductComment as ProductCommentEloquent;
use App\ProductPrice as ProductPriceEloquent;

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
        $products = factory(ProductEloquent::class, 50)->create()->each(function($product) use ($productTypes){
            $product->type = $productTypes[mt_rand(0, (count($productTypes)-1))]->id;
            $product->save();
        });

        //產品圖片
        // $productImages = factory(ProductImageEloquent::class, 500)->create();

        //留言資料
        $comments = factory(ProductCommentEloquent::class, 300)->create();

        //產品價格
        foreach ($products as $product) {
            $productId = $product->id;

            //產品圖片(每個產品5張圖片) 在create()中帶入要複寫的欄位資料
            factory(ProductImageEloquent::class, 5)->create(['product_id' => $productId]);

            //產品價格
            ProductPriceEloquent::create([
                 'price'        => mt_rand(50, 90),
                 'product_id'   => $product->id,
             ]);
        }

        //產品圖片
    }
}
