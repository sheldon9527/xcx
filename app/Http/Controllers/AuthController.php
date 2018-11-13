<?php

namespace App\Http\Controllers;

class AuthController extends BaseController
{
    /**
     * [getLogin 登录]
     * @return [type] [description]
     */
    public function getLogin()
    {
        if ($this->user()) {
            return redirect(route('admin.dashboard'));
        }

        return view('index');
    }
    /**
     * [dashboard 仪表盘]
     * @return [type] [description]
     */
    public function dashboard()
    {
        if ($this->user()) {
            return redirect(route('admin.dashboard'));
        }

        return view('index');
    }
}
