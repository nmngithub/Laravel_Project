<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestSlide extends FormRequest
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
                'Ten'=>'required|unique:Slide,Ten,'.$this->id,'_id',
                'NoiDung'=>'required',
                'Link'=>'required'
            ];
        }
        else{
            return [
                'Ten'=>'required|unique:Slide,Ten',
                'NoiDung'=>'required',
                'Link'=>'required'
            ];
        }
        
    }

    public function messages()
    {
        return [
            'Ten.required'=>'Bạn chưa nhập tên!',
            'Ten.unique'=>'Tên slide đã tồn tại!',

            'NoiDung.required'=>'Bạn chưa nhập Nội Dung!',

            'Link.required'=>'Bạn chưa nhập Link!',
        ];
    }
}
