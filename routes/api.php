<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('user/auth', 'LoginController@login'); //working
Route::get('/user/info', 'DashboardController@info');
Route::get('/user/balance', 'DashboardController@balance');
Route::get('user/transactions', 'TransactionController@transactionIndex');
Route::get('user/transaction/{reference}', 'TransactionController@reference');


Route::get('/data/plans', 'DataController@DataPlans');
Route::post('/data/purchase', 'DataController@store');


Route::namespace('Bills')->group(function () {

    Route::get('/airtime/networks', 'AirtimeTopupController@networks'); //
    Route::post('/airtime/topup', 'AirtimeTopupController@store'); //

    Route::get('/bills/services', 'BillController@bills'); //

    Route::get('/bills/electricity/discos', 'ElectricityController@discos'); //
    Route::post('/bills/electricity/topup', 'ElectricityController@store'); //
    Route::post('/bills/electricity/{serviceId}/validate', 'ElectricityController@validateMeter'); //


    Route::get('/bills/misc/services', 'MiscController@serviceList'); //
    Route::post('/bills/misc/purchase', 'MiscController@store'); //

    Route::post('/bills/tv/topup', 'TvController@store'); //
    Route::get('/bills/tv/services', 'TvController@tvProviders'); //
    Route::get('/bills/tv/{provider}/packages', 'TvController@tvPackages'); //
    Route::post('/bills/tv/{serviceId}/validate', 'tvController@validateSmartCard'); //

});

Route::any('/bvn', function(){
    return [
        "status" =>  true,
        "message" => "BVN resolved",
        "data" => [
            "first_name" => "OLAJIDE",
            "last_name" => "ENISEYIN",
            "dob" => "31-Aug-91",
            "formatted_dob" => "1991-08-31",
            "mobile" => "07063637002",
            "bvn" => "22185705901"
        ],
        "meta" => [
            "calls_this_month" => 1,
            "free_calls_left" => 9
        ]
    ];
});
