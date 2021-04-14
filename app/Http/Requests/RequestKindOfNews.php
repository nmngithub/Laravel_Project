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
        if(isset($this->id)){
            $rule = [
                'IdTheLoai'=>'required',
                'Ten'=> 'required|unique:loaitin,Ten,'.$this->id.',_id',
            ];
        }
        else{
            $rule = [
                'IdTheLoai'=>'required',
                'Ten'=> 'required|unique:loaitin,Ten',
            ];
        }
        return $rule;
    }

    public function messages(){
        return [
            'IdTheLoai.required'=>'Bạn chưa chọn thể loại',

            'Ten.required'=>'Bạn chưa nhập tên loại tin!',
            'Ten.unique'=>'Tên loại tin đã tồn tại!',
        ];
    }
}
