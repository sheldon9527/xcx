<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\User\UpdateProfileRequest;
use App\Http\Requests\Admin\User\UpdatePasswordRequest;
use App\Http\Requests\Admin\Admin\StoreRequest;
use App\Http\Requests\Admin\Admin\UpdateRequest;
use App\Models\Admin;
use App\Models\Role;

class AdminController extends BaseController
{
    /**
     * [index 管理员列表]
     * @return [type] [description]
     */
    public function index()
    {
        if (!$this->user()->can("admin.admins") && !$this->user()->is_super) {
            return view('admin.403');
        }
        $admins = Admin::query();
        $searchColumns = ['name', 'cellphone', 'status'];
        if ($name = $this->request->get('name')) {
            $admins->where('first_name', 'like', '%'.$name.'%')
                ->orWhere('last_name', 'like', '%'.$name.'%');
        }
        if ($cellphone = $this->request->get('cellphone')) {
            $admins->where('cellphone', 'LIKE', "%$cellphone%");
        }
        if ($status = $this->request->get('status')) {
            $admins->where('status', $status);
        }
        $admins = $admins->orderBy('id', 'desc')->paginate();
        $params = array_filter($this->request->all());
        $admins->appends($params);
        $roles = Role::all();

        return view('admin.company.index', compact('admins', 'searchColumns', 'roles'));
    }
    /**
     * [store 创建管理员]
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
        if ($username = $request->get('username')) {
            $exist = Admin::where('username', $username)->exists();
            if ($exist) {
                return redirect(route('admin.admins.index'))->withErrors(['登陆账号已经存在']);
            }
        }
        $admin = new Admin();
        $admin->username = trim($request->get('username'));
        $admin->email = trim($request->get('email'));
        $admin->cellphone = trim($request->get('cellphone'));
        $admin->password = bcrypt(trim($request->get('password')));
        $admin->status = $request->get('status');
        $admin->save();
        if ($roles = $request->get('roles')) {
            $admin->attachRoles($roles);
        }

        return redirect(route('admin.admins.index'));
    }
    /**
     * [edit 编辑管理员]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function edit($id)
    {
        $admin = Admin::find($id);
        if (!$admin) {
            abort(404);
        }
        $roles = Role::all();

        return view('admin.company.edit', compact('admin', 'roles'));
    }
    /**
     * [update 更新管理员]
     * @param  [type]        $id      [description]
     * @param  UpdateRequest $request [description]
     * @return [type]                 [description]
     */
    public function update($id, UpdateRequest $request)
    {
        $admin = Admin::find($id);
        if (!$admin) {
            abort(404);
        }
        if ($username = $request->get('username')  && $admin->isDirty('username')) {
            $exist = Admin::where('username', $username)->exists();
            if ($exist) {
                return redirect(route('admin.admins.edit', $id))->withErrors(['登陆账号已经存在']);
            }
        }
        $admin->username = trim($request->get('username'));
        $admin->email = trim($request->get('email'));
        $admin->cellphone = trim($request->get('cellphone'));
        if ($password = $request->get('password')) {
            $admin->password = bcrypt(trim($request->get('password')));
        }
        if ($roles = $request->get('roles')) {
            $admin->roles()->detach();
            $admin->attachRoles($roles);
        }
        $admin->status = $request->get('status');
        $admin->save();

        return redirect(route('admin.admins.show', $id));
    }
    /**
     * [show 展示]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function show($id)
    {
        $admin = Admin::find($id);
        if (!$admin) {
            abort(404);
        }

        return view('admin.company.show', compact('admin'));
    }
    /**
     * [destroy 删除]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destroy($id)
    {
        $admin = Admin::find($id);
        if (!$admin) {
            abort(404);
        }
        if ($admin->isSuper) {
            abort(403);
        }
        $admin->delete();

        return redirect(route('admin.admins.index'));
    }

    /**
     * [update 编辑基本信息]
     * @param  UpdateProfileRequest $request [description]
     * @return [type]                        [description]
     */
    public function updateUser(UpdateProfileRequest $request, $id)
    {
        $user = Admin::find($id);
        if (!$user) {
            abort(404);
        }

        if ($avatar = $request->file('avatar')) {
            $extension = $avatar->getClientOriginalExtension();
            $fileName = hash('ripemd160', time().rand(1000000, 99999999)).'.'.$extension;
            $filePath = (string) $avatar->move('assets/avatars/'.date('y/m/'), $fileName);
            $user->avatar = $filePath;
        }
        if ($request->get('username')) {
            $user->username = $request->get('username');
        }
        $user->cellphone = $request->get('cellphone');
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->save();

        return redirect(route('admin.users.edit', $id));
    }
    /**
     * [editPassword 编辑密码页面]
     * @return [type] [description]
     */
    public function editPassword($id)
    {
        $user = Admin::find($id);
        if (!$user) {
            abort(404);
        }

        return view('admin.user.editPassword');
    }
    /**
     * [updatePassword 编辑密码]
     * @param  UpdatePasswordRequest $request [description]
     * @return [type]                         [description]
     */
    public function updatePassword(UpdatePasswordRequest $request, $id)
    {
        $user = Admin::find($id);
        if (!$user) {
            abort(404);
        }
        $oldPassword = $request->get('old_password');
        $credentials = ['password' => $oldPassword, 'username' => $user->username];
        $adminService = app('admin');
        if (!$adminService->attempt($credentials)) {
            return redirect(route('admin.users.password.edit', $user->id))->withErrors(['旧密码错误']);
        }
        $user->password = bcrypt($request->get('password'));
        $user->save();

        return redirect(route('admin.users.password.edit', $user->id));
    }
}
