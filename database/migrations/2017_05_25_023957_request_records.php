<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RequestRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_records', function (Blueprint $table) {

            // === 欄位 ===
            // [PK] 請求識別碼，資料意義為表頭名稱 X-Correlation-ID 的值
            $table->string('uuid', 36)->comment('請求識別碼，表頭名稱 X-Correlation-ID 的值');
            // 接收到的 Header 參數
            $table->string('method', '8')->comment('接收到的 Header 參數');
            // 請求所走的 route
            $table->string('route', 191)->comment('請求 Route Path');
            // 接收到的 Route 參數
            $table->text('route_params')->nullable()->comment('接收到的 Route 參數');
            // 接收到的 Header
            $table->text('request_headers')->nullable()->comment('接收到的 Header');
            // 接收到的 Request 參數
            $table->text('request_params')->comment('接收到的 Request 參數');
            // 對應請求所回應的 Header
            $table->text('response_headers')->nullable()->comment('對應請求所回應的 Header');
            // 對應請求所回應 code
            $table->string('response_code', 4)->comment('對應請求所回應 http code');
            // 對應請求所回應的內容
            $table->text('response_content')->nullable()->comment('對應請求所回應的內容');
            // 請求處理狀態：若為真表示請求已處理完成，不為真表示未完成
            // $table->boolean('job_status')->default(false)->comment('請求處理狀態：若為真表示請求已處理完成，不為真表示未完成');
            // 請求來源 ip
            $table->string('ip', 64)->comment('請求來源 ip');
            // 接收到 Request 的時間點
            $table->dateTime('created_at')->comment('Request 請求時間');
            // 主要用來識別寫入 Response 回應的時間
            $table->dateTime('updated_at')->comment('Response 回應時間');

            // [PK]
            $table->primary('uuid');

            // === 索引 ===
            $table->index('method');
            $table->index('response_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_records');
    }
}
