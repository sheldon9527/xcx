<?php

namespace App\Transformers;

use App\Models\Article;
use League\Fractal\TransformerAbstract;
use Carbon\Carbon;

class ArticleTransformer extends TransformerAbstract
{
    public function transform(Article $article)
    {
        unset($article['status'],$article['content'],$article['updated_at'],$article['created_at']);
        $article->created_time = Carbon::parse($article->created_at)->toDateString();
        $len = mb_strlen($article->title, 'utf-8');
        $article->title = ($len > 30) ? mb_substr($article->title, 0, 30, 'utf-8').'...':$article->title;

        return $article->attributesToArray();
    }
}
