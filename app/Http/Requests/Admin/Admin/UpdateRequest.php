<?php

namespace App\Http\Requests\Admin\Admin;

use App\Http\Requests\Admin\Request;

class UpdateRequest extends Request
{
    public function rules()
    {
        return [
            'username'  => 'required|string|alpha_num',
            'status'    => 'required|in:active,inactive',
            'roles'     => 'array'
        ];
    }

    public function messages()
    {
        return [
            'username.required'  => '请添加登陆账号',
            'username.string'    => '请正确填写登陆账号',
            'username.alpha_num' => '请正确填写登陆账号',
            'status.required'    => '请选择类型!',
            'status.in'          => '请选择正确的类型!',
        ];
    }
}
