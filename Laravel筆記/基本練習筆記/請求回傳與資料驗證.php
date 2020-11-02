<?php
/* 
如何利用Laravel的Request 及 Validate 來取得及驗證請求的資料是否正確.
*/
/* 
    先用指令建立一個SchoolController
    php artisan make:controller SchoolController
*/
/* 
    修改web.php及編輯SchoolController
    並在 public function update()中加入驗證
*/
class SchoolController extends Controller
{
    public function edit($student_no){ //將傳入的學生編號找出資料送出視圖
        $student = StudentEloquent::where('no', $student_no)->firstOrFail();
        return View::make('edit', compact('student'));
    }

    public function update($student_no, EditRequest $request){
        //內建驗證規則及自定義錯誤訊息
        $validator = Validator::make(
            $request->all(),[
                'name' => 'required|string',
                'tel' => 'required|string'
            ],[
                'required' => '不可為空白',
                'string' => '須為字串'
            ]
        );
        //驗證不通過傳出錯誤訊息
        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }else{ //通過則將資料儲存
            $student = StudentEloquent::where('no', $student_no)->firstOrFail();
            $student->tel = $request->tel;
            $student->user->name = $request->name;
            $student->user->save();
            $student->save();
        }

        return View::make('edit', [
            'student' => $student,
            'msg' => '修改成功'
        ]);
    }
}
/* 
    建立相關的視圖 edit.blade.php
    然後在board.blade.php新增編輯按鈕並將排行榜導回board
*/
/* 
    <a href="{{ action('SchoolController@edit', ['student_no' => $score->student->no]) }}" class="btn btn-success btn-sm">
        編輯
    </a>

    <a href="<?php echo action('BoardController@getIndex'); ?>" class="nav-link">
        排行榜
    </a>
*/
/* 
    完成後可以看到多一個按鈕點擊後進入該編輯頁面.
    此時按修改將會跳出錯誤Target class [App\Http\Controllers\EditRequest] does not exist.
    因為尚未建立EditRequest這個
    需使用artisan的 make:request來快速建立一個Form Request
    php artisan make:request EditRequest
    建立完成後在 app\Http\Requests 目錄下可以看到 EditRequest.php
    此時只要將驗證內容放入即可。
*/
class EditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
	        'tel' => 'required|string'
        ];
    }

    /**
     * 自定義錯誤訊息
     * 
     * @return array
     */
    public function messages(){
        return [
            'required' => '不可為空白',
	 		'string' => '須為字串'
        ];
    }
}
/* 
    接著調整SchoolController.php
    將function update()修改為
    public function update($student_no, EditRequest $request)
    並將傳入值的參數宣告為 EditRequest
    use App\Http\Request\EditRequest;
*/
