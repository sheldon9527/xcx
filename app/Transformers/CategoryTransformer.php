<?php

namespace App\Transformers;

use App\Models\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    public function transform(Category $category)
    {
        unset($category['icon_url'],$category['parent_id']);
        return $category->attributesToArray();
    }
}
