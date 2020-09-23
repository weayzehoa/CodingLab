<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('文章標題');
            $table->integer('type')->unsigned()->nullable()->comment('分類代號');
            $table->text('content')->nullable()->comment('文章內容');
            $table->unsignedInteger('user_id')->comment('會員id');
            $table->integer('approved')->default(0)->comment('審核狀態'); //0:Pendding 1:Approved 2:Denied
            $table->char('onlinedate', 20)->nullable()->comment('上線日期');
            $table->char('offlinedate', 20)->nullable()->comment('下線日期');
            $table->boolean('isshow')->default(0)->comment('上下線'); //0:No 1:Yes
            $table->boolean('istop')->default(0)->comment('置頂'); //0:No 1:Yes
            $table->float('sort')->default(99999)->comment('排序');
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
        Schema::dropIfExists('posts');
    }
}
