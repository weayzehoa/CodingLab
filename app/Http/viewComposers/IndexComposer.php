<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Post as PostEloquent;
use App\PostType as PostTypeEloquent;
use App\User as UserEloquent;
use App\Product as ProductEloquent;
use App\Cart as CartEloquent;
use Auth;
use Spatie\Activitylog\Models\Activity as ActivityEloquent;

class IndexComposer
{
    public function compose(View $view){
        $post_types = PostTypeEloquent::orderBy('name', 'ASC')->count();
        $posts_total = PostEloquent::count();
        $post_types_total = PostTypeEloquent::count();
        $users_total = UserEloquent::count();
        $logs_total = ActivityEloquent::count();
        $products_total = ProductEloquent::count();
        $carts_total = CartEloquent::where('user_id', Auth::user()->id)->count();

        $view->with('post_types', $post_types);
        $view->with('posts_total', $posts_total);
        $view->with('users_total', $users_total);
        $view->with('logs_total', $logs_total);
        $view->with('products_total', $products_total);
        $view->with('carts_total', $carts_total);
    }
}
