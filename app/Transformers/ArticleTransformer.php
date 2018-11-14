<?php

namespace App\Transformers;

use App\Models\Article;
use League\Fractal\TransformerAbstract;

class ArticleTransformer extends TransformerAbstract
{
    public function transform(Article $article)
    {
        unset($article['status'],$article['content'],$article['updated_at']);
        return $article->attributesToArray();
    }
}
