<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//別忘記這行務必要寫, 關聯使用 Post 模型
use App\Post as PostEloquent;
use App\PostType as PostTypeEloquent;

class PostType extends Model
{
    //資料表名稱
    protected $table = 'post_types';
    //可新增編輯欄位
    protected $fillable = [
		'name'
	];
    //不使用時間戳記
    public $timestamps = false;
    //建立文章類型與文章間的關聯
	public function posts(){
		return $this->hasMany(PostEloquent::class, 'type');
	}
}
