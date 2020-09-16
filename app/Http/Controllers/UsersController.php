<?php

namespace App\Http\Controllers;

//新增要使用的Class
use Illuminate\Http\Request;
use App\Http\Requests\UserAvatarRequest;
use App\User as UserEloquent;
use \Carbon\Carbon;
use Auth;
use View;
use File;
use Redirect;

class UsersController extends Controller
{
    //透過中介層檢驗
    public function __construct(){
        $this->middleware('auth');
    }
    //顯示頭像功能
    public function showAvatar(){
        return View::make('users.avatar');
    }
    //上傳頭像
    public function uploadAvatar(UserAvatarRequest $request){
        if(!$request->hasFile('avatar')){
            return Redirect::route('index');
        }

        $file = $request->file('avatar');
        $destPath = 'images/avatars';

        if(!file_exists(public_path() . '/' . $destPath)){
            File::makeDirectory(public_path() . '/' . $destPath, 0755, true);
        }

        $ext = $file->getClientOriginalExtension();
        $fileName = (Carbon::now()->timestamp) . '.' . $ext;
        $file->move(public_path() . '/' . $destPath, $fileName);

        $user = Auth::user();
        $user->avatar = $destPath . '/' . $fileName;
        $user->save();
        return Redirect::route('index');
    }
}
