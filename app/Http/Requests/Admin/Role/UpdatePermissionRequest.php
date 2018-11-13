<?php
namespace App\Http\Requests\Admin\Role;

use App\Http\Requests\Admin\Request;

class UpdatePermissionRequest extends Request
{
    public function rules()
    {
        return [
            'permission_ids'        => 'required',
        ];
    }
}
