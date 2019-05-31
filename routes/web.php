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

//Auth::routes();

//Auth
Route::get('users/login', 'LoginController@index')->name('user.login');
Route::post('users/login', 'LoginController@login')->name('user.login');
Route::get('users/logout', 'LoginController@logout')->name('user.logout');
Route::get('users/register', 'RegisterController@index')->name('user.register');
Route::post('users/register', 'RegisterController@register')->name('user.register');
Route::get('users/verify/{email}/{token}', 'VerificationController@verify');
Route::get('users/reset', 'PasswordResetController@index')->name('user.passwordReset');
Route::post('users/reset', 'PasswordResetController@reset')->name('user.passwordReset');

//user



//
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@index')->name('dashboard.index');
Route::get('/dashboard/profile', 'ProfileController@edit')->name('user.profile');

//Message
Route::get('/dashboard/inbox', 'MessageController@index')->name('messages.inbox');
Route::get('/dashboard/inbox/compose', 'MessageController@create')->name('messages.compose');
Route::post('/dashboard/inbox/compose', 'MessageController@store')->name('messages.compose');
Route::get('/dashboard/inbox/{message}', 'MessageController@show')->name('messages.message');
Route::post('/dashboard/inbox/{message}/reply', 'MessageController@reply')->name('messages.reply');
Route::delete('/dashboard/inbox/{message}/delete', 'MessageController@delete')->name('messages.delete');

//Data
Route::get('/dashboard/data/prices', 'DataController@index')->name('data.prices');
Route::get('/dashboard/data/buy', 'DataController@create')->name('data.buy');
Route::post('/dashboard/data/buy', 'DataController@store')->name('data.buy');

//Airtime
//Route::get('dashboard/airtime/cash', 'AirtimeController@cash')->name('airtime.toCash');
//Route::post('dashboard/airtime/cash', 'AirtimeController@airtime2cash')->name('airtime.toCash');

Route::get('dashboard/airtime/topup', 'AirtimeTopupController@index')->name('airtime.topup');
Route::post('dashboard/airtime/topup', 'AirtimeTopupController@store')->name('airtime.topup');
Route::get('dashboard/airtime/swap', 'AirtimeSwapController@index')->name('airtime.swap');
Route::post('dashboard/airtime/swap', 'AirtimeSwapController@store')->name('airtime.swap');
Route::get('dashboard/airtime/cash', 'AirtimeToCashController@index')->name('airtime.cash');

//Wallet
Route::get('dashboard/wallet/fund', 'WalletController@index')->name('wallet.fund');
Route::post('dashboard/wallet/fund', 'WalletController@store')->name('wallet.fund');

Route::get('dashboard/wallet/fund/airtime', 'AirtimeFundingController@show')->name('wallet.fund.airtime');
Route::post('dashboard/wallet/fund/airtime', 'AirtimeFundingController@store')->name('wallet.fund.airtime');

Route::post('dashboard/wallet/fund/bank', 'BankTransferController@create')->name('wallet.fund.bank');
Route::post('dashboard/wallet/fund/bank/pay', 'BankTransferController@store')->name('wallet.fund.bank.action');

Route::post('dashboard/wallet/fund/voucher', 'VoucherController@store')->name('wallet.fund.voucher');

//withdrawals
Route::get('dashboard/wallet/withdraw', 'WithdrawalController@index')->name('wallet.withdraw');
Route::post('dashboard/wallet/withdraw', 'WithdrawalController@store')->name('wallet.withdraw');

Route::post('dashboard/payments/card', 'PaystackController@redirectToGateway')->name('paystack.pay');
Route::get('dashboard/payments/callback', 'PaystackController@handleGatewayCallback')->name('paystack.callback');

Route::get('faq', 'HomePageController@faq')->name('faq');
Route::get('contact', 'HomePageController@contact')->name('contact');

//Coins
Route::get('dashboard/coins', 'CoinsController@index')->name('coins');
Route::get('dashboard/coins/buy/{coin}', 'CoinsController@buy')->name('coins.buy');
Route::post('dashboard/coins/buy/', 'CoinTransactionController@purchase')->name('coins.buy');
Route::get('dashboard/coins/sell/{coin}', 'CoinsController@sell')->name('coins.sell');
Route::post('dashboard/coins/sell/', 'CoinsController@save')->name('coins.sell');

/**
 * Bill Payments
 */
Route::get('dashboard/bills/', 'BillController@index')->name('bills');
Route::get('dashboard/bills/electricity/{product}', 'BillController@electricity')->name('bills.electricity');
Route::post('dashboard/bills/electricity/validate', 'BillController@validateEletcricityMeter')->name('bills.electricity.validate');
Route::get('dashboard/bills/tv/{product}', 'BillController@tv')->name('bills.tv');
Route::post('dashboard/bills/tv/validate', 'BillController@validateTvSmartCard')->name('bills.tv.validate');
Route::post('dashboard/bills/tv/topup', 'BillController@tvTopup')->name('bills.tv.topup');


Route::get('sms', ' NotificationController @sendSms ');
Route::get('dashboard/transactions', 'TransactionController@index')->name('user.transactions');
//Route::get(' ringo ', ' RingoApiController @test ');

Route::get('test', 'CurrencyConverterController@test');
