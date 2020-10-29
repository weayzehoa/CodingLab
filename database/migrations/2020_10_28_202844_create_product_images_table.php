<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->comment('圖片標題');
            $table->string('description')->nullable()->comment('圖片描述');
            $table->string('filename')->comment('圖片名稱及副檔名');
            $table->string('filepath')->comment('圖片名稱及路徑');
            $table->string('ext')->nullable()->comment('副檔名');
            $table->string('size')->nullable()->comment('檔案大小');
            $table->unsignedInteger('product_id')->comment('產品代號');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_images');
    }
}
