<?php

use Illuminate\Database\Seeder;
use App\User as UserEloquent;
use Illuminate\Support\Facades\Storage;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //建立一筆使用者
        UserEloquent::create([
            'name' => '使用者',
            'gender' => 1,
            'email' => 'user@mail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('user'),
            'type' => 1,
            'address' => '地球',
            'tel' => '0123456789',
        ]);
        //建立一筆訪客
        UserEloquent::create([
            'name' => '訪客',
            'gender' => 2,
            'email' => 'guest@mail.com',
            'password' => bcrypt('guest'),
            'type' => 0,
            'address' => '火星',
            'tel' => '9876543210',
        ]);
        //在users資料表建立18筆
        $users = factory(UserEloquent::class, 18)->create();
    }
}
