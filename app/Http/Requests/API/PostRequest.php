<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'required|string|max:100',
            'type'=>'required|integer|exists:post_types,id',
            'content'=>'required|string|max:5000',
            'onlinedate' => 'date_format:Y-m-d H:i:s',
            'offlinedate' => 'date_format:Y-m-d H:i:s',
        ];
    }
}
