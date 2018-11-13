<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
 * 运营后台
 */

Route::pattern('id', '[0-9]+');
Route::pattern('oid', '[0-9]+');
Route::pattern('alpha', '[A-Za-z]+');

// Route::view('/', 'index');
Route::get('/', function () {
    return redirect(route('dashboard'));
});
// 登录页面
Route::get('auth/login', [
    'as' => 'auth.login.get',
    'uses' => 'AuthController@getLogin',
]);

Route::get('dashboard', [
    'as' => 'dashboard',
    'uses' => 'AuthController@dashboard',
]);

Route::group(['namespace' => 'Admin', 'prefix' => 'manager'], function () {
    // 登录提交
    Route::post('auth/login', [
        'as' => 'admin.auth.login.post',
        'uses' => 'AuthController@postLogin',
    ]);
    Route::group(['middleware' => ['admin.auth']], function () {
        #登出
        Route::get('logout', [
            'as' => 'admin.auth.logout',
            'uses' => 'AuthController@logout',
        ]);
        // 后台统计信息
        Route::get('dashboard', [
            'as' => 'admin.dashboard',
            'uses' => 'DashboardController@dashboard',
        ]);
        /**
         * admins
         */
        Route::get('admins', [
            'as' => 'admin.admins.index',
            'uses' => 'AdminController@index',
        ]);
        Route::post('admins', [
            'as' => 'admin.admins.store',
            'uses' => 'AdminController@store',
        ]);
        Route::get('admins/{id}/edit', [
            'as' => 'admin.admins.edit',
            'uses' => 'AdminController@edit',
        ]);
        Route::put('admins/{id}', [
            'as' => 'admin.admins.update',
            'uses' => 'AdminController@update',
        ]);
        Route::get('admins/{id}', [
            'as' => 'admin.admins.show',
            'uses' => 'AdminController@show',
        ]);
        Route::delete('admins/{id}', [
            'as' => 'admin.admins.destroy',
            'uses' => 'AdminController@destroy',
        ]);
        Route::get('admins/roles', [
            'as' => 'admin.roles.index',
            'uses' => 'RoleController@index',
        ]);
        Route::get('admins/roles/{id}', [
            'as' => 'admin.roles.show',
            'uses' => 'RoleController@show',
        ]);
        Route::post('admins/roles', [
            'as' => 'admin.roles.store',
            'uses' => 'RoleController@store',
        ]);
        Route::delete('admins/roles/{id}', [
            'as' => 'admin.roles.destroy',
            'uses' => 'RoleController@destroy',
        ]);
        Route::delete('admins/roles/{id}', [
            'as' => 'admin.roles.destroy',
            'uses' => 'RoleController@destroy',
        ]);
        Route::get('admins/roles/{id}/permissions/edit', [
            'as' => 'admin.roles.permissions.edit',
            'uses' => 'RoleController@permissionEdit',
        ]);
        Route::put('admins/roles/{id}/permissions', [
            'as' => 'admin.roles.permissions.update',
            'uses' => 'RoleController@permissionUpdate',
        ]);
        Route::get('admins/permissions', [
            'as' => 'admin.permissions.index',
            'uses' => 'PermissionController@index',
        ]);
    });
});
