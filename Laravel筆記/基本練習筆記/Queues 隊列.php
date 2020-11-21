<?php
    /**
     *  Laravel Queues 隊列功能使用 database
     *
     *   參考來源:
     *  https://laravel.com/docs/6.x/queues#driver-prerequisites
     *  https://blog.mailtrap.io/laravel-mail-queue/
     *
     *  1. 建立 jobs 資料表
     *      php artisan queue:table
     *      php artisan migrate
     *  2. 修改 .env 將 QUEUE_CONNECTION=sync 改為 QUEUE_CONNECTION=database
     *  3. 建立 Mailable
     *      php artisan make:mail AdminSendEmailForQueuing
     *  4. 建立 Email Body
     *      這部分可以與其它的Email Body共用。
     *  5. 建立 Email 的 job class
     *      php artisan make:job AdminSendEmail
     *  6. 修改 Route
     *  7. 修改 Controller
     *  8. 修改 AdminSendEmail job
     */
