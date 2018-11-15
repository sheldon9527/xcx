<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Article\StoreRequest;
use App\Http\Requests\Admin\Article\UpdateRequest;
use App\Http\Requests\Admin\Article\IndexRequest;
use App\Models\Article;
use App\Models\Category;
use QL\QueryList;

class ArticleController extends BaseController
{
    /**
     * [index description]
     * @param  IndexRequest $request [description]
     * @return [type]                [description]
     */
    public function index(IndexRequest $request)
    {
        $articles = Article::query();
        if ($status = $request->get('status')) {
            $articles->where('status', $status);
        }
        $articles = $articles->orderBy('status', 'asc')->orderBy('id', 'desc')->paginate();

        return view('admin.articles.index', compact('articles', 'status'));
    }
    /**
     * [create 创建公众号文章]
     * @return [type] [description]
     */
    public function create()
    {
        $categories = Category::where('parent_id', 0)->get();

        return view('admin.articles.create', compact('categories'));
    }
    /**
     * [store description]
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
        $categoryArray = $request->get('category_ids');
        $status = $request->get('status');
        $urlContents = $request->get('url_content');
        $content = str_replace(array("\r\n", "\r", "\n"), ";", $urlContents);
        $content = str_replace("\t", "", $content);
        $urls = explode(';', $content);
        foreach ($urls as $url) {
            $ql = QueryList::get(trim($url));
            $images = $ql->find('#js_content img')->attrs('data-src');
            $title  = $ql->find('title')->text();
            $aArray = $ql->find('#profileBt #js_name')->texts();
            $username = '未知';
            if (!empty($aArray->toArray())) {
                $username = $aArray[0];
            }
            $coverImage = '';
            if (!empty($images->toArray())) {
                $coverImage = $images[0];
            }
            $article  = new Article();
            $article->user_name = $username;
            $article->title = $title;
            $article->cover_image = $coverImage;
            $article->url = trim($url);
            $article->status = $status;
            $article->save();
            $article->categories()->attach($categoryArray);
        }

        return redirect(route('admin.articles.index'));
    }
    /**
     * [edit 编辑]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function edit($id)
    {
        $categories = Category::where('parent_id', 0)->get();

        return view('admin.articles.edit', compact('categories'));
    }
    /**
     * [update description]
     * @param  [type]        $id      [description]
     * @param  UpdateRequest $request [description]
     * @return [type]                 [description]
     */
    public function update($id, UpdateRequest $request)
    {
        // code...
    }
    /**
     * [destroy 删除]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        if (!$article) {
            abort(404);
        }
        $article->delete();

        return redirect(route('admin.articles.index'));
    }
}
