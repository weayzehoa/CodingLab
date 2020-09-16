<?php

use Illuminate\Database\Seeder;
use App\Admin as AdminEloquent;
class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //建立一筆管理者
        AdminEloquent::create([
            'name' => '管理者',
            'email' => 'admin@mail.com',
            'password' => bcrypt('admin'),
            'access' => '1111111111',
            'right' => 1,
        ]);
        //建立一筆唯讀者
        AdminEloquent::create([
            'name' => '唯讀者',
            'email' => 'read@mail.com',
            'password' => bcrypt('read'),
            'access' => '1111111111',
            'right' => 0,
        ]);
    }
}
