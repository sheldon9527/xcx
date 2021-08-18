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
      * {
     *    "data": [
     *        {
     *            "id": 13,
     *            "user_name": "最暖心语录",
     *            "title": "饭前吃一物,排出体内10年湿，热，毒!健康又漂亮,神奇!",
     *            "cover_image": "https://mmbiz.qpic.cn/mmbiz_jpg/POnB6xNSXLWK5oicS25opsK28xnIjKl3gicB0S6wlsKM8M4hU5AlSjn1w5AfIIrScjCRJQuqsnP8v0N998bz9b8Q/640?wx_fmt=jpeg",
     *            "url": "https://mp.weixin.qq.com/s/px8X56klwle6tjZPcC2QAQ",
     *            "created_time": "2018-11-13"
     *        },
     *        {
     *            "id": 14,
     *            "user_name": "华商报汽车周刊",
     *            "title": "说说你对新能源的看法， 试试宝马的插电混动汽车......",
     *            "cover_image": "https://mmbiz.qpic.cn/mmbiz_jpg/Jyco923vDiajYuIQ4qmLjZKgxIwjHcItHUc5sxuh262to5yu9pMicsuDt2M8k3sozbvnRf5mpwS7ics5AaK7fyKtw/640?wx_fmt=jpeg",
     *            "url": "https://mp.weixin.qq.com/s/5hUEJjAHEkJG_tWVTJPBbw",
     *            "created_time": "2018-11-13"
     *        },
     *        {
     *            "id": 15,
     *            "user_name": "最美妆容",
     *            "title": "饭前吃一物,排出体内10年湿，热，毒!健康又漂亮,神奇!",
     *            "cover_image": "https://mmbiz.qpic.cn/mmbiz_jpg/POnB6xNSXLWK5oicS25opsK28xnIjKl3gicB0S6wlsKM8M4hU5AlSjn1w5AfIIrScjCRJQuqsnP8v0N998bz9b8Q/640?wx_fmt=jpeg",
     *            "url": "https://mp.weixin.qq.com/s/eHxjSVshr1mE3At4O8iEtw",
     *            "created_time": "2018-11-13"
     *        },
     *    ],
     *    "meta": {
     *        "pagination": {
     *            "total": 19,
     *            "count": 10,
     *            "per_page": 10,
     *            "current_page": 1,
     *            "total_pages": 2,
     *            "links": {
     *                "next": "http://www.xcx.me/api/articles?page=2"
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
        $articles = $articles->orderBy(\DB::raw('RAND()'))->paginate(10);

        return $this->response->paginator($articles, new ArticleTransformer);
    }
}
