<?php

namespace App\Http\Requests\Admin\Article;

use App\Http\Requests\Admin\Request;
use Illuminate\Contracts\Validation\Validator;

class StoreRequest extends Request
{
    public function rules()
    {
        return [
            'category_ids' =>'required',
        ];
    }

    public function messages()
    {
        return [
            'category_ids.required'=>'类别不能为空',
        ];
    }
}
