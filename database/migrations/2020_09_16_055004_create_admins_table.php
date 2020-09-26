<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('姓名');
            $table->string('email')->unique()->comment('電子郵件');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->comment('密碼');
            $table->string('access')->nullable()->comment('選單權限');
            $table->string('tel')->nullable()->comment('電話');
            $table->string('address')->nullable()->comment('地址');
            $table->string('avatar')->nullable(); //頭像功能,可為空值
            $table->boolean('right')->unsigned()->default(0)->comment('唯讀'); //1 為完整控制, 0 唯讀
            $table->boolean('active')->unsigned()->default(1)->comment('啟用');; //1 為啟用 0 為停用
            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
}
