<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UserRequest extends FormRequest
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
        $userId = $this->route()->parameter('id');
        if ($userId) {
            return [
                'name' => 'required|max:25',
                'username' => 'required|min:5|max:16|unique:users,username,' . $userId,
                'phone' => 'required|numeric|min:100000000|max:999999999999|unique:users,phone,' . $userId,
                'password' => 'nullable|min:8|max:16',
                'passcode' => 'nullable|min:3|max:8',
                'balance' => 'numeric|min:0',
                'role' => 'required'
            ];
        } else {
            return [
                'name' => 'required|max:25',
                'username' => 'required|unique:users|min:5|max:16',
                'phone' => 'required|numeric|unique:users|min:100000000|max:999999999999',
                'password' => 'required|min:8|max:16',
                'passcode' => 'required|min:3|max:8',
                'invite_code' => 'required'
            ];
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập họ và tên',
            'name.max' => 'Vui lòng nhập tối đa :max ký tự',
            'username.required' => 'Vui lòng nhập tên tài khoản',
            'username.min' => 'Vui lòng nhập tối thiểu :min ký tự',
            'username.unique' => 'Tên tài khoản đã có người sử dụng',
            'username.max' => 'Vui lòng nhập tối đa :max ký tự',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.min' => 'Vui lòng nhập tối thiểu 9 ký tự',
            'phone.unique' => 'Số điện thoại đã có người sử dụng',
            'phone.numeric' => 'Số điện thoại không đúng định dạng',
            'phone.max' => 'Vui lòng nhập tối đa 12 ký tự',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Vui lòng nhập tối thiểu :min ký tự',
            'password.max' => 'Vui lòng nhập tối đa :max ký tự',
            'passcode.required' => 'Vui lòng nhập mật khẩu quỹ',
            'passcode.min' => 'Vui lòng nhập tối thiểu :min ký tự',
            'passcode.max' => 'Vui lòng nhập tối đa :max ký tự',
            'invite_code.required' => 'Vui lòng nhập mã thư mời',
            'balance.min' => 'Số dư phải lớn hơn hoặc bằng 0'
        ];
    }

    public function failedValidation(Validator $validator) {
        request()->merge(array_merge($this->input(), ['errors' => $validator->errors()]));
        parent::failedValidation($validator);
    }
}
