<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MemberUpdateRequest extends FormRequest
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
            'name' => 'required|min:3|max:50',
            'gender' => 'required|integer',
            'tel' => 'string|min:8|max:25',
            'address' => 'nullable|string|max:255',
            'active' => 'required|boolean',
            'avatar' => 'file|mimes:jpeg,bmp,png|between:1,50|dimensions:min_width=100,max_width=200',
            // 'avatar' => 'image|between:1,50|dimensions:min_width=100,max_width=200',
        ];
    }
}
