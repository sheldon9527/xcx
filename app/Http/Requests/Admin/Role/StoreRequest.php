<?php
namespace App\Http\Requests\Admin\Role;

use App\Http\Requests\Admin\Request;

class StoreRequest extends Request
{
    public function rules()
    {
        return [
            'name'        => 'required|string|unique:roles,name',
            'description' => 'string',
        ];
    }
}