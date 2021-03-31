<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestKindOfNews extends FormRequest
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
            'TheLoai'=>'required',
            'Ten'=> 'required|unique:loaitin,Ten',
        ];

        if(isset($this->id)){
            $rule = [
                'TheLoai'=>'required',
                'Ten'=> 'required|unique:loaitin,Ten,'.$this->id.',_id',
            ];
        }
        else{
            $rule = [
                'TheLoai'=>'required',
                'Ten'=> 'required|unique:loaitin,Ten',
            ];
        }
        return $rule;
    }

    public function messages(){
        return [
            'TheLoai.required'=>'Bạn chưa chọn tên thể loại',

            'Ten.required'=>'Bạn chưa nhập tên loại tin!',
            'Ten.unique'=>'Tên loại tin đã tồn tại!',
        ];
    }
}
