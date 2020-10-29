<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Post as PostEloquent;
use App\PostType as PostTypeEloquent;
use App\User as UserEloquent;
use App\Product as ProductEloquent;
use Spatie\Activitylog\Models\Activity as ActivityEloquent;

class AdminIndexComposer
{
    public function compose(View $view){
        $post_types = PostTypeEloquent::orderBy('name', 'ASC')->get();
        $posts_total = PostEloquent::get()->count();
        $users_total = UserEloquent::get()->count();
        $logs_total = ActivityEloquent::get()->count();
        $products_total = ProductEloquent::get()->count();
        $post_types_total = PostTypeEloquent::get()->count();

        $view->with('post_types', $post_types);
        $view->with('posts_total', $posts_total);
        $view->with('users_total', $users_total);
        $view->with('logs_total', $logs_total);
        $view->with('products_total', $products_total);
    }
}
