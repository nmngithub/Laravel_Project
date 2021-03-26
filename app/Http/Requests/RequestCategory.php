<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestCategory extends FormRequest
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
            'Ten'=>'required|unique:theloai,Ten',
        ];
    }

    public function messages()
    {
        return [
            'Ten.required'=>'Bạn chưa nhập tên!',
            'Ten.unique'=>'Tên thể loại đã tồn tại!',
        ];
    }
}
