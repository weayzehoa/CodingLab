<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //清除所有隨機產生的檔案
        File::cleanDirectory(public_path(). '/upload/avatars');
        $this->call(AdminsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(ParksTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
    }
}
