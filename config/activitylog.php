<?php

return [

    /*
     * If set to false, no activities will be saved to the database.
     */
    //啟用
    'enabled' => env('ACTIVITY_LOGGER_ENABLED', true),

    /*
     * When the clean-command is executed, all recording activities older than
     * the number of days specified here will be deleted.
     */
    //刪除多少天以前的紀錄
    'delete_records_older_than_days' => 365,

    /*
     * If no log name is passed to the activity() helper
     * we use this default log name.
     */
    //log_name欄位預設名稱
    'default_log_name' => 'default',

    /*
     * You can specify an auth driver here that gets user models.
     * If this is null we'll use the default Laravel auth driver.
     */
    //使用哪一個Auth Driver
    'default_auth_driver' => null,

    /*
     * If set to true, the subject returns soft deleted models.
     */
    //啟用軟刪除Model
    'subject_returns_soft_deleted_models' => false,

    /*
     * This model will be used to log activity.
     * It should be implements the Spatie\Activitylog\Contracts\Activity interface
     * and extend Illuminate\Database\Eloquent\Model.
     */
    'activity_model' => \Spatie\Activitylog\Models\Activity::class,

    /*
     * This is the name of the table that will be created by the migration and
     * used by the Activity model shipped with this package.
     */
    //資料表名稱
    'table_name' => 'activity_log',

    /*
     * This is the database connection that will be used by the migration and
     * the Activity model shipped with this package. In case it's not set
     * Laravel database.default will be used instead.
     */
    //連接資料庫，若需要連接不同的資料庫需在 .env 中指定
    'database_connection' => env('ACTIVITY_LOGGER_DB_CONNECTION'),
];
