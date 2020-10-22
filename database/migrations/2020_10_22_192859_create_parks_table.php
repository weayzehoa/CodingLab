<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable()->comment('公園名稱');
            $table->string('engname')->nullable()->comment('英文名稱');
            $table->text('overview')->nullable()->comment('概述');
            $table->char('lat', 20)->nullable()->comment('經度');
            $table->char('lon', 20)->nullable()->comment('經度');
            $table->string('dist')->nullable()->comment('行政區');
            $table->string('location')->nullable()->comment('位置');
            $table->char('type', 10)->nullable()->comment('類別');
            $table->integer('area')->nullable()->comment('面積');
            $table->string('unit')->nullable()->comment('管理單位');
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
        Schema::dropIfExists('parks');
    }
}
