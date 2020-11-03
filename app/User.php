<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use URL;
use App\Post as PostEloquent;
use App\SocialUser as SocialUserEloquent;
use App\Cart as CartEloquent;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Support\Facades\Lang;

use App\Notifications\VerifyEmailNotification as VerifyEmailNotification;
//使用記錄功能
use Spatie\Activitylog\Traits\LogsActivity;
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use LogsActivity;

    //要記錄的欄位 ['*'] 全部
    protected static $logAttributes = ['*'];
    // //log_name 欄位資料
    protected static $logName = '會員資料';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'gender', 'tel', 'address','active'
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

    //與Order關聯
    public function orders(){
        return $this->hasMany(CartEloquent::class);
    }
    //與Cart關聯
    public function carts(){
        return $this->hasMany(CartEloquent::class);
    }
    //與POST關聯
    public function posts(){
        return $this->hasMany(PostEloquent::class);
    }
    //與SocialUser關聯
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
            return URL::asset('img/noavatar.png');
        }else{
            //若不是網址則直接回傳
            if(!preg_match("/^[a-zA-z]+:\/\//", $this->avatar)){
                return URL::asset($this->avatar);
            }else{
                return $this->avatar;
            }
        }
    }

    //修改 寄出密碼重設通知
    public function sendPasswordResetNotification($token)
    {
        $notification = new ResetPasswordNotification($token);

        //使用 Illuminate\Auth\Notifications\ResetPassword 預留的 public static method toMailUsing()
        $notification::toMailUsing(function (User $notifiable, string $token) {
            // 建立「重設密碼」的 URL
            $passwordResetUrl = url(
                sprintf(config('auth.passwords.reset_url') . '%s?email=%s', $token, $notifiable->getEmailForPasswordReset())
            );

            // 重建 MailMessage
            // getFromJson 已在 v6 後併入 get() 須改用，並執行 php artisan view:clear 與 php artisan view:cache
            return (new MailMessage())
                    ->subject(Lang::get('Reset Password Notification'))
                    ->line(Lang::get('You are receiving this email because we received a password reset request for your account.'))
                    ->action(Lang::get('Reset Password'), $passwordResetUrl)
                    ->line(Lang::get('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.users.expire')]))
                    ->line(Lang::get('If you did not request a password reset, no further action is required.'));
        });

        // 依照原本的方式執行 notify
        $this->notify($notification);
    }

    //修改 寄出驗證信件通知
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification());
    }

}
