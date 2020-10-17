<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use URL; //新增
use App\Post as PostEloquent;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //與POST關聯
    public function posts(){
        return $this->hasMany(PostEloquent::class);
    }
    //與COMMENT關聯
    public function socialuser(){
        return $this->hasOne(SocialUserEloquent::class);
    }
    //判斷是否為管理員
    public function isAdmin(){
        return ($this->type == 1);
    }
    //得到頭像
    public function getAvatarUrl(){
        //空資料使用預設圖片
        if(empty($this->avatar)){
            return URL::asset('images/avatars/default.png');
        }else{
            //若不是網址則直接回傳
            if(!preg_match("/^[a-zA-z]+:\/\//", $this->avatar)){
                return URL::asset($this->avatar);
            }else{
                return $this->avatar;
            }
        }
    }
}
