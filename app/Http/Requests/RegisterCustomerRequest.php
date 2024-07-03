<?php

namespace App\Http\Requests;

use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterCustomerRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Customer::class],
            'username' => ['required', 'string', 'lowercase', 'max:255', 'unique:'.Customer::class],
            'password' => ['required', 'confirmed', Password::defaults(), 'min:8', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Họ và tên là trường bắt buộc.',
            'name.max' => 'Họ và tên không được dài quá :max ký tự.',
            'name.string' => 'Họ và tên phải là một chuỗi.',
            'email.required' => 'Email là trường bắt buộc.',
            'email.email' => 'Email chưa đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.',
            'email.string' => 'Email phải là một chuỗi.',
            'email.max' => 'Email không được dài quá :max ký tự.',
            'email.lowercase' => 'Email không được viết hoa.',
            'password.required' => 'Mật khẩu là trường bắt buộc!',
            'password.confirmed' => 'Xác nhận mật khẩu không chính xác!',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự!',
            'password.string' => 'Mật khẩu phải là một chuỗi',
            'username.required' => 'Tên tài khoản là trường bắt buộc.',
            'username.email' => 'Tên tài khoản chưa đúng định dạng.',
            'username.unique' => 'Tên tài khoản đã tồn tại.',
            'username.string' => 'Tên tài khoản phải là một chuỗi.',
            'username.max' => 'Tên tài khoản không được dài quá :max ký tự.',
            'username.lowercase' => 'Tên tài khoản không được viết hoa.',
        ];
    }
}
