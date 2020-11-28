<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class AdminSendSMSRequest extends FormRequest
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
            // 'phone'=>'required|digits:10',
            // 'phone'=>'required|numeric|between:9,11',
            'phone'=>'required|regex:/[0-9]{9,11}/',
            // 'phone'=>'required|regex:/(01)[0-9]{9}/',
            // 'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'content'=>'required|string|max:100',
        ];
    }
}
