<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Permission;
use App\Http\Requests\Admin\Role\StoreRequest;

class RoleController extends BaseController
{
    /**
     * [index 角色列表]
     * @return [type] [description]
     */
    public function index()
    {
        $roles = Role::all();

        return view('admin.company.role.index', compact('roles'));
    }
    /**
     * [store 添加角色]
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
        $role = new Role();
        $role->name = $role->display_name =  $request->get('name');
        $role->description = $request->get('description');
        $role->save();

        return redirect(route('admin.roles.index'));
    }
    /**
     * [destroy 删除角色]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        if (!$role) {
            abort(404);
        }
        $role->delete();

        return redirect(route('admin.roles.index'));
    }
    /**
     * [permissionEdit 权限编辑]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function permissionEdit($id)
    {
        $role = Role::find($id);
        if (!$role) {
            abort(404);
        }

        $permissions = Permission::all();

        return view('admin.company.role.permissionIndex', compact('permissions', 'role'));
    }
    /**
     * [permissionUpdate 权限更新]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function permissionUpdate($id)
    {
        $role = Role::find($id);
        if (!$role) {
            abort(404);
        }
        $permissionIds = $this->request->get('permission_ids');
        $role->perms()->detach();
        $role->attachPermissions($permissionIds);

        return redirect(route('admin.roles.index'));
    }
}
