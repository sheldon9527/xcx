<?php

namespace App\Models;

class Article extends BaseModel
{
    public $statusLabel = [
        'active' => '激活',
        'inactive' => '禁用',
    ];

    public function getAvatarAttribute()
    {
        return url(config('admin.defaultImg'));
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }
}
