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
        return [
            'TheLoai'=>'required',
            'LoaiTin'=>'required',
            'TieuDe'=>'required|unique:tintuc,TieuDe',
            'TomTat'=>'required',
            'NoiDung'=>'required'
        ];
    }

    public function messages(){
        return [
            'TheLoai.required'=>'Bạn chưa chọn thể loại!',

            'LoaiTin.required'=>'Bạn chưa chọn loại tin!',

            'TieuDe.required'=>'Bạn chưa nhập Tiêu đề!',
            'TieuDe.unique'=>'Tiêu đề đã tồn tại!',

            'TomTat.required'=>'Bạn chưa nhập tóm tắt!',
            
            'NoiDung.required'=>'Bạn chưa nhập nội dung!',
        ];
    }
}
