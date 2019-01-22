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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index')->middleware('auth');

//Message
Route::get('/dashboard/inbox', 'MessageController@index')->name('messages.inbox')->middleware('auth');
Route::get('/dashboard/inbox/compose', 'MessageController@create')->name('messages.compose')->middleware('auth');
Route::post('/dashboard/inbox/compose', 'MessageController@store')->name('messages.compose')->middleware('auth');
Route::get('/dashboard/inbox/{message}', 'MessageController@show')->name('messages.message')->middleware('auth');
Route::post('/dashboard/inbox/{message}/reply', 'MessageController@reply')->name('messages.reply')->middleware('auth');
Route::delete('/dashboard/inbox/{message}/delete', 'MessageController@delete')->name('messages.delete')->middleware('auth');

//Data
Route::get('/dashboard/data/prices', 'DataController@index')->name('data.prices')->middleware('auth');
Route::get('/dashboard/data/buy', 'DataController@create')->name('data.buy')->middleware('auth');
Route::post('/dashboard/data/buy', 'DataController@store')->name('data.buy')->middleware('auth');
//'DataController@index')->name('data.buy')->middleware('auth);

//Airtime
Route::get('dashboard/airtime/cash', 'AirtimeController@cash')->name('airtime.toCash')->middleware('auth');
Route::post('dashboard/airtime/cash', 'AirtimeController@airtime2cash')->name('airtime.toCash')->middleware('auth');
Route::get('dashboard/airtime/swap', 'AirtimeController@swap')->name('airtime.swap')->middleware('auth');
Route::post('dashboard/airtime/swap', 'AirtimeController@airtimeSwap')->name('airtime.swap')->middleware('auth');

//Wallet
Route::get('dashboard/wallet/fund', 'WalletController@create')->name('wallet.fund');
Route::post('dashboard/wallet/fund', 'WalletController@store')->name('wallet.fund');
Route::get('dashboard/wallet/fund/airtime', 'WalletController@airtime')->name('wallet.fund.airtime');
Route::post('dashboard/wallet/fund/bank', 'WalletController@fundWithBankTransfer')->name('wallet.fund.bank');
Route::post('dashboard/wallet/fund/voucher', 'VoucherController@fundWithVoucher')->name('wallet.fund.voucher');


Route::post('dashboard/wallet/fund/card/pay', 'PaymentController@redirectToGateway')->name('payWithPaystack');
Route::get('dashboard/payment/callback', 'PaymentController@handleGatewayCallback')->name('paymentCallback');



Route::get('faq', 'HomePageController@faq')->name('faq');
Route::get('contact', 'HomePageController@contact')->name('contact');
