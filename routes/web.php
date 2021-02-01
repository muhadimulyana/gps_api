<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/login/{uName}/{uPass}', 'LoginController@login');

// Info Device
$router->group(['prefix' => 'deviceInfo'], function () use ($router) {
    $router->get('/getDeviceInfo/{uDeviceId}/{uAppId}/{uName}', 'DeviceInfoController@show');
    $router->post('/getDevice', 'DeviceInfoController@getDevice');
    $router->post('/insert', 'DeviceInfoController@store');
});

// Rule Aplikasi
$router->group(['prefix' => 'appRule'], function () use ($router) {
    $router->get('/getRule/{uName}/{packageName}/{pageName}/{ruleName}', 'AppRuleController@show');
    $router->post('/getRule', 'AppRuleController@getRule');
    $router->post('/insert', 'AppRuleController@store');
    $router->patch('/update', 'AppRuleController@update');
});

// Info Aplikasi
$router->group(['prefix' => 'appInfo'], function () use ($router) {
    $router->get('/getAppInfo/{packageName}', 'AppInfoController@show');
    $router->post('/checkUpdate', 'AppInfoController@checkUpdate');
    $router->post('/insert', 'AppInfoController@store');
});

// GPS Routes
$router->group(['prefix' => 'gps'], function () use ($router) {
    $router->get('/getMarkers', 'GpsController@getMarkers');
    $router->post('/insert', 'GpsController@store');
});