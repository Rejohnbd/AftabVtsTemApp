<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('device-api-data', 'DeviceDataController@deviceApiPostData');
Route::get('device-temp-data/{id}/{temp}/{humi}/{status}', 'TemperatureDeviceDataController@tempDeviceApiData');
Route::get('iot_device/{id}/{temp}/{comp}/{status}', 'TemperatureDeviceDataController@iotDeviceApiData');
Route::post('device-data-with-fail', 'TemperatureDeviceDataController@deviceDataWithFailData');
// Route::post('daily-data', 'DeviceDataController@apiDailyResport');
