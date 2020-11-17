<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class AdminSendMailRequest extends FormRequest
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
            'email'=>'required|email',
            'subject'=>'required|string|max:100',
            'title'=>'required|string|max:100',
            'content'=>'required|string|max:1000',
        ];
    }
}
