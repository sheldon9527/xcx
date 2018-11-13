<?php

namespace App\Models;

use Zizaco\Entrust\Traits\EntrustUserTrait;

class Admin extends BaseModel
{
    use EntrustUserTrait;

    protected $hidden = [
        'extra',
        'password',
        'deleted_at',
    ];

    protected $appends = ['login_at','table'];

    protected $casts = [
        'extra' => 'array',
    ];

    public $statusLabel = [
        'active' => '激活',
        'inactive' => '禁用',
    ];

    public function getLoginAttribute()
    {
        $time = strtotime($this->login_at)+8*60*60;
        return date('Y-m-d H:i:s', $time);
    }
    public function getTableAttribute()
    {
        return 'admins';
    }

    public function getAvatarAttribute()
    {
        return url(config('admin.defaultImg'));
    }

    public function getIsSuperAttribute()
    {
        return (bool) in_array($this->username, config('admin.super'));
    }
}
