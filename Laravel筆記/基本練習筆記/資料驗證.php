<?php
/* 
    Laravel 內建 Validate 資料驗證功能.
    use Validator;

    $validator = Validator::make( 
        [需要驗證的陣列資料 ex: $request->all() ], 
        [
            '欄位名稱1' => '規則A | 規則B | 規則C..',
            '欄位名稱2' => '規則A | 規則B | 規則C..',
        ],
        [
            '驗證欄位1' =>  '錯誤訊息自訂義1',
            '驗證欄位2' =>  '錯誤訊息自訂義2',
        ],
    );

    //驗證不通過傳出錯誤訊息
    if($validator->fails()){
        return redirect()->back()->withErrors($validator);
    }else{
        通過, Do Something...
    }
*/

/* 
    規則清單
    boolean 必須為布林值格式, ex: true, false, 0, 1 和 "0", "1"
    email 必須符合 email 規則
    integer 須為整數, ex: 2, 5, 235, 2043
    numberic 須為數字但包含浮點
    string 須為字串 包含數字
    min:[value] 字數或字串最小限制
    max:[value] 字數或字串最大限制
    regex:[pattern] 須符合正則表達式
    required 必填欄位
    nullable 此欄位可以為空值
    same:[field] 必須與另一個欄位相同, ex: 重新輸入密碼
    unique:[table, column] 此欄位必須在table中的特定欄位是唯一的. ex:帳號
*/

/* 
    錯誤訊息有內建的英文錯誤消息，可以直接覆血或建立語系檔案來提供其他語言錯誤訊息.
*/

class SchoolController extends Controller
{
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