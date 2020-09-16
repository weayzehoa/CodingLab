<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('姓名');
            $table->string('email')->unique()->comment('電子郵件');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->comment('密碼');
            $table->string('avatar')->nullable()->comment('頭像'); //頭像功能,可為空值
            $table->integer('type')->unsigned()->default(0)->comment('類型'); //身分判別 0 為一般使用者
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
        Schema::dropIfExists('users');
    }
}
