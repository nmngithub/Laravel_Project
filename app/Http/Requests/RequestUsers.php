<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestUsers extends FormRequest
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
       if(isset($this->id)){
            return [
                'Ten'=>'required|min:3|max:100',
                'Email'=>'required|email|min:6|max:30|unique:users,email,'.$this->id,'_id',
                'password'=>'required|min:6|max:12',
                'passwordAgain'=>'required|same:password|min:6|max:12',
            ];
       }else{
            return [
                'Ten'=>'required|min:3|max:100',
                'Email'=>'required|email|min:6|max:30|unique:users,email',
                'password'=>'required|min:6|max:12',
                'passwordAgain'=>'required|same:password|min:6|max:12',
            ];
       }
    }

    public function messages()
    {
        return [
            'Ten.required'=>'Bạn chưa nhập Tên người dùng!',
            'Ten.min'=>'Tên người dùng phải từ 3 đến 100 ký tự!',
            'Ten.max'=>'Tên người dùng phải từ 3 đến 100 ký tự!',

            'Email.required'=>'Bạn chưa nhập Email!',
            'Email.email'=>'Bạn chưa nhập đúng định dạng Email!',
            'Email.min'=>'Email phải từ 6 đến 30 ký tự!',
            'Email.max'=>'Email phải từ 6 đến 30 ký tự!',
            'Email.unique'=>'Email đã tồn tại!',

            'password.required'=>'Bạn chưa nhập Password!',
            'password.email'=>'Bạn chưa nhập đúng định dạng Password!',
            'password.min'=>'Mật khẩu phải từ 6 đến 12 ký tự!',
            'password.max'=>'Mật khẩu phải từ 6 đến 12 ký tự!',

            'passwordAgain.required'=>'Bạn chưa nhập lại Password!',
            'passwordAgain.email'=>'Bạn chưa nhập đúng định dạng Password!',
            'passwordAgain.min'=>'Mật khẩu phải từ 6 đến 12 ký tự!',
            'passwordAgain.max'=>'Mật khẩu phải từ 6 đến 12 ký tự!',
            'passwordAgain.same'=>'Mật khẩu nhập lại chưa khớp!',
        ];
    }
}
