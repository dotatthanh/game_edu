<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGameRequest extends FormRequest
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
            'name' => 'required|max:255',
            'type_id' => 'required',
            'class_id' => 'required',
            'link' => 'required|url|max:1080',
            'image' => 'required|image',
            'description' => 'required|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Họ và tên là trường bắt buộc.',
            'name.max' => 'Họ và tên không được dài quá :max ký tự.',
            'type_id.required' => 'Thể loại là trường bắt buộc.',
            'class_id.required' => 'Lớp là trường bắt buộc.',
            'image.required' => 'Hình ảnh là trường bắt buộc.',
            'image.image' => 'Hình ảnh phải là tệp tin dạng ảnh.',
            'link.required' => 'Link là trường bắt buộc.',
            'link.url' => 'Link phải là một URL hợp lệ.',
            'link.max' => 'Link không được dài quá :max ký tự.',
            'description.required' => 'Mô tả là trường bắt buộc.',
            'description.max' => 'Mô tả không được dài quá :max ký tự.',
        ];
    }
}
