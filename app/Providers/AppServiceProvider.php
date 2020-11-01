<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use \App\Http\ViewComposers\PostsIndexComposer;
// use \App\Http\ViewComposers\AdminIndexComposer;
use \App\Http\ViewComposers\IndexComposer;
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
        // view()->composer('posts.index', PostsIndexComposer::class);
        //將PostsIndexComposerost視圖共用變數拋給 admin.posts.* 所有視圖 (主要是給post用)
        // view()->composer('admin.*', PostsIndexComposer::class);

        //註冊AdminIndexComposer 視圖共用變數給後台用 admin.* 所有視圖
        //這樣可以給被分離出去的 menu.blade 或 footer.blade 這些視圖共同使用
        // view()->composer('admin.*', AdminIndexComposer::class);

        //註冊IndexComposer視圖共用變數，給全網站使用
        view()->composer('*', IndexComposer::class);

        // //只要有作紀錄動作，都將IP寫入 properties 欄位
        // Activity::saving(function (Activity $activity) {
        //     $activity->properties = $activity->properties->put('ip', request()->ip());
        // });
        //只要有作紀錄動作，將IP寫入特定的紀錄IP欄位
        Activity::saving(function(Activity $activity) { $activity->ip = $activity->ip = request()->ip();});
    }
}
