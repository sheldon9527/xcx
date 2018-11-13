<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Article\StoreRequest;
use App\Http\Requests\Admin\Article\IndexRequest;
use App\Models\Article;
use App\Models\Category;

class ArticleController extends BaseController
{
    /**
     * [index description]
     * @param  IndexRequest $request [description]
     * @return [type]                [description]
     */
    public function index(IndexRequest $request)
    {
        $advertisers = Article::query();
        if ($applicationId = $request->get('application_id')) {
            $advertisers->where('application_id', $applicationId);
        }
        if ($advertiserCategoryId = $request->get('advertiser_category_id')) {
            $advertisers->where('advertiser_category_id', $advertiserCategoryId);
        }
        if ($advStyleId = $request->get('adv_style_id')) {
            $advertisers->where('adv_style_id', $advStyleId);
        }
        if ($status = $request->get('status')) {
            $advertisers->where('status', $status);
        }
        $advertisers = $advertisers->orderBy('status', 'asc')->orderBy('id', 'desc')->paginate();
        $advStyles = AdvStyle::all();
        $advertiserCategories = AdvertiserCategory::all();
        $applications = Application::all();

        return view('admin.advertiser.index', compact('advertisers', 'advStyles', 'status', 'applicationId', 'advStyleId', 'advertiserCategories', 'advertiserCategoryId', 'applications'));

        return view('admin.articles.index');
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
        dd($request->all());
    }
}
