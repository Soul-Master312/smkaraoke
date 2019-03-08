<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoomRequest extends FormRequest
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
            'room_name' => 'required|unique:rooms,room_name',
            'user_name' => 'required|unique:rooms,user_name',
            'password' => 'required|confirmed',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'room_name.required' => 'Xin vui lòng nhập tên phòng',
            'user_name.required' => 'Xin vui lòng nhập tên đăng nhập cho phòng',
            'password.required' => 'Xin vui lòng nhập mật khẩu',
            'password.confirmed' => 'Mật khẩu và xác nhận mật khẩu không trùng khớp'
        ];
    }
}
