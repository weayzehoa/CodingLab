<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//直接使用記錄功能
use Spatie\Activitylog\Traits\LogsActivity;

class Park extends Model
{
    use LogsActivity;

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
}
