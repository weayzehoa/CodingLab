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

    public function user(){
        return $this->belongsTo(UserEloquent::class);
    }

    public function post(){
        return $this->belongsTo(PostEloquent::class);
    }
}
