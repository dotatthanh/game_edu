<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
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
            'username' => 'required|max:50',
            'name' => 'required|max:255',
            'email' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique('customers')->ignore($this->customer),
            ],
            'avatar' => 'nullable|image',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Tên tài khoản là trường bắt buộc.',
            'username.max' => 'Tên tài khoản không được dài quá :max ký tự.',
            'name.required' => 'Họ và tên là trường bắt buộc.',
            'name.max' => 'Họ và tên không được dài quá :max ký tự.',
            'email.required' => 'Email là trường bắt buộc.',
            'email.email' => 'Email chưa đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.',
            'email.string' => 'Email phải là một chuỗi.',
            'email.max' => 'Email không được dài quá :max ký tự.',
            'avatar.image' => 'Ảnh đại diện phải là tệp tin dạng ảnh!',
        ];
    }
}
