<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(){
        return view('welcome');
    }
}

/* //Eloquent 關聯資料操作 一對一
當在一份資料表中需要呼叫另外一份資料表時,也就是得把另一個Eloquent定義成一個方法呼叫使用
例如: 取得學號是s1234567890的學生名稱.
App\Student 就是呼叫 Student 資料表的方式
where('欄位名稱','條件值')
first()取第一筆
user->name 對應欄位資料 資料.
*/
    App\Student::where('no', 's1234567890')->first()->user->name;
/* 
    上述語法對應到 app\User.php 中的 function
*/
    public function student(){
        //使用者對應到學生,這邊關聯就是使用者有一個學生
        return $this->hasOne(StudentEloquent::class);
    }
/* 
    如此一來就可以從下面程式碼呼叫對應的學生關係
*/
    $student = App\User::find(1)->student;
    /* 
    Laravel 會把以上程式碼解析為以下兩行SQL語法
    SELECT * from users Where users.id = 1 limit 1;
    SELECT * from students Where students.user_id = 1 and student.user_id is not null limit 1;
    */
/* 
    如果要取得學號屬性
*/
    $student_no = App\User::find(1)->student->no;
    /* 
    return $this->hasOne(StudentEloquent::class);
    以上並未直接使用
    return $this->hasOne(StudentEloquent::class,'user_id');
    主要是因為資料表中
    user_id是Laravel預設透過外來鍵(Foreign Key)然後根據這個欄位對應user資料表的主鍵 primary key
    而Laravel預設將 關聯方資料表單數名稱_關聯方資料表主鍵名稱 作為外來鍵名稱,
    若在user資料表將外來鍵修改成 own_id 則程式碼需手動加入如下
    return $this->hasOne(StudentEloquent::class,'own_id');
    */
/* 
    相反的 我們可以利用 Student 資料表反過來抓取 User 的資料
    只要在 Student Eloquent (app\Student.php) 加上以下程式碼:
*/
    public function user(){
        return $this->belongsTo(UserEloquent::class);
    }
    /* 
    如此一來就可以透過Sutdent來得取User資料
    */
    $user = App\Student::find(1)->user;
    /* 
    Laravel 會把以上程式碼解析為以下兩行SQL語法
    SELECT * from students Where student.id = 1 limit 1;
    SELECT * from users Where users.id = 1 limit 1;
    */

/* 
以上方是以user使用者為中心將student學生串聯起來.
在兩個Eloquent中userEloquent使用hasOne而studentEloquent則使用belongsTo
*/