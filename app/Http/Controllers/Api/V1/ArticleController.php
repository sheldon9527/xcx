<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController;
use App\Transformers\ArticleTransformer;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends BaseController
{

    /**
     * @apiGroup articles
     * @apiDescription 获取文章
     *
     * @api {get} /api/articles 获取文章
     * @apiVersion 0.2.0
     * @apiPermission none
     * @apiParam {integer} [page] 页码
     * @apiParam {integer} [type] 类型id
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 200 OK
     *{
     *    "data": [
     *        {
     *            "id": 25,
     *            "user_name": "凡小西",
     *            "title": "求助：18岁儿子抽屉有开封的避孕套",
     *            "cover_image": "https://mmbiz.qpic.cn/mmbiz_jpg/pZxuQGABsPl5QmYZqsrSwibll8lDQPLicZaibWECwYbxsUKibEkLpjzprviaZqQYkBysNEoYHen90uMrmj19OeFu4zw/640?wx_fmt=jpeg",
     *            "url": "https://mp.weixin.qq.com/s/JWdbZZ-wCv383NHeTBJEZw",
     *            "status": "active",
     *            "content": "",
     *            "created_at": "2018-11-13 18:51:13",
     *            "updated_at": "2018-11-13 18:51:13"
     *        },
     *        {
     *            "id": 29,
     *            "user_name": "凡小西",
     *            "title": "求助：18岁儿子抽屉有开封的避孕套",
     *            "cover_image": "https://mmbiz.qpic.cn/mmbiz_jpg/pZxuQGABsPl5QmYZqsrSwibll8lDQPLicZaibWECwYbxsUKibEkLpjzprviaZqQYkBysNEoYHen90uMrmj19OeFu4zw/640?wx_fmt=jpeg",
     *            "url": "https://mp.weixin.qq.com/s/JWdbZZ-wCv383NHeTBJEZw",
     *            "status": "active",
     *            "content": "",
     *            "created_at": "2018-11-13 18:51:21",
     *            "updated_at": "2018-11-13 18:51:21"
     *        }
     *    ],
     *    "meta": {
     *        "pagination": {
     *            "total": 19,
     *            "count": 9,
     *            "per_page": 10,
     *            "current_page": 2,
     *            "total_pages": 2,
     *            "links": {
     *                "previous": "http://www.xcx.me/api/articles?page=1"
     *            }
     *        }
     *    }
     *}
     */
    public function index(Request $request)
    {
        $page = $request->get('page');
        $articles = Article::where('articles.status', 'active');
        if ($typeId = $request->get('type')) {
            $articles = $articles->whereHas('categories', function ($item) use ($typeId) {
                $item->where('article_category.category_id', $typeId);
            });
        }
        $articles = $articles->paginate(10);

        return $this->response->paginator($articles, new ArticleTransformer);
    }
}
