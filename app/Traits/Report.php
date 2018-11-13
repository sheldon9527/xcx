<?php

namespace App\Traits;

use App\Models\Application;
use App\Models\Statistic;
use App\Models\Advertiser;
use App\Models\Visitor;
use App\Models\Download;
use App\Models\DownloadDetail;
use Carbon\Carbon;

trait Report
{
    /**
     * [showReport 展示]
     * @param  [type] $params [description]
     * @return [type]         [description]
     */
    public static function showReport($params)
    {
        /**
         * [判断是否存在 应用和广告]
         * @var [type]
         */
        $appid        = $params['appid'];
        $advId        = $params['adv_id'];
        $application  = Application::where('appid', $appid)->first();
        if (!$application) {
            return;
        }
        $advertiser   = Advertiser::where('id', $advId)->first();
        if (!$advertiser) {
            return;
        }
        /**
         * [DB 数据库事务]
         * @var [type]
         */
        \DB::transaction(function () use ($params, $application, $advertiser) {
            /**
             * [参数]
             * @var [type]
             */
            $userOnlyMark = $params['userOnlyMark'];
            $appid        = $params['appid'];
            $advId        = $params['adv_id'];
            $typeId       = $params['type_id'];
            // $time         = $params['time'];
            $sdkver       = $params['sdkver'];
            $appver       = $params['appver'];
            $client       = $params['client'];
            $countryCode  = $params['country_code'];
            $day = date('Y-m-d');
            /**
             * [$statisticInfo description]
             * @var [type]
             */
            $visitor  = Visitor::where('only_mark', $userOnlyMark)->where('application_id', $application->id)->where('day', $day)->first();
            if ($visitor) {
                $visitor->show_number = ($visitor->show_number + 1);
                $visitor->save();
            } else {
                $visitorInfo = new Visitor();
                $visitorInfo->application_id = $application->id;
                $visitorInfo->only_mark = $userOnlyMark;
                $visitorInfo->country_code = $countryCode;
                $visitorInfo->show_number = ($visitorInfo->show_number + 1);
                $visitorInfo->day         = $day;
                $visitorInfo->save();
            }
            /**
             * [$statisticInfo 数据分析]
             * @var [type]
             */
            $statisticInfo = Statistic::where('advertiser_category_id', $advertiser->advertiser_category_id)
                ->where('application_id', $application->id)
                ->where('advertiser_id', $advId)
                ->where('adv_style_id', $typeId)
                ->where('sdkver', $sdkver)
                ->where('appver', $appver)
                ->where('day', $day)
                ->first();
            if ($statisticInfo) {
                $statisticInfo->show_number = ($statisticInfo->show_number + 1);
                $statisticInfo->updated_at  = date('Y-m-d h:i:s');
                $statisticInfo->save();
            } else {
                $statistic = new Statistic();
                $statistic->user_id  = $application->user_id;
                $statistic->advertiser_category_id  = $advertiser->advertiser_category_id;
                $statistic->application_id  = $application->id;
                $statistic->advertiser_id  = $advId;
                $statistic->adv_style_id  = $typeId;
                $statistic->show_number  = 1;
                $statistic->click_number  = 0;
                $statistic->sdkver  = $sdkver;
                $statistic->appver  = $appver;
                $statistic->day     = $day;

                $statistic->save();
            }
        });
    }

    /**
     * [clickReport 点击]
     * @param  [type] $params [description]
     * @return [type]         [description]
     */
    public static function clickReport($params)
    {
        /**
         * [判断是否存在 应用和广告]
         * @var [type]
         */
        $appid        = $params['appid'];
        $advId        = $params['adv_id'];
        $application  = Application::where('appid', $appid)->first();
        if (!$application) {
            return;
        }
        $advertiser   = Advertiser::where('id', $advId)->first();
        if (!$advertiser) {
            return;
        }
        /**
         * [DB 数据库事务]
         * @var [type]
         */
        \DB::transaction(function () use ($params, $application, $advertiser) {
            /**
             * [参数]
             * @var [type]
             */
            $userOnlyMark = $params['userOnlyMark'];
            $appid        = $params['appid'];
            $advId        = $params['adv_id'];
            $typeId       = $params['type_id'];
            // $time         = $params['time'];
            $sdkver       = $params['sdkver'];
            $appver       = $params['appver'];
            $client       = $params['client'];
            $countryCode  = $params['country_code'];
            $day = date('Y-m-d');
            /**
             * [$statisticInfo description]
             * @var [type]
             */
            $visitor  = Visitor::where('only_mark', $userOnlyMark)->where('application_id', $application->id)->where('day', $day)->first();
            if ($visitor) {
                $visitor->click_number = ($visitor->click_number + 1);
                $visitor->save();
            } else {
                $visitorInfo = new Visitor();
                $visitorInfo->application_id = $application->id;
                $visitorInfo->only_mark = $userOnlyMark;
                $visitorInfo->country_code = $countryCode;
                $visitorInfo->click_number = ($visitorInfo->click_number + 1);
                $visitorInfo->day          = $day;
                $visitorInfo->save();
            }

            /**
             * [$statisticInfo 数据分析]
             * @var [type]
             */
            $statisticInfo = Statistic::where('advertiser_category_id', $advertiser->advertiser_category_id)
                ->where('application_id', $application->id)
                ->where('advertiser_id', $advId)
                ->where('adv_style_id', $typeId)
                ->where('sdkver', $sdkver)
                ->where('appver', $appver)
                ->where('day', $day)
                ->first();
            if ($statisticInfo) {
                $statisticInfo->click_number = ($statisticInfo->click_number + 1);
                $statisticInfo->updated_at  = date('Y-m-d h:i:s');
                $statisticInfo->save();
            } else {
                $statistic = new Statistic();
                $statistic->user_id  = $application->user_id;
                $statistic->advertiser_category_id  = $advertiser->advertiser_category_id;
                $statistic->application_id  = $application->id;
                $statistic->advertiser_id  = $advId;
                $statistic->adv_style_id  = $typeId;
                $statistic->show_number  = $statistic->show_number;
                $statistic->click_number  = ($statistic->click_number + 1);
                $statistic->sdkver  = $sdkver;
                $statistic->appver  = $appver;
                $statistic->day     = $day;

                $statistic->save();
            }
        });
    }
    /**
     * [downloadReport下载上报]
     * @param  [type] $params [description]
     * @return [type]         [description]
     */
    public static function downloadReport($params)
    {
        /**
         * [参数]
         * @var [type]
         */
        if (!array_key_exists('userOnlyMark', $params)) {
            return;
        }
        if (!array_key_exists('country_code', $params)) {
            return;
        }
        $application  = Application::where('appid', trim($params['appid']))->first();
        if (!$application) {
            return;
        }
        /**
         * 开启事物
         */
        \DB::transaction(function () use ($params, $application) {
            $userOnlyMark = $params['userOnlyMark'];
            $appid        = $params['appid'];
            $countryCode  = $params['country_code'];
            $day = date('Y-m-d');
            $isNew = 1;
            //创建download
            $comeDownload  = Download::where('only_mark', $userOnlyMark)->where('application_id', $application->id)->first();
            if ($comeDownload) {
                $comeDownload->updated_at  = Carbon::now();
                $comeDownload->save();
                $isNew = 0;
            } else {
                $downloadInfo = new Download();
                $downloadInfo->application_id = $application->id;
                $downloadInfo->only_mark = $userOnlyMark;
                $downloadInfo->save();
            }
            /**
             * [$downloadDetail 创建DownloadDetail]
             * @var DownloadDetail
             */
            $comeDownloadDetail  = DownloadDetail::where('only_mark', $userOnlyMark)->where('application_id', $application->id)->where('day', $day)->first();
            if (!$comeDownloadDetail) {
                $downloadDetail = new DownloadDetail();
                $downloadDetail->application_id = $application->id;
                $downloadDetail->only_mark = $userOnlyMark;
                $downloadDetail->country_code = $countryCode;
                $downloadDetail->is_new = $isNew;
                $downloadDetail->day = $day;
                $downloadDetail->save();
            }
        });
    }
}
