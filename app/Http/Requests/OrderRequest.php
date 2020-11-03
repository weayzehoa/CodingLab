<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class OrderRequest extends FormRequest
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
            "productId"    => "required|array|min:1",
            "productId.*"  => "required|integer|min:1",
            "price"    => "required|array|min:1",
            "price.*"  => "required|integer|min:1",
            "qty"    => "required|array|min:1",
            "qty.*"  => "required|integer|min:1",
        ];
    }
}
