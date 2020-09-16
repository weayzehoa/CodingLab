<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//別忘記這兩行務必要寫, 關聯使用 User 與 PostType 模型
use App\User as UserEloquent;
use App\PostType as PostTypeEloquent;
//關聯 Comment 模型
use App\Comment as CommentEloquent;

class Post extends Model
{
    //可讓使用者新增編輯的欄位名稱
  	protected $fillable = [
		'title', 'type', 'content', 'user_id'
	];
    //與users資料表一對一關聯
	public function user(){
		return $this->belongsTo(UserEloquent::class);
	}
    //type欄位與post_types資料表一對一關聯
	public function postType(){
		return $this->belongsTo(PostTypeEloquent::class, 'type');
    }
    //關聯comments
    public function comments(){
        return $this->hasMany(CommentEloquent::class);
    }
    /*
        補充說明
        belongsTo()第二個參數是放[外來鍵]名稱，第三參數則是[參考鍵]名稱，
        通常參考鍵預設名稱為id，而外來鍵名稱預設為[資料表名稱_id]，
        上述例子因為在建立table時已經將user_id欄位建立來對應user資料表id
        而並沒有建立與post_types的id欄位，故在 postType() 裡面的
        belongsTo()就必須將[外來鍵]名稱對應到 type 欄位中, 而第三個參數未填寫
        主要對應的還是post_type資料表的id, 故[參考鍵]不需要填寫id.
    */

}
