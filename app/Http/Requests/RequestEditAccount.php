<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestEditAccount extends FormRequest
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
                'name'=>'required',
                'password'=>'required|min:6|max:12',
                'passwordAgain'=>'required|same:password'    
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>"Bạn chưa nhập tên!",
    
                'password.required'=>'Bạn chưa nhập password!',
                'password.min'=>'Mật khẩu tối thiểu 6 ký tự!',
                'password.max'=>'Mật khẩu tối đa 12 ký tự!',
    
                'passwordAgain.required'=>'Bạn chưa nhập xác nhận mật khẩu!',
                'passwordAgain.same'=>'Mật khẩu không khớp!'
        ];
    }
}
