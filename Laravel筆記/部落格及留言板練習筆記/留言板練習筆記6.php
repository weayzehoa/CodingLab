<?php
/*
    在部落格上面加上留言版
    5. 頭像上傳
        要使選單上出現使用者頭像及名字
*/
/*
    修改nav.blade.php
    加上頭像區塊

    <li class="nav-item">
        <a href="{{ route('users.showAvatar') }}" class="px-1">
            <img src="{{ Auth::user()->getAvatarUrl() }}" style="width: 30px; height: 30px;" class="rounded-circle mt-1">
        </a>
    </li>

    上面區塊連結透過 user.showAvatar 來修改, 故須透過 User Controller 來完成
    建立 UserController.php
    php artisan make:controller UserController
*/

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
/*
    建立 UserAvatarRequest
    php artisan make:request UserAvatarRequest
*/
use Auth;

class UserAvatarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'avatar' => 'image'
        ];
    }
}
/*
    新增 users\avatar.blade.php
*/
