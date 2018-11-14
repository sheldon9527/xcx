<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController;
use App\Transformers\CategoryTransformer;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    /**
     * @apiGroup categories
     * @apiDescription 获取分类
     *
     * @api {get} /api/categories 获取分类
     * @apiVersion 0.2.0
     * @apiPermission none
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 200 OK
     */
    public function index(Request $request)
    {
        $categories = Category::where('parent_id', 0)->get();

        return $this->response->collection($categories, new CategoryTransformer);
    }
}
