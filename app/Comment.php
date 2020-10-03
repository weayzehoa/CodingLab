<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//別忘記這兩行，與 User 跟 Post 有關聯需要引用
use App\User as UserEloquent;
use App\Post as PostEloquent;

class Comment extends Model
{
    protected $fillable = [
        'post_id', 'user_id', 'content',
    ];

    //要記錄的欄位 ['*'] 全部
    protected static $logAttributes = ['*'];
    //只記錄有改變的欄位
    protected static $logOnlyDirty = true;
    //將此模型命名在 activity 資料表的 log_name 欄位
    public function getLogNameToUse(string $eventName = ''): string
    {
        return '文章留言';
    }

    public function user(){
        return $this->belongsTo(UserEloquent::class);
    }

    public function post(){
        return $this->belongsTo(PostEloquent::class);
    }
}
