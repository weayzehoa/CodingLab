<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//首頁及搜尋，連接Home控制器路由
Route::get('/', 'HomeController@index')->name('index');
Route::get('home', 'HomeController@index')->name('home');
Route::get('search', 'HomeController@search')->name('search');
Route::get('aboutme', function () { return view('aboutme'); });
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

//台北市公園資訊
Route::prefix('parks')->name('parks.')->group(function(){
    Route::get('showJson', 'ParksController@showJson')->name('showJson');
    Route::post('Json', 'ParksController@Json')->name('Json');
    Route::get('openJson', 'ParksController@openJson')->name('openJson');
    Route::get('downJson', 'ParksController@downJson')->name('downJson');
    Route::get('csv', 'ParksController@csv')->name('csv');
    Route::get('xls', 'ParksController@xls')->name('xls');
    Route::get('xlsx', 'ParksController@xlsx')->name('xlsx');
    Route::get('ods', 'ParksController@ods')->name('ods');
    Route::get('xml', 'ParksController@xml')->name('xml');
    Route::get('cdb', 'ParksController@cdb')->name('cdb');
    Route::get('curl', 'ParksController@curl')->name('curl');
});
Route::resource('parks', 'ParksController', ['only' => ['index', 'show']]);

//Shopping購物
Route::resource('shopping', 'ShoppingController');

//購物車
Route::resource('cart','CartController');

//付款串接綠界測試帳號
Route::post('order/pay','OrderController@pay')->name('order.pay');
Route::post('order/paycallback','OrderController@paycallback');
Route::get('order/paysuccess','OrderController@paysuccess');

//訂單
Route::resource('order','OrderController');

//ProductOrder資料表控制器, 只使用update及destory
Route::resource('po','ProductOrderController');

//背景動畫測試
Route::get('wowbgtest', function () { return view('wowbgtest'); });
//JS Clock 測試
Route::get('clocktest', function () { return view('clocktest'); });
//OpenStreetMap
Route::get('openstreetmap', function () { return view('openstreetmap'); })->name('openstreetmap');
Route::get('googlemap', function () { return view('googlemap'); })->name('googlemap');

//圖形驗證碼刷新用 (使用套件內建路徑)
// Route::get('/captcha', 'HomeController@captcha')->name('captcha');

//使用預設的Auth所有路由
// Auth::routes();

//開啟驗證email方法
Auth::routes(['verify' => true]);

//文章內容及類型，對應resource控制器，PostTypes控制器不需要產生index方法，所以用except來排除
//主要利用 php artisan make:controller PostsController --resource 直接產生七大function
//然後排除掉 index 不使用, 這樣就不用寫一堆route
Route::resource('posts', 'PostsController');

//新增留言板用resource路由
//路由形式會是 posts/{post}/comments , 因為留言是隸屬post之下
Route::resource('posts.comments', 'PostCommentsController', ['only' => ['store', 'destroy']]);
Route::resource('posts/types', 'PostTypesController', ['except' => ['index']]);

// 處理顯示與上傳使用者頭像路由
// 加上 ->middleware('verified') 代表在進入這個 Route 之前使用者必須通過Email驗證
// 加上 ->middleware('password.confirm') 代表在進入這個 Route 之前先輸入密碼作驗證
Route::prefix('users')->name('users.')->group(function(){
    Route::get('profile', 'UsersController@profile')->middleware('verified')->name('profile');
    Route::post('profile', 'UsersController@updateProfile')->name('updateProfile');
    // Route::get('avatar', 'UsersController@showAvatar')->middleware('verified')->middleware('password.confirm')->name('showAvatar');
    Route::get('avatar', 'UsersController@showAvatar')->name('showAvatar');
    Route::post('avatar', 'UsersController@uploadAvatar')->name('uploadAvatar');
});

//訪客身分使用第三方登入路由，利用 {provider} 將所有的第三方登入共用同一個 redirect function
Route::prefix('login')->group(function(){
    Route::get('{provider}', 'Auth\SocialController@getSocialRedirect')->name('redirect');
    Route::get('{provider}/callback', 'Auth\SocialController@getSocialCallback')->name('callback');
});

//後台admin用的路由 網址看起來就像 https://localhost/{admin}/{名稱}
Route::prefix('admin')->name('admin.')->group(function() {
    //登入登出
    Route::get('login','Auth\AdminLoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\AdminLoginController@login')->name('login.submit');
    Route::get('logout', 'Auth\AdminLoginController@logout')->name('logout');
    Route::get('', 'Auth\AdminLoginController@showLoginForm');
    //圖形驗證碼刷新用
    Route::get('captcha', 'Auth\AdminLoginController@captcha')->name('captcha');
    //後台登入後資訊看板
    Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');

    //後台會員文章管理
    //放在 resource 之前較好，避免與 resource 的 get 衝突
    Route::get('mbposts/search','Admin\MemberPostsController@search');
    Route::get('mbposts/selectType','Admin\MemberPostsController@selectType');
    Route::post('mbposts/isshow/{id}','Admin\MemberPostsController@isshow');
    Route::post('mbposts/istop/{id}','Admin\MemberPostsController@istop');
    Route::get('mbposts/sortup/{id}','Admin\MemberPostsController@sortup');
    Route::get('mbposts/sortdown/{id}','Admin\MemberPostsController@sortdown');
    Route::resource('mbposts', 'Admin\MemberPostsController');
    Route::resource('comments', 'Admin\CommentsController');

    //後台管理員寄信功能
    Route::get('mails/sendmail','Admin\MailsController@adminSendMailForm');
    Route::post('mails/sendmail','Admin\MailsController@sendmail')->name('sendmail');
    // Route::resource('mails', 'Admin\MailsController');

    // Route::get('/news', function () { return view('admin.news'); });
    // Route::get('/marquees', function () { return view('admin.marquees'); });
    // Route::get('/carousels', function () { return view('admin.carousels'); });
    // Route::get('/admins', function () { return view('admin.admins'); });
    // Route::get('/mails', function () { return view('admin.mails'); });
    Route::get('/products', function () { return view('admin.products'); });

    //後台會員管理
    Route::post('members/active/{id}', 'Admin\UsersController@active');
    Route::get('members/search', 'Admin\UsersController@search');
    Route::resource('members', 'Admin\UsersController');

    //後台維護紀錄功能，Controller 雖然用resource但限定只有 index與show function,
    //限定部分也可以寫在 controller 的建構式中用 middleware 來限定.
    Route::resource('logs', 'Admin\LogsController', ['only' => ['index','show']]);
}) ;

// Route::get('/', function () {
//     return view('welcome');
// });

//測試用
// Route::get('test', function () { return view('test'); });
