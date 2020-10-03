<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \App\Http\ViewComposers\PostsIndexComposer;
use Spatie\Activitylog\Models\Activity;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //註冊PostsIndexComposerost視圖共用變數
        view()->composer('posts.index', PostsIndexComposer::class);
        //將PostsIndexComposerost視圖共用變數拋給 admin.posts.* 所有視圖 (主要是給post用)
        view()->composer('admin.mbposts.*', PostsIndexComposer::class);

        // //只要有作紀錄動作，都將IP寫入 properties 欄位
        // Activity::saving(function (Activity $activity) {
        //     $activity->properties = $activity->properties->put('ip', request()->ip());
        // });
        //只要有作紀錄動作，將IP寫入特定的紀錄IP欄位
        Activity::saving(function(Activity $activity) { $activity->ip = $activity->ip = request()->ip();});
    }
}
