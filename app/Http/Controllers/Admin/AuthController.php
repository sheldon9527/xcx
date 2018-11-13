<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Auth\StoreRequest;

class AuthController extends BaseController
{
    /**
     * [postLogin 管理员登录]
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function postLogin(StoreRequest $request)
    {
        $credentials = $request->only('username', 'password');
        $adminService = app('admin');
        if (!$token = $adminService->attempt($credentials)) {
            $request->flashOnly('username');

            return redirect(route('auth.login.get'))->withErrors(['用户名或密码错误'])->with('type', 'admin');
        }

        $redirect = session('url.intended') ?: route('admin.dashboard');

        return redirect($redirect);
    }
    /**
     * [logout 管理员登出]
     * @return [type] [description]
     */
    public function logout()
    {
        app('admin')->logout();

        return redirect(route('auth.login.get'));
    }
}
