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
        //在post_type資料表建立5筆
        $postTypes = factory(PostTypeEloquent::class, 5)->create();
        //在posts資料表建立50筆, 且用each方法一個一個處理
        //並用 use 帶入 $postTypes 上面的5筆其中一筆.
        $i = 1;
        $posts = factory(PostEloquent::class, 50)->create()->each(function($post) use ($postTypes){
            $post->type = $postTypes[mt_rand(0, (count($postTypes)-1))]->id;
            $post->save();
        });
        //留言資料
        $comments = factory(CommentEloquent::class, 300)->create();
    }
}
