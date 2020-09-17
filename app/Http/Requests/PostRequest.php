<?php

namespace App\Http\Requests;

//表單驗證
use Illuminate\Foundation\Http\FormRequest;
//使用Auth驗證
use Auth;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    //必須登入才可以使用這個Request
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    //欄位規則
    public function rules()
    {
        return [
            'title'=>'required|string',
            'type'=>'required|integer|exists:post_types,id',
            'content'=>'required|string'
        ];
    }
}
