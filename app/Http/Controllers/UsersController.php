<?php

namespace App\Http\Controllers;

//新增要使用的Class
use Illuminate\Http\Request;
use App\Http\Requests\UserAvatarRequest;
use App\Http\Requests\UserProfileRequest;
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

    //會員資料功能
    public function profile(){
        return View::make('users.profile');
    }

    public function updateProfile(UserProfileRequest $request){
        $id = Auth::user()->id;
        //透過id將進來的資料填寫到資料庫後返回index()
        $user = UserEloquent::findOrFail($id);
        $user->fill($request->all());
        $user->save();
        return Redirect::back();
    }

    //顯示頭像功能
    public function showAvatar(){
        return View::make('users.avatar');
    }
    //上傳頭像
    public function uploadAvatar(UserAvatarRequest $request){
        if(!$request->hasFile('avatar')){
            // return Redirect::route('index');
            return Redirect::back();
        }

        $file = $request->file('avatar');
        $destPath = 'upload/avatars';

        if(!file_exists(public_path() . '/' . $destPath)){
            File::makeDirectory(public_path() . '/' . $destPath, 0755, true);
        }

        $ext = $file->getClientOriginalExtension();
        $fileName = (Carbon::now()->timestamp) . '.' . $ext;
        $file->move(public_path() . '/' . $destPath, $fileName);

        $user = Auth::user();
        $user->avatar = $destPath . '/' . $fileName;
        $user->save();
        // return Redirect::route('index');
        return Redirect::back();
    }
}
