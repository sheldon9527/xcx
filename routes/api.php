<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['namespace' => 'App\Http\Controllers\Api\V1'], function ($api) {
    $api->get('advertisers', [
        'as' => 'api.advertisers.index',
        'uses' => 'AdvertiserController@index'
    ]);
    $api->get('showReport', [
        'as' => 'api.advertisers.showReport',
        'uses' => 'AdvertiserController@showReport'
    ]);
    $api->get('clickReport', [
        'as' => 'api.advertisers.clickReport',
        'uses' => 'AdvertiserController@clickReport'
    ]);
});
