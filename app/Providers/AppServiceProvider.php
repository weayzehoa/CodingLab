<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \App\Http\ViewComposers\PostsIndexComposer;

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
    }
}
