<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class UserLoginRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'phoneOrUsername' => 'required',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'phoneOrUsername.required' => 'Vui lòng nhập số điện thoại hoặc tên người dùng',
            'password.required' => 'Vui lòng nhập mật khẩu',
        ];
    }

    public function failedValidation(Validator $validator) {
        request()->merge(array_merge($this->input(), ['errors' => $validator->errors()]));
        parent::failedValidation($validator);
    }
}
