<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//直接使用記錄功能
use Spatie\Activitylog\Traits\LogsActivity;

//使用 Scout 做搜尋
use Laravel\Scout\Searchable;

use App\Es\ParksIndexConfigurator;
// use ScoutElastic\Searchable;

class Park extends Model
{
    use LogsActivity;
    use Searchable;

    protected $table='parks';

    //可新增編輯的欄位名稱
    protected $fillable = [
        'name', 'engname', 'overview', 'lat', 'lon',
        'dist', 'location', 'type', 'area', 'unit',
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
    protected static $logName = '公園資料';

    /**
     * 取得模型的索引名稱。
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'parks_index';
    }

    // //使用es配置
    // protected $indexConfigurator = ParksIndexConfigurator::class;

    // //對應可搜尋的欄位
    // protected $mapping = [
    //     'properties' => [
    //         'name' => [
    //             'type' => 'text',
    //         ],
    //         'overview' => [
    //             'type' => 'text',
    //         ],
    //     ]
    // ];

    // //將資料寫入Elasticsearch host
    // public function toSearchableArray()
    // {
    //     return [
    //         'name'=> $this->name,
    //         'overview' => strip_tags($this->overview),
    //     ];
    // }
}
