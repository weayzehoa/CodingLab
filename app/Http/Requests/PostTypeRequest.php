<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//別忘記這行，需要檢驗是否登入
use Auth;

class PostTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //返回是否驗證成功
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //檢查 name 欄位是否符合
        return [
            'name' => 'required|string'
        ];
    }
}
