<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
//使用Auth驗證
use Auth;

class AddCartRequest extends FormRequest
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
            'productId' => 'required|numeric',
            'priceId' => 'required|numeric',
            'qty' => 'required|numeric|min:1',
        ];
    }
}
