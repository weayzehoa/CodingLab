<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//別忘記這兩行務必要寫, 關聯使用 User 與 PostType 模型
use App\User as UserEloquent;
use App\PostType as PostTypeEloquent;
//關聯 Comment 模型
use App\Comment as CommentEloquent;
//直接使用記錄功能
use Spatie\Activitylog\Traits\LogsActivity;
class Post extends Model
{
    use LogsActivity;

    //可讓使用者新增編輯的欄位名稱
  	protected $fillable = [
        'title', 'type', 'content', 'user_id', 'approved',
        'onlinedate', 'offlinedate', 'isshow', 'istop', 'sort'
	];

    // //要記錄的欄位 ['*'] 全部
    protected static $logAttributes = ['*'];
    // //若使用 $logAttributes = ['*'] 時可使用來忽略某些欄位異動不啟用紀錄
    // // protected static $logAttributesToIgnore = [ 'type'];

    // //只記錄有改變的欄位
    // protected static $logOnlyDirty = true;

    // //無異動資料則不增加空資料,若沒設定 $ogOnlyDirty = true 時使用
    // protected static $submitEmptyLogs = false;

    // //log_name 欄位資料
    protected static $logName = '會員文章';

    // //將此模型命名在 activity 資料表的 log_name 欄位
    // // public function getLogNameToUse(string $eventName = ''): string
    // // {
    // //     return '會員文章';
    // // }

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
