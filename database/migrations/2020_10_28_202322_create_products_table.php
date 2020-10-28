<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('no')->comment('產品編號')->unique();
            $table->string('title')->comment('產品標題');
            $table->string('name')->comment('產品名稱');
            $table->text('description')->nullable()->comment('產品描述');
            $table->text('content')->nullable()->comment('產品內容');
            $table->integer('type')->unsigned()->comment('分類代號');
            $table->integer('defaultprice')->unsigned()->comment('原價');
            $table->integer('saleprice')->unsigned()->comment('賣價');
            $table->char('onlinedate', 20)->nullable()->comment('上線日期');
            $table->char('offlinedate', 20)->nullable()->comment('下線日期');
            $table->boolean('isshow')->default(0)->comment('上下線'); //0:No 1:Yes
            $table->boolean('istop')->default(0)->comment('置頂'); //0:No 1:Yes
            $table->float('sort',11,1)->default(9999)->comment('排序');
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
        Schema::dropIfExists('products');
    }
}
