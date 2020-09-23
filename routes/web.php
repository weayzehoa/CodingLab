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

// Route::get('/', function () {
//     return view('welcome');
// });


//首頁及搜尋，連接Home控制器路由
Route::get('/', 'HomeController@index')->name('index');
Route::get('search', 'HomeController@search')->name('search');
//圖形驗證碼刷新用
// Route::get('/captcha', 'HomeController@captcha')->name('captcha');

//AdminLTE 參考樣板
Route::prefix('AdminLTE')->group(function() {
    Route::get('{name}', 'HomeController@AdminLTE');
});

//使用預設的Auth所有路由
Auth::routes();

//文章內容及類型，對應resource控制器，PostTypes控制器不需要產生index方法，所以用except來排除
//主要利用 php artisan make:controller PostsController --resource 直接產生七大function
//然後排除掉 index 不使用, 這樣就不用寫一堆route
Route::resource('posts', 'PostsController');
Route::resource('posts/types', 'PostTypesController', ['except' => ['index']]);

//新增留言板用resource路由
//路由形式會是 posts/{post}/comments , 因為留言是隸屬post之下
Route::resource('posts.comments', 'PostCommentsController', ['only' => ['store', 'destroy']]);

// //處理顯示與上傳使用者頭像路由
Route::prefix('users')->name('users.')->group(function(){
    Route::get('avatar', 'UsersController@showAvatar')->name('showAvatar');
    Route::post('avatar', 'UsersController@uploadAvatar')->name('uploadAvatar');
});

// //訪客身分使用第三方登入路由
Route::prefix('login/social')->name('social.')->group(function(){
    Route::get('{provider}/redirect', 'Auth\SocialController@getSocialRedirect')->name('redirect');
    Route::get('{provider}/callback', 'Auth\SocialController@getSocialCallback')->name('callback');
});

//後台admin用的路由 網址看起來就像 https://localhost/{admin}/{名稱}
Route::prefix('admin')->group(function() {
    //登入登出
    Route::get('/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/', 'Auth\AdminLoginController@showLoginForm')->name('admin');
    Route::get('/captcha', 'Auth\AdminLoginController@captcha')->name('admin.captcha');
    //後台用
    Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
    Route::resource('/posts', 'Admin\PostsController');
    Route::get('/news', function () { return view('admin.news'); });
    Route::get('/marquees', function () { return view('admin.marquees'); });
    Route::get('/carousels', function () { return view('admin.carousels'); });
    Route::get('/members', function () { return view('admin.members'); });
    Route::get('/admins', function () { return view('admin.admins'); });
    Route::get('/mails', function () { return view('admin.mails'); });
    Route::get('/logs', function () { return view('admin.logs'); });
    Route::get('/aboutme', function () { return view('admin.aboutme'); });
}) ;
