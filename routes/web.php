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

Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', 'AdminController@index')->name('dasbboard');
    Route::resource('device-type', 'DeviceTypeController');
    Route::Post('device-type-delete', 'DeviceTypeController@destroDeviceType')->name('device-type-delete');
    Route::resource('devices', 'DeviceController');
    Route::post('devices-delete', 'DeviceController@destroyDevice')->name('devices-delete');
    Route::resource('vehicle-type', 'VehicleTypeController');
    Route::post('vehicle-type-delete', 'VehicleTypeController@destroyVehicleType')->name('vehicle-type-delete');
    Route::resource('vehicles', 'VehicleController');
    Route::post('vehicles-delete', 'VehicleController@destroyVehicle')->name('vehicles-delete');
    Route::resource('expenses-type', 'ExpensesTypeController');
    Route::post('expenses-type-delete', 'ExpensesTypeController@destroyExpensesType')->name('expenses-type-delete');
    Route::resource('all-expenses', 'ExpensesController');
    Route::post('all-expenses-delete', 'ExpensesController@destroyAllExpenses')->name('all-expenses-delete');
    Route::resource('drivers', 'DriverController');
    Route::post('driver-delete', 'DriverController@destroyDriver')->name('driver-delete');
    Route::resource('helpers', 'HelperController');
    Route::resource('trips', 'TripController');
    Route::post('trips-delete', 'TripController@destroyTrip')->name('trips-delete');
    Route::get('maps', 'MapController@index')->name('maps');
    Route::get('device-map/{id}', 'MapController@deviceMap')->name('device-map');
    Route::get('vehicle-device', 'VehicleDeviceController@index')->name('vehicle-device');
    Route::get('vehicle-device-create/{id}', 'VehicleDeviceController@create')->name('vehicle-device-create');
    Route::post('vehicle-device-store', 'VehicleDeviceController@store')->name('vehicle-device-store');
    Route::get('vehicle-device-edit/{id}', 'VehicleDeviceController@edit')->name('vehicle-device-edit');
    Route::post('vehicle-device-update', 'VehicleDeviceController@update')->name('vehicle-device-update');
    Route::get('temp-device/{id}', 'TemperatureDeviceDataController@tempDevice')->name('temp-device');
    Route::post('get-temp-device-data', 'TemperatureDeviceDataController@getTempDevice')->name('get-temp-device-data');
    Route::get('temp-device-report/{id}', 'TemperatureDeviceDataController@tempDeviceReport')->name('temp-device-report');
});
