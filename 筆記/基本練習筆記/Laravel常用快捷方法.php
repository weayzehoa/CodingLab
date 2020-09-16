<?php
/*
    快捷方法
    Laravel框架中已經寫好並提供給大家使用的輔助方法，可以讓程式碼更好寫也更簡短
    在
    vendor\laravel\framwork\src\Illuminate\Fundation 目錄中
    找到 helpers.php 就可以看到所有的快捷方法
*/
/*
    Laravel常用快捷方法
*/
    action('HomeController@getIndex', $params); //用於產生控制行為網址，第一個參數為 [控制器名稱@方法] 第二個參數為要傳遞的 參數值
    asset('img/photo.jpg'); //根據請求協定產生資源檔位置
    route('home',$params);  //根據路由別名產生網址, 第一個參數是路由別名, 第二個參數則是傳遞參數值
    url($params); //產生該路由的完整網址，也可以是參數
    auth(); //回傳一個認證器實例，取代Auth facade , $user=auth()->user();
    back(); //產生一個重新導向回應，回到之前位置
    return redirect('/'); //回傳導向實例，進行重新導向
    retrun view('welcome'); //取得視圖實例
    env(); //回傳env環境檔中的變數或是預設值 'port' => env('MAIL_PORT',587);
