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
    Route::get('all-expenses-view/{id}', 'ExpensesController@show')->name('all-expenses-view');
    Route::post('all-expenses-update', 'ExpensesController@update')->name('all-expenses-update');
    Route::post('all-expenses-delete', 'ExpensesController@destroyAllExpenses')->name('all-expenses-delete');
    Route::resource('drivers', 'DriverController');
    Route::post('driver-delete', 'DriverController@destroyDriver')->name('driver-delete');
    Route::resource('helpers', 'HelperController');
    Route::resource('trips', 'TripController');
    Route::post('trips-delete', 'TripController@destroyTrip')->name('trips-delete');
    Route::post('admin-trip-start', 'TripController@startTrip')->name('admin-trip-start');
    Route::post('admin-trip-stop', 'TripController@stopTrip')->name('admin-trip-stop');
    Route::resource('maintenance-type', 'MaintenanceTypeController');
    Route::resource('maintenance', 'MaintenanceController');
    Route::resource('trip-type', 'TripTypeController');
    Route::resource('settings', 'SettingsController');
    Route::resource('company', 'CompanyController');
    Route::get('all-vehicle-location', 'MapController@index')->name('all-vehicle-location');
    Route::get('vehicle-location/{id}', 'MapController@vehicleLocation')->name('vehicle-location');
    Route::get('device-location/{id}', 'MapController@deviceLocation')->name('device-location');
    Route::get('vehicle-device', 'VehicleDeviceController@index')->name('vehicle-device');
    Route::get('vehicle-device-create/{id}', 'VehicleDeviceController@create')->name('vehicle-device-create');
    Route::post('vehicle-device-store', 'VehicleDeviceController@store')->name('vehicle-device-store');
    Route::get('vehicle-device-edit/{id}', 'VehicleDeviceController@edit')->name('vehicle-device-edit');
    Route::post('vehicle-device-update', 'VehicleDeviceController@update')->name('vehicle-device-update');
    Route::get('device-temp-data/{id}', 'TemperatureDeviceDataController@tempDevice')->name('device-temp-data');
    Route::post('get-temp-device-data', 'TemperatureDeviceDataController@getTempDevice')->name('get-temp-device-data');
    Route::get('temp-device-report/{id}', 'TemperatureDeviceDataController@tempDeviceReport')->name('temp-device-report');
    Route::post('device-temp-data-paginate', 'TemperatureDeviceDataController@tempDeviceDataPaginate')->name('device-temp-data-paginate');
    Route::post('device-temp-dated-data', 'TemperatureDeviceDataController@tempDeviceDatedData')->name('device-temp-dated-data');
    Route::post('device-temp-export-as-excel', 'TemperatureDeviceDataController@tempDeviceDataExcelExport')->name('device-temp-export-as-excel');
    Route::get('all-reports', 'VehicleController@navReports')->name('all-reports');
    Route::post('report-paginate-render', 'VehicleController@reportPaginateRender')->name('report-paginate-render');
    Route::post('report-by-company', 'VehicleController@reportByCompany')->name('report-by-company');

    // Vehicle Report
    Route::get('vehicle-reports/{id}', 'DeviceDataController@index')->name('vehicle-reports');
    Route::post('vehicle-daily-report', 'DeviceDataController@datedReport')->name('vehicle-daily-report');
    Route::post('vehicle-daily-report-download', 'DeviceDataController@datedReportDownload')->name('vehicle-daily-report-download');
    Route::post('vehicle-daily-status-report', 'DeviceDataController@datedEngineStatusReport')->name('vehicle-daily-status-report');
    Route::post('vehicle-daily-status-report-download', 'DeviceDataController@datedEngineStatusDownload')->name('vehicle-daily-status-report-download');
    Route::post('vehicle-monthly-report', 'DeviceDataController@monthlyReport')->name('vehicle-monthly-report');
    Route::post('vehicle-monthly-report-download', 'DeviceDataController@monthlyReportDownload')->name('vehicle-monthly-report-download');

    // Expenses Report
    Route::get('expenses-reports', 'ExpensesReportController@index')->name('expenses-reports');
    Route::post('expenses-reports-by-expense-type', 'ExpensesReportController@reportByExpenseType')->name('expenses-reports-by-expense-type');
    Route::post('expenses-reports-download', 'ExpensesReportController@reportDownload')->name('expenses-reports-download');

    // Maintanance Report
    Route::get('maintenance-reports', 'MaintenanceReportController@index')->name('maintenance-reports');
    Route::post('maintenance-reports-generate', 'MaintenanceReportController@maintenanceReportGenerate')->name('maintenance-reports-generate');
    Route::post('maintenance-reports-download', 'MaintenanceReportController@maintenanceReportDownload')->name('maintenance-reports-download');

    // Trip Report
    Route::get('trip-reports', 'TripReportController@index')->name('trip-reports');
    Route::post('trip-reports-by-vehicle', 'TripReportController@reportByVehicle')->name('trip-reports-by-vehicle');
    Route::post('trip-reports-download', 'TripReportController@trpReportDownload')->name('trip-reports-download');

    // Driver
    Route::get('driver-dashboard', 'DriverDashboardController@index')->name('driver-dashboard');
    Route::get('driver-expenses', 'DriverExpensesController@index')->name('driver-expenses');
    Route::get('driver-expenses-create', 'DriverExpensesController@create')->name('driver-expenses-create');
    Route::post('driver-expenses-store', 'DriverExpensesController@store')->name('driver-expenses-store');
    Route::get('driver-expenses-edit/{id}', 'DriverExpensesController@edit')->name('driver-expenses-edit');
    Route::put('driver-expenses-update', 'DriverExpensesController@update')->name('driver-expenses-update');
    Route::post('driver-expenses-delete', 'DriverExpensesController@destroyDriverExpenses')->name('driver-expenses-delete');
    Route::get('trip-current', 'DriverTripController@currentTrip')->name('trip-current');
    Route::get('trip-old', 'DriverTripController@oldTrip')->name('trip-old');
    Route::post('trip-start', 'DriverTripController@startTrip')->name('trip-start');
    Route::post('trip-stop', 'DriverTripController@stopTrip')->name('trip-stop');
});

Route::get('/all-clear', function () {
    $exitCode = Artisan::call('config:clear');
    echo '<h1>Config cache cleared</h1>';
    $exitCode = Artisan::call('cache:clear');
    echo '<h1>Cache facade value cleared</h1>';
    $exitCode = Artisan::call('view:clear');
    echo '<h1>View cache cleared</h1>';
    $exitCode = Artisan::call('route:clear');
    echo '<h1>Route cache cleared</h1>';
});
