<?php

use Illuminate\Database\Seeder;

use App\User as UserEloquent;
use App\Post as PostEloquent;
use App\PostType as PostTypeEloquent;
use App\Comment as CommentEloquent;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //在users資料表建立4筆
        $users = factory(UserEloquent::class, 4)->create();
        //在post_type資料表建立10筆
        $postTypes = factory(PostTypeEloquent::class, 10)->create();
        //在posts資料表建立50筆, 且用each方法一個一個處理
        //並用 use 帶入 $postTypes 上面的10筆其中一筆.
        $posts = factory(PostEloquent::class, 50)->create()->each(function($post) use ($postTypes){
            $post->type = $postTypes[mt_rand(0, (count($postTypes)-1))]->id;
            $post->save();
        });
        //留言資料
        $comments = factory(CommentEloquent::class, 300)->create();
    }
}
