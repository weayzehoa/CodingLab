<?php
/*
    在部落格上面加上留言版
    4. 修改身分驗證相關
    之前部落格是任何使用者都可以修改文章，現在需要透過管理者來管理所有的資料
*/
/*
    留言板相關
    a. 要放在何處??例如: 每一篇文章下方.
    a. 修改相關的Controller
    b. 修改相關視圖
*/
/*
    若要將留言放置於每一篇文章下方則需要 修改 PostController.php
    裡面的 function show()
*/
    use App\Comment as CommentEloquent; //comments資料表
    public function show($id)
    {
        //將id帶入並找文章顯示到視圖
        $post = PostEloquent::findOrFail($id);
        //將post id帶入comment找出留言資料
        $comments = CommentEloquent::where('post_id',$post->id)->orderBy('created_at','DESC')->paginate(5);
        return View::make('posts.show', compact('post','comments'));
    }
/*
    修改 views\posts\show.blade.php
    修改完成後僅能在文章中顯示相關的表單與按鈕實際上並還無法留言
*/
/*
    建立 Comment 的 Request
    php artisan make:request CreateCommentRequest
*/
use Illuminate\Foundation\Http\FormRequest;
use Auth;

class CreateCommentRequest extends FormRequest
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
            'content' => 'required|string'
        ];
    }
}
/*
    建立 PostCommentController.php
    php artisan make:controller PostCommentController --resource
    這邊只會用到 儲存及刪除 因為只有管理者與該文章作者可修改
*/
use Illuminate\Http\Request;
use App\Http\Requests\CreateCommentRequest;
use App\Comment as CommentEloquent;
use Auth;
use Redirect;

class PostCommentsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store($post_id, CreateCommentRequest $request)
    {
        $comment = new CommentEloquent($request->only('content'));
        $comment->post_id = $post_id;
        $comment->user_id = Auth::id();
        $comment->save();
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //透過 文章id 留言 id 並判斷是否為文章擁有者或管理員才能刪除
    public function destroy($post_id, $comment_id)
    {
        $comment = CommentEloquent::where('post_id', $post_id)->findOrFail($comment_id);
        if(Auth::user()->isAdmin() || Auth::id() == $comment->user_id){
            $comment->delete();
        }
        return Redirect::back();
    }
}
/*
    修改PostController.php
    刪除文章一起刪除留言
*/
    public function destroy($id)
    {
        //透過id找到文章後在找出相關的留言刪除
        $comments = CommentEloquent::where('post_id', $post_id);
        $comments->delete();
        return Redirect::back();
    }
?>
