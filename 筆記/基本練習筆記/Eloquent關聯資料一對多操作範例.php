<?php
/* Eloquent 關聯資料操作 一對多
一對多是資料庫中最常見的關係,例如留言系統 User使用者貼了一篇文章而又有該文章留言
*/
class Post extends Model
{
    public function comments(){
        return $this->hasMany(CommentEloquent::class);
    }
}
/* 
    如此一來就可以抓取文章所對應的留言
*/
    $comments = App\Post::find(1)->comments;
/* 
    若要顯示所有留言資料
*/
    foreach ($comments as $comment) {
        $comment->content;
    }
/* 
    comments 對應就是資料表, Laravel 會將其解讀為
    SELECT * from post where post.id = 1 limit 1;
    SELECT * from comments where comments.post_id = 1 and comments.post_id is no null;
*/
/* 
    因為使用 hasMany()就算該貼文只有一篇留言但回傳結果是Eloquent的Collection型態並
    不是模型實例，所以不能直接存取欄位，一定要使用first()、find()等查詢方法如下:
*/
    App\Post::find(1)->comments()->first()->content;
/* 
    上述方法與hasOne相同，要設計反向關係時在comments的Eloquent中建立
*/
class Comment extends Model
{
    public function post(){
        return $this->belongsTo(CommentEloquent::class);
    }
}
/* 
    由於貼文留言是留言完全跟隨Post資料表故在設計comments的
    migration時，post_id必須不可以為null
    其存取方法可以直接使用如下
*/
    $comment = App\Comment::find(1);
    echo $comment->post->title;
/* 
    相當於
    SELECT * from comments where comments.id = 1 limit 1;
    SELECT * from posts where post.id = 1 limit 1;
*/

/* 
    建立關係最大的好處就是除了利用關係來取得之外，也可以利用建立好的關係來當作查詢生產器之一
    例如下方兩種程式碼
*/
    App\Post::find(1)->comments->first()->id;
    App\Post::find(1)->comments()->first()->id;
/* 
    以上兩行結果是相同差別在於第一行使用comments回傳模型集合，從中找到第一個資料並取得其編號
    下面那行則是透過 comments()這個查詢生產器找尋擁有 post_id欄位且欄位為1的comment資料
    可以利用它來串聯不同的查詢方法.
*/
    App\Post::find(1)->comments()->where('status','vip')->get();
/* 
    以上語法Laravel解析為
    SELECT * from posts where posts.id = 1 limit 1;
    SELECT * from comments where comments.post_id = 1 AND comments.post_id is not null AND status = 'vip';
*/
/* 
    也可以使用 has() 來選出符合特定規則的資料
*/
    $post = App\Post::has('comments')->get();
    $post = App\Post::has('comments','>=','5')->get();