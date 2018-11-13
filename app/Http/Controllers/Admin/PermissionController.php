<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;

class PermissionController extends BaseController
{
    /**
     * [index 权限列表]
     * @return [type] [description]
     */
    public function index()
    {
        $permissions = Permission::all();

        return view('admin.company.permission.index', compact('permissions'));
    }
}
