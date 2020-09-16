<?php

use Illuminate\Support\Facades\Route;

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
//get('路徑','控制器檔案名稱@程式名稱)
Route::get('/', 'HomeController@index');

Route::pattern('student_no', 's[0-9]{10}');
Route::group(['prefix' => 'students'], function(){
	Route::get('{student_no}', [
		'as' => 'students',
		'uses' => 'StudentsController@getStudentData'
	]);

	Route::get('{student_no}/score/{subject?}', [
		'as' => 'students.score',
		'uses' => 'StudentsController@getStudentScore'
	])->where(['subject' => '(chinese|english|math)']);
});

Route::prefix('board')->group(function(){
    Route::get('/', 'BoardController@getIndex')->name('board.index');
    Route::get('/name', 'BoardController@getName')->name('board.name');
});

Route::group(['namespace' => 'Cool'], function(){
	Route::get('cool', 'TestController@index');
});

Route::get('edit/{student_no}', 'SchoolController@edit');
Route::post('edit/{student_no}', 'SchoolController@update');

/*
|--------------------------------------------------------------------------
| 下方為練習範本
|--------------------------------------------------------------------------
*/
// //使用 php artisan make:controller PhotosController --resource 直接建立出七大路由控制器
// //新增、瀏覽、編輯、刪除及前三者分割成兩個動作(索引,儲存)
// //index, create, show, edit, update, store, delete
// //等同於 下面七個 Route
// // Route::get('photos','PhotosController@index'); //顯示所有
// // Route::get('photos/create','PhotosController@create'); //建立
// // Route::post('photos','PhotosController@store'); //儲存
// // Route::get('photos/{photo}','PhotosController@show'); //顯示單個
// // Route::get('photos/{photo}/edit','PhotosController@edit'); //編輯
// // Route::put/patch('photos/{photo}','PhotosController@update'); //更新
// // Route::delete('photos','PhotosController@destroy'); //刪除
// Route::resource('photos','PhotosController');

// //pattern('變數','比對參數,使用正則規範{5}為數量');
// Route::pattern('student_no', 's[0-9]{5}');

// //條件
// //where(['變數名稱' => '(chinese|english|math)']);
// Route::group(['prefix' => 'students'], function(){
//     Route::get('{student_no}', [
//         'as' => 'students',
//         'uses' => 'StudentsController@getStudentData'
//     ]);

//     Route::get('{student_no}/score/{subject?}', [
//         'as' => 'students.score',
//         'uses' => 'StudentsController@getStudentScore'
//     ])->where(['subject' => '(chinese|english|math)']);
// });

//使用 php artison make:controller Cool\TestController 建立一個控制器在app\Http\Cool目錄下
// Route::get('cool','Cool\TestController@index');

// 透過設定群組的namespace屬性統一調整群組中所使用的的命名空間.
// 注意 Route::get('cool','TestController@index'); 沒有目錄名稱
// Route::group(['namespace' => 'Cool'], function(){
//     Route::get('cool','TestController@index');
// });

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('admin/', function () {
//     return view('admin/login');
// });

// Route::get('test/', function () {
//     return view('test/welcome');
// });
// Route::get('test/', function () {
//     return view('test/welcome');
// });
// Route::get('test/{no}/', function ($no) {
//     return '編號:' . $no;
// });

// Route::get('test/{no}/score', function ($no) {
//     return '編號: ' . $no . ' 的所有成績';
// });

// Route::get('test/{no}/score/{subject}', function ($no, $subject) {
//     return '編號: ' . $no . ' 的 ' . $subject . ' 所有成績';
// });

//選擇性路由
// Route::get('test/{no}/score/{subject?}',
// function ($no, $subject = null) {
//     return '編號: ' . $no . ' 的 ' . ( is_null ($subject) ? '所有科目' : $subject) . ' 成績';
// });

//參數格式設定, 限制參數範圍s字串[0-9]數字{5}5個數字才會顯示
// Route::get('test/{no}', function ($no) {
//     return '編號:' . $no;
// })->where(['no' => 's[0-9]{5}']);

// Route::get('test/{no}/score/{subject?}',
// function ($no, $subject = null) {
//     return '編號: ' . $no . ' 的 ' . ( is_null ($subject) ? '所有科目' : $subject) . ' 成績';
// })->where(['subject' => '(chinese|english|math)']);

//路由群組
// Route::pattern('no','s[0-9]{5}');
// Route::group(['prefix'=>'test'], function(){
//     Route::get('{no}', function($no){
//         return '編號: '. $no ;
//     });
//     Route::get('{no}/score/{subject?}', function($no,$subject=null){
//         return '編號: ' . $no . ' 的 ' . ( is_null ($subject) ? '所有科目' : $subject) . ' 成績';
//     })->where(['subject' => '(chinese|english|math)']);
// });

//路由群組另一種寫法
// Route::pattern('no','s[0-9]{5}');
// Route::prefix('test')->group(function(){
//     Route::get('{no}', function($no){
//         return '編號: '. $no ;
//     });
//     Route::get('{no}/score/{subject?}', function($no,$subject=null){
//         return '編號: ' . $no . ' 的 ' . ( is_null ($subject) ? '所有科目' : $subject) . ' 成績';
//     })->where(['subject' => '(chinese|english|math)']);
// });

//路由命名
//替路由建立識別名稱, as, uses 特定字
// Route::pattern('no','s[0-9]{5}');
// Route::group(['prefix'=>'test'], function(){
//     Route::get('{no}', [
//         'as' => 'test',
//         'uses' => function($no){
//             return '編號: '. $no ;
//         }
//     ]);
//     Route::get('{no}/score/{subject?}', [
//         'as' => 'test.score',
//         'uses' => function($no,$subject=null){
//             return '編號: ' . $no . ' 的 ' . (is_null($subject) ? '所有科目' : $subject) . ' 成績';
//         }
//     ])->where(['subject' => '(chinese|english|math)']);
// });
//路由命名 縮短
//替路由建立識別名稱, as, uses 特定字
// Route::pattern('no','s[0-9]{5}');
// Route::group(['as'=>'test.','prefix'=>'test'], function(){
//     Route::group(['as'=>'score.','prefix'=>'score'], function(){
//         Route::pattern('no','s[0-9]{5}');
//         Route::get('{no}', function($no){
//             return '編號: '. $no ;
//         });
//         Route::get('{no}/{subject?}', function($no,$subject){
//             return '編號: ' . $no . ' 的 ' . $subject . ' 成績';
//         })->where(['subject' => '(chinese|english|math)']);
    
//         Route::get('{no}/{subject?}/score/', function($no,$subject=null){
//             $subject == 'chinese' ? $score = '92' : '';
//             $subject == 'english' ? $score = '95' : '';
//             $subject == 'math' ? $score = '90' : '';
//             return '編號: ' . $no . ' 的 ' . $subject . ' 成績 '. $score;
//         })->where(['subject' => '(chinese|english|math)']);
//     });
// });
