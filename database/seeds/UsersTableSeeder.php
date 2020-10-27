<?php

use Illuminate\Database\Seeder;
use App\User as UserEloquent;
use Illuminate\Support\Facades\Storage;

class UsersTableSeeder extends Seeder
{
    // $destPath = 'upload/avatars';

    // $avatar1 = array('avatar.png','avatar4.png','avatar5.png','user1-128x128.jpg','user6-128x128.jpg','user8-128x128.jpg','user2-160x160.jpg');
    // $avatar2 = array('avatar2.png','avatar3.png','user3-128x128.jpg','user4-128x128.jpg','user5-128x128.jpg','user7-128x128.jpg');
    // $gender = mt_rand(1, 2);
    // if($gender == 1){
    //     $no = mt_rand(0, 6);
    //     $file = $avatar1[$no];
    // }else{
    //     $no = mt_rand(0, 5);
    //     $file = $avatar1[$no];
    // }
    // $ext = explode('.',$file)[1];
    // $fileName = (Carbon::now()->timestamp) . '.' . $ext;
    // $avatar = $destPath.'/'.$fileName;
    // $destPath = 'upload/avatars';
    // if(!file_exists(public_path() . '/' . $destPath)){
    //     Storage::makeDirectory(public_path() . '/' . $destPath, 0755, true);
    // }
    // Storage::copy(asset("/img/$file") , public_path() . '/' . $avatar );

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
