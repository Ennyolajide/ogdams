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
Route::get('/users/login', 'LoginController@index')->name('user.login');
Route::post('/users/login', 'LoginController@login')->name('user.login');
Route::get('/users/logout', 'LoginController@logout')->name('user.logout');
Route::get('/register', 'RegisterController@index')->name('user.register');
Route::post('/register', 'RegisterController@register')->name('user.register');
Route::get('/register/referrer/{wallet}', 'RegisterController@show')->name('user.register.referrer');

Route::get('users/verify/{email}/{token}', 'VerificationController@verify');
Route::get('users/reset', 'PasswordResetController@index')->name('user.passwordReset');
Route::post('users/reset', 'PasswordResetController@reset')->name('user.passwordReset');

//user



//
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@index')->name('dashboard.index');

//Profile
Route::get('/dashboard/profile/index', 'ProfileController@index')->name('user.profile');
Route::post('/bank/addBankDetails', 'BankController@addBankDetails')->name('user.addBankDetails');
Route::post('/bank/bankDetails', 'BankController@resolveBankDetails')->name('paystack.bankDetails');

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


Route::get('dashboard/airtime/swap', 'AirtimeSwapController@index')->name('airtime.swap');
Route::post('dashboard/airtime/swap', 'AirtimeSwapController@store')->name('airtime.swap');
Route::patch('dashboard/airtime/swap/{airtimeRecord}', 'AirtimeSwapController@completed')->name('airtime.swap.completed');
Route::get('dashboard/airtime/cash', 'AirtimeToCashController@index')->name('airtime.cash');
Route::post('dashboard/airtime/cash', 'AirtimeToCashController@store')->name('airtime.cash');
Route::patch('dashboard/airtime/cash/{airtimeRecord}', 'AirtimeToCashController@completed')->name('airtime.cash.completed');
//Wallet
Route::get('dashboard/wallet/fund', 'WalletController@index')->name('wallet.fund');
Route::post('dashboard/wallet/fund', 'WalletController@store')->name('wallet.fund');

Route::get('dashboard/wallet/fund/airtime', 'AirtimeFundingController@display')->name('wallet.fund.airtime');
Route::post('dashboard/wallet/fund/airtime', 'AirtimeFundingController@store')->name('wallet.fund.airtime');
Route::patch('dashboard/wallet/fund/airtime/{airtimeRecord}', 'AirtimeFundingController@scompleted')->name('wallet.fund.airtime.completed');

Route::post('dashboard/wallet/fund/bank', 'BankTransferController@store')->name('wallet.fund.bank');
Route::patch('dashboard/wallet/fund/bank/{bankTransferRecord}', 'BankTransferController@completed')->name('wallet.fund.bank.completed');


Route::post('dashboard/wallet/fund/voucher', 'VoucherController@store')->name('wallet.fund.voucher');

//withdrawals
Route::get('dashboard/wallet/withdraw', 'WithdrawalController@index')->name('wallet.withdraw');
Route::post('dashboard/wallet/withdraw', 'WithdrawalController@store')->name('wallet.withdraw');

//Paystack
Route::post('dashboard/payments/card', 'PaystackController@redirectToGateway')->name('paystack.pay');

Route::get('dashboard/payments/callback', 'PaystackController@handleGatewayCallback')->name('paystack.callback');

/* Route::get('faq', 'HomePageController@faq')->name('faq');
Route::get('contact', 'HomePageController@contact')->name('contact'); */

//Coins
Route::get('dashboard/coins', 'CoinsController@index')->name('coins');
Route::get('dashboard/coins/buy/{coin}', 'CoinsController@buy')->name('coins.buy');
Route::post('dashboard/coins/buy/', 'CoinTransactionController@purchase')->name('coins.buy');
Route::get('dashboard/coins/sell/{coin}', 'CoinsController@sell')->name('coins.sell');
Route::post('dashboard/coins/sell/', 'CoinsController@save')->name('coins.sell');

//Sms
Route::get('dashboard/sms/bulk', 'SmsController@display')->name('sms.bulk');
Route::post('dashboard/sms/bulk', 'SmsController@test')->name('sms.bulk');


/**
 * Bill Payments
 */
Route::namespace('Bills')->group(function () {
    // Controllers Within The "App\Http\Controllers\Bills" Namespace

    //get startimes bonquet
    //Route::get('dashboard', 'Bill');
    //get
    //Route::get('test', 'RingoController@test');
    Route::get('dashboard/bills/', 'RouteController@index')->name('bills');
    Route::get('dashboard/bills/tv/{product}', 'RouteController@tv')->name('bills.tv');
    Route::get('dashboard/bills/misc/{product}', 'RouteController@misc')->name('bills.misc');
    Route::get('dashboard/airtime/topup', 'AirtimeTopupController@index')->name('airtime.topup');
    Route::get('dashboard/bills/internet/{product}', 'RouteController@internet')->name('bills.internet');
    Route::get('dashboard/bills/electricity/{product}', 'RouteController@electricity')->name('bills.electricity');

    //post
    Route::post('misc/topup', 'MiscController@store')->name('bills.misc.topup');
    Route::post('dashboard/bills/tv/topup', 'TvController@store')->name('bills.tv.topup');
    Route::post('tv/validate', 'TvController@validateSmartCard')->name('bills.tv.validate');
    Route::post('internet/topup', 'InternetController@store')->name('bills.internet.topup');
    Route::post('dashboard/airtime/topup', 'AirtimeTopupController@store')->name('airtime.topup');
    Route::post('electricity/topup', 'ElectricityController@store')->name('bills.electricity.topup');
    Route::post('electricity/validate', 'ElectricityController@validateMeter')->name('bills.electricity.validate');
});








Route::get('sms', 'SmsController@test');
Route::get('dashboard/transactions', 'TransactionController@index')->name('user.transactions');
Route::get('test', 'TestController@index');


//Admin
Route::get('control/index', 'ModController@index')->name('admin.index');
Route::get('control/withdrawals', 'ModController@withdrawals')->name('admin.withdrawals');

/**
 * Bill Payments
 */
Route::namespace('Control')->group(function () {
    // Controllers Within The "App\Http\Controllers\Control" Namespace
    Route::get('control', 'ModController@index')->name('admin.index');

    //Airtime Dashbaord
    Route::patch('control/airtimes/funding/{trans}/edit', 'AirtimesController@funding')->name('admin.airtimes.fundings');
    Route::patch('control/airtimes/{trans}/edit', 'AirtimesController@edit')->name('admin.airtimes.edit');
    Route::get('control/airtimes', 'AirtimesController@show')->name('admin.airtimes');


    //Data Dashbaord
    Route::patch('control/datas/{trans}/edit', 'DatasController@edit')->name('admin.datas.edit');
    Route::get('control/datas', 'DatasController@show')->name('admin.datas');


    //Fundings Dashboard
    Route::patch('control/fundings/{trans}/edit', 'FundingsController@edit')->name('admin.fundings.edit');
    Route::get('control/fundings', 'FundingsController@show')->name('admin.fundings');



    //Withdrawal Dashbaord
    Route::patch('control/withdrawals/{trans}/edit', 'WithdrawalsController@edit')->name('admin.withdrawals.edit');
    Route::get('control/withdrawals', 'WithdrawalsController@show')->name('admin.withdrawals');


    //Configuaration index
    Route::get('settings', 'SettingsController@index')->name('admin.settings');

    //Data configurations
    Route::patch('settings/data/{network}/edit', 'DatasController@editPhone')->name('admin.data.edit');
    Route::get('settings/dataplan/{network}', 'DatasController@settings')->name('admin.dataplan');
    Route::post('settings/dataplan/{network}', 'DatasController@newDataPlan')->name('admin.dataplan.new');
    Route::patch('settings/dataplan/{network}/edit', 'DatasController@editDataPlan')->name('admin.dataplan.edit');

    //airtime configurations
    Route::get('settings/airtime/config', 'AirtimesController@settings')->name('admin.airtime.config');
    Route::patch('settings/airtime/{network}/edit', 'AirtimesController@editConfig')->name('admin.airtime.config.edit');

    //sms & service charges configurations
    Route::get('settings/charges/config', 'SmsChargesController@show')->name('admin.charges.config');
    Route::patch('settings/sms/{route}/edit', 'SmsChargesController@editSmsConfig')->name('admin.sms.config.edit');
    Route::patch('settings/charges/{service}/edit', 'SmsChargesController@editChargesConfig')->name('admin.charges.config.edit');

    //bills configurations
    Route::get('settings/bills/{product}', 'BillsController@show')->name('admin.bills.config');
    Route::patch('settings/bills/{subProduct}/edit', 'BillsController@edit')->name('admin.bill.config.edit');
});
