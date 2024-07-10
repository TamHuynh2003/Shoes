<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUsersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fullname' => 'required|string|max:255|min:10',
            'phone_number' => 'required|size:10|unique:admins,phone_number|regex:/^0[0-9]{9,10}$/',

            'email' => 'required|string|email|max:255|unique:users',

            'password' => 'required|string|min:6',
            'confirm_password' => 'required|same:password',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ":attribute bắt buộc phải nhập",
            'string' => ":attribute không phải là chuỗi",

            'email' => ":attribute không đúng định dạng",
            'unique' => ":attribute đã được sử dụng",
            'regex' => ":attribute không hợp lệ",

            'min' => ":attribute không được nhỏ hơn :min kí tự",
            'max' => ":attribute không được lớn hơn :max kí tự",
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'email của bạn ',
            'fullname' => 'họ và tên của bạn ',
            'password' => 'mật khẩu',
            'phone_number' => 'số điện thoại của bạn',
            'confirm_password' => 'xác nhận lại mật khẩu',
        ];
    }
}
