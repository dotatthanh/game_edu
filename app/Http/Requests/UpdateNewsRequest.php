<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsRequest extends FormRequest
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
            'title' => 'required|max:255',
            'content' => 'required',
            'summary' => 'required|max:1000',
            'image' => 'nullable|image',
            'type' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề là trường bắt buộc.',
            'title.max' => 'Tiêu đề không được dài quá :max ký tự.',
            'content.required' => 'Nội dung là trường bắt buộc.',
            'content.max' => 'Nội dung không được dài quá :max ký tự.',
            'summary.required' => 'Tóm tắt là trường bắt buộc.',
            'summary.max' => 'Tóm tắt không được dài quá :max ký tự.',
            'image.image' => 'Hình ảnh phải là tệp tin dạng ảnh.',
            'type.required' => 'Loại tin tức là trường bắt buộc.',
        ];
    }
}
