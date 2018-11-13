<?php
namespace App\Http\Controllers\Api\V1;

use App\Traits\AdvCache;
use App\Http\Controllers\Api\BaseController;
use App\Transformers\AdvertiserTransformer;
use Illuminate\Http\Request;
use App\Jobs\ShowReportQueue;
use App\Jobs\ClickReportQueue;
use App\Jobs\DownloadReportQueue;

class AdvertiserController extends BaseController
{
    use AdvCache;

    /**
     * @apiGroup advertiser
     * @apiDescription 获取广告
     *
     * @api {get} /api/advertisers 获取广告
     * @apiVersion 0.2.0
     * @apiPermission none
     * @apiParam {string} appid 应用的id
     * @apiParam {string} time  当前的时间
     * @apiParam {string} country_code  用户所属国家
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 200 OK
     *{
     *    "data": [
     *        {
     *            "id": 1,
     *            "key": "222",
     *            "key2": "333",
     *            "key3": "",
     *            "sdkid": "1111",
     *            "weight": 0,
     *            "priority": 12,
     *            "nid": 1,
     *            "nname": "Dresses",
     *            "type": 1
     *        },
     *        {
     *            "id": 2,
     *            "key": "9999",
     *            "key2": "888",
     *            "key3": "",
     *            "sdkid": "2222",
     *            "weight": 0,
     *            "priority": 0,
     *            "nid": 1,
     *            "nname": "admin",
     *            "type": 1
     *        }
     *    ],
     *    "meta": {
     *        "extra": {
     *            "cycle_time": "222",
     *            "report": "212",
     *            "adFill": "1"
     *        }
     *    }
     *}
     */
    public function index(Request $request)
    {
        $appid = trim($request->get('appid'));
        if (!$appid) {
            return $this->errorBadRequest(['appid没有传来']);
        }
        $advertisers = AdvCache::getAdvCache($appid);
        if (!$advertisers) {
            return $this->errorBadRequest(['appid错误或者广告未配置']);
        }
        $extra = \Cache::store('file')->get($appid.'_extra')?:[];
        if ($extra && array_key_exists('regions', $extra)) {
            $countryCode = $request->get('country_code');
            if ($countryCode && $extra['regions'] && is_array($extra['regions']) && !in_array($countryCode, $extra['regions'])) {
                return $this->errorBadRequest(['该国家被过滤掉']);
            }
            unset($extra['regions']);
        }
        /**
         * [放入下载的队列里面]
         */
        if ($params = $request->all()) {
            $downloadReportQueue = new DownloadReportQueue();
            $downloadReportQueue->setParams($params);
            //放入队列
            dispatch($downloadReportQueue)->onConnection('redis')->onQueue('download_report');
        }

        return $this->response->collection($advertisers, new AdvertiserTransformer)->addMeta('extra', $extra);
    }

    /**
     * @apiGroup advertiser
     * @apiDescription 展示广告的统计
     *
     * @api {get} /api/showReport 展示广告的统计
     * @apiVersion 0.2.0
     * @apiPermission none
     * @apiParam {string} userOnlyMark 用户唯一标示
     * @apiParam {string} appid 应用的id
     * @apiParam {string} adv_id 广告的id
     * @apiParam {string} type_id 广告的类型
     * @apiParam {string} time  当前的时间
     * @apiParam {string} sdkver 系统版本
     * @apiParam {string} appver app的版本号
     * @apiParam {string} client 手机型号
     * @apiParam {string} country_code  用户所属国家
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 200 OK
     * {
     * }
     */

    public function showReport(Request $request)
    {
        if ($params = $request->all()) {
            $showReportQueue = new ShowReportQueue();
            $showReportQueue->setParams($params);
            //放入队列
            dispatch($showReportQueue)->onConnection('redis')->onQueue('show_report');
        }

        return;
    }
    /**
     * @apiGroup advertiser
     * @apiDescription 点击广告的统计
     *
     * @api {get} /api/clickReport 点击广告的统计
     * @apiVersion 0.2.0
     * @apiPermission none
     * @apiParam {string} userOnlyMark 用户唯一标示
     * @apiParam {string} appid 应用的id
     * @apiParam {string} adv_id 广告的id
     * @apiParam {string} type_id 广告的类型
     * @apiParam {string} time  当前的时间
     * @apiParam {string} sdkver 系统版本
     * @apiParam {string} appver app的版本号
     * @apiParam {string} client 手机型号
     * @apiParam {string} country_code  用户所属国家
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 200 OK
     * {
     * }
     */
    public function clickReport(Request $request)
    {
        if ($params = $request->all()) {
            $clickReportQueue = new ClickReportQueue();
            $clickReportQueue->setParams($params);
            //放入队列
            dispatch($clickReportQueue)->onConnection('redis')->onQueue('click_report');
        }

        return;
    }
}
