<?php

use Illuminate\Http\Request;

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

Route::get('/user', function (Request $request) {
    return 'olajide';
});

Route::post('/login', 'LoginController@login'); //working





Route::get('/balance', 'DashboardController@myBalance');
Route::get('/data/plans', 'DataController@DataPlans');
Route::post('/data/purchase', 'DataController@store');
Route::get('/transactions', 'TransactionController@transactionIndex');
Route::get('/transaction/{reference}', 'TransactionController@reference');

Route::namespace('Bills')->group(function () {
    Route::post('/airtime/purchase', 'AirtimeTopupController@store'); //
    Route::post('/bills/validation', 'BillController@billValidator'); //
    Route::get('/bills/services', 'BillController@servicesList'); //
    Route::get('/bills/service/{service}', 'BillController@serviceList');
    Route::post('/bills/electricity/topup', 'ElectricityController@store'); //
    Route::post('/bills/tv/topup', 'TvController@store');
    Route::post('/bills/internet/topup', 'InternetController@store');
    Route::post('/bills/misc/topup', 'MiscController@store');

    /*
    Route::post('misc/topup', 'MiscController@store')->name('bills.misc.topup');
    Route::post('dashboard/bills/tv/topup', 'TvController@store')->name('bills.tv.topup');

    Route::post('internet/topup', 'InternetController@store')->name('bills.internet.topup');
    Route::post('dashboard/airtime/topup', 'AirtimeTopupController@store')->name('airtime.topup');
    Route::post('electricity/topup', 'ElectricityController@store')->name('bills.electricity.topup');
    Route::post('electricity/validate', 'ElectricityController@validateMeter')->name('bills.electricity.validate');
    */
});
