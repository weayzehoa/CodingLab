<?php
/*
    日誌、維護與錯誤處理
    Laravel日誌工具是基於monolog/monolog函式庫所提供功能
    可以發送所有的debug訊息到系統日誌中或發送錯誤訊息到slack中(團隊通訊平台)
    Laravel預設頻道為slack，若要設定其他頻道可以透過
    Config\loggin.php 做設定
    將所有return陣列中修改名為default的鍵值，或者直接修改.env檔案中的LOG_CHANNEL參數
*/
/*
    頻道驅動共有七種
    stack       聚合多個log頻道到單個頻道
    single      產生單個日誌檔存放於目標目錄
    daily       產生每日日誌檔存放於目標目錄
    slack       送到slack平台，該頻道必須要有與你在Slack配置上匹配的incoming webhook一樣的url
    monolog     使用任何受Monolog驅動支持的模式
    syslog      記錄到系統紀錄中
    errorlog    記錄存於網頁伺服器紀錄檔 (ex: appache的error.log)
*/
/*
    日誌共有八種定義，在RFC 5424系統紀錄協定中
*/
    Log::emergency($message);   //緊急  0   系統異常
    Log::alert('message');      //警報  1   須立刻處理修正的錯誤
    Log::critical('message');   //嚴重  2   危急狀況
    Log::error('message');      //錯誤  3   錯誤狀況
    Log::warning('message');    //警告  4   若不採取行動可能導致錯誤
    Log::notice($message);      //通知  5   事件異常但非錯誤狀況
    Log::info('message');       //訊息  6   正常執行訊息不用採取行動
    Log::debug('message');      //除錯  7   開發人員測試調整應用程式有用的訊息

/*
    維護模式
    當系統正式上線時，若有需要做更新時，可以轉為維護模式暫時下線。
    透過 php artisan down 來將網站轉為維護模式.
    維護模式中，所有請求都將回傳 503 的 HTTP 代碼，瀏覽器將會以
    resources\view\errors目錄下的 503.blade.php 作為回傳視圖。
    再次透過 php artisan up 可以將網站轉回正常模式
*/
/*
    自訂義錯誤頁面
    對於 HTTP 錯誤代碼，Laravel預設自動回傳代碼所對應的視圖.
    放於resources\view\errors目錄下.

    Laravel預設是沒有該目錄，可以使用下面指令來將所有錯誤介面產生出來並修改之
    //7.x使用
    php artisan vendor:publish --tag=laravel-errors
*/
