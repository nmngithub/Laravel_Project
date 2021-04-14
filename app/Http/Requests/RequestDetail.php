<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestDetail extends FormRequest
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
                'IdLoaiTin'=>'required',
                'TieuDe'=>'required|unique:tintuc,TieuDe,'.$this->id.',_id',
                'TomTat'=>'required',
                'NoiDung'=>'required',
                
            ];
        }
        else{
            $rule = [
                'IdTheLoai'=>'required',
                'IdLoaiTin'=>'required',
                'TieuDe'=>'required|unique:tintuc,TieuDe',
                'TomTat'=>'required',
                'NoiDung'=>'required'
            ];
        }
        return $rule;
        
    }

    public function messages(){
        return [
            'IdTheLoai.required'=>'Bạn chưa chọn thể loại!',

            'IdLoaiTin.required'=>'Bạn chưa chọn loại tin!',

            'TieuDe.required'=>'Bạn chưa nhập Tiêu đề!',
            'TieuDe.unique'=>'Tiêu đề đã tồn tại!',

            'TomTat.required'=>'Bạn chưa nhập tóm tắt!',
            
            'NoiDung.required'=>'Bạn chưa nhập nội dung!',
        ];
    }
}
