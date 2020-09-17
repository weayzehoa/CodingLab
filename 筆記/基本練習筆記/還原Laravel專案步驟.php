<?php
/*
    還原 Laravel 專案步驟
*/
/*
    1. 還原核心目錄
        composer install
    2. 還原node_modules目錄，電腦需安裝 node.js 及 npm，確定有安裝後 則可選擇執行 npm install 還原 目錄
        npm install
    3. 建置.env 環境變數
        cp .env.example .env
    4. 產生 APP_KEY
        php artisan key:generate
    5. 設定 .env 還原資料庫
        php artisan migrate
        php artisan db:seed

    大功告成.
*/
