<?php
/* Eloquent 關聯資料操作 遠層一對多 (一串肉粽)
遠層一對多是一種可以透過某一種一對多關係進而去拉入另一種多對伊關係的特殊關係
例如留言系統 User使用者貼了很多篇文章而每一篇文章中又有留言
如果想透過使用者來取得其發布的所有文章及所有留言,遠層一對多就派上用場

簡單說
Posts 資料表上有一個user_id欄位 來對應 users 資料表上的使用者
Comments 資料表上有一個post_id欄位 來對應 posts 資料表上的貼文

此時只要在 User Eloquent模型上定義以下關係:
*/

class User extends Model
{
    public function comments(){
        return $this->hasManyThrough(CommentEloquent::class,PostEloquent::class);
    }
}

/* 
    如此一來就可以從User資料直接透過遠層一對多來抓取留言
*/
    $comments = App\User::find(1)->comments;
/* 
    若要顯示所有留言資料
*/
    foreach ($comments as $comment) {
        $comment->content;
    }
/* 
    comments 對應就是資料表, Laravel 會將其解讀為
    SELECT * from user where users.id = 1 limit;
    SELECT comments.*, posts.user_id from comments INNER JOIN posts ON posts.id = comments.post_id where posts.user_id = 1;
*/
/* 
    如此一來可以取得關係，也可以自訂參數，如果把User當作主要模型, Post是中介模型, Comment是遠端模型則參數如下:

*/
class User extends Model
{
    public function comments(){
        return $this->hasManyThrough(
            // CommentEloquent::class,
            // PostEloquent::class
            'App\Comment', //遠端模型
            'App\Post', //中介模型
            'user_id', //遠端模型上的外來鍵
            'post_id', //主要模型上的外來鍵
            'id', //主要模型上的主鍵
            'id' //中介模型上的主鍵
        );
    }
}