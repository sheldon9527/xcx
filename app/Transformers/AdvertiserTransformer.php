<?php

namespace App\Transformers;

use App\Models\Advertiser;
use League\Fractal\TransformerAbstract;

class AdvertiserTransformer extends TransformerAbstract
{
    public function transform(Advertiser $advertiser)
    {
        $advertiser->nid = $advertiser->adv_style_id;
        $advertiser->nname = $advertiser->name;
        $advertiser->type  = $advertiser->advertiser_category_id;

        return $advertiser->attributesToArray();
    }
}
