<?php

namespace App\Traits;

use App\Models\Advertiser;

trait AdvCache
{
    public static function saveAdvCache($application)
    {
        $advertisers = Advertiser::where('application_id', $application->id)->where('status', 'active')->orderBy('id', 'desc')->get();
        //文件缓存
        \Cache::store('file')->forever($application->appid, $advertisers);
        \Cache::store('file')->forever($application->appid.'_extra', $application->extra);
        //redis 缓存
        // $bool = \Cache::store('redis')->put($application->appid, $advertisers, 1440);

        return ;
    }
    public static function destroyCache($application)
    {
        //文件缓存
        if (\Cache::store('file')->has($application->appid)) {
            \Cache::store('file')->forget($application->appid);
            \Cache::store('file')->forget($application->appid.'_extra');
        }
        //redis 缓存
        // if (\Cache::store('redis')->has($application->appid)) {
        //     \Cache::store('redis')->forget($application->appid);
        // }

        return ;
    }

    public static function getAdvCache($appid)
    {
        //文件缓存
        $advertisers = \Cache::store('file')->get($appid);
        //redis 缓存
        // $advertisers = \Cache::store('redis')->get($appid);

        return $advertisers;
    }
}
