<?php

namespace App\Http\Requests\Admin\Article;

use App\Http\Requests\Admin\Request;
use Illuminate\Contracts\Validation\Validator;

class UpdateRequest extends Request
{
    public function rules()
    {
        return [
            'category_ids' =>'required',
            'title' =>'required',
            'cover_image' =>'required',
        ];
    }

    public function messages()
    {
        return [
            'category_ids.required'=>'类别不能为空',
            'title.required'=>'标题不能为空',
            'cover_image.required'=>'图片不能为空',
        ];
    }
}
