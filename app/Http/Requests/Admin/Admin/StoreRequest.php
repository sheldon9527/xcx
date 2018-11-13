<?php

namespace App\Http\Requests\Admin\Admin;

use App\Http\Requests\Admin\Request;
use Illuminate\Contracts\Validation\Validator;

class StoreRequest extends Request
{
    public function rules()
    {
        return [
            'password'              => 'required|between:6,12|confirmed',
            'password_confirmation' => 'required|between:6,12',
            'username'              => 'required|string|alpha_num',
            'status'                => 'required|in:active,inactive',
            'roles'                 => 'array'
        ];
    }

    public function messages()
    {
        return [
            'password.required'              => '请填写密码!',
            'password.between'               => '请填写正确的密码范围!',
            'password.confirmed'             => '两次密码输入不一致!',
            'password_confirmation.required' => '请填写密码!',
            'username.required'              => '请添加登陆账号',
            'username.string'                => '请正确填写登陆账号',
            'status.required'                => '请选择状态!',
            'status.in'                      => '请选择正确的状态!',
        ];
    }
}
