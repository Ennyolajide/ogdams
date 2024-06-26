<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/test', 'TestController@index')->name('test');
Route::get('/', 'HomeController@index')->name('index');
Route::get('/faq', 'HomeController@faq')->name('faq');
Route::get('/contact', 'HomeController@contact')->name('contact');

Route::get('/users/login', 'LoginController@index')->name('user.login');
Route::post('/users/login', 'LoginController@login')->name('user.login');
Route::get('/users/logout', 'LoginController@logout')->name('user.logout');
Route::get('/register/{referrer?}', 'RegisterController@index')->name('user.register');
Route::post('/register/create', 'RegisterController@register')->name('user.register.create');

Route::get('users/verify/{email}/{token}', 'VerificationController@verify');
Route::get('users/reset', 'PasswordResetController@index')->name('user.password.reset');
Route::post('users/password/reset', 'PasswordResetController@reset')->name('user.password.reset.request');
Route::get('users/reset/{email}/{token}', 'PasswordResetController@verify')->name('user.password.reset.verify');
Route::patch('users/reset/{email}/{token}', 'PasswordResetController@change')->name('user.password.reset.change');


Route::get('/dashboard', 'DashboardController@dashboardIndex')->name('dashboard.index');

//Profile
Route::get('/dashboard/profile', 'ProfileController@profileIndex')->name('user.profile');
Route::post('/dashboard/bank/add', 'BankController@storeBank')->name('user.bank.store');
Route::patch('/dashboard/bank/{bank}/delete', 'BankController@deleteBank')->name('user.bank.delete');
Route::post('/dashboard/bank/details', 'BankController@resolveBankDetails')->name('paystack.bankDetails');
Route::post('/dashboard/profile/password/edit', 'ProfileController@editPassword')->name('user.password.edit');
Route::post('/dashboard/profile/bvn/verify', 'BvnVerificationController@resolveBvnDetails')->name('user.bvn.details');
Route::post('/dashboard/profile/bvn/verify/otp', 'BvnVerificationController@verifyOtpAndDob')->name('user.bvn.otp.verify');

//Message
Route::get('/dashboard/inbox', 'MessageController@messageIndex')->name('messages.inbox');
Route::get('/dashboard/inbox/compose', 'MessageController@createMessage')->name('messages.compose');
Route::post('/dashboard/inbox/compose', 'MessageController@storeMessage')->name('messages.compose');
Route::get('/dashboard/inbox/{message}', 'MessageController@showMessage')->name('messages.message');
Route::post('/dashboard/inbox/{message}/reply', 'MessageController@replyMessage')->name('messages.reply');
Route::delete('/dashboard/inbox/{message}/delete', 'MessageController@deleteMessage')->name('messages.delete');

//Data
Route::get('/dashboard/data/prices', 'DataController@index')->name('data.prices');
Route::get('/dashboard/data/buy', 'DataController@create')->name('data.buy');
Route::post('/dashboard/data/buy', 'DataController@store')->name('data.buy');

//Airtime
//Route::get('dashboard/airtime/cash', 'AirtimeController@cash')->name('airtime.toCash');
//Route::post('dashboard/airtime/cash', 'AirtimeController@airtime2cash')->name('airtime.toCash');


//Route::get('dashboard/airtime/swap', 'AirtimeSwapController@index')->name('airtime.swap'); //not in use
//Route::post('dashboard/airtime/swap', 'AirtimeSwapController@store')->name('airtime.swap'); //not in use
//Route::patch('dashboard/airtime/swap/{airtimeRecord}', 'AirtimeSwapController@completed')->name('airtime.swap.completed'); // not in use
Route::get('dashboard/airtime/cash', 'AirtimeToCashController@index')->name('airtime.cash');
Route::post('dashboard/airtime/cash', 'AirtimeToCashController@store')->name('airtime.cash');
Route::patch('dashboard/airtime/cash/{airtimeRecord}', 'AirtimeToCashController@completed')->name('airtime.cash.completed');
//Wallet
Route::get('dashboard/wallet/fund', 'WalletController@index')->name('wallet.fund');
Route::post('dashboard/wallet/fund', 'WalletController@store')->name('wallet.fund');

//Route::get('dashboard/wallet/fund/airtime', 'AirtimeFundingController@display')->name('wallet.fund.airtime');// not in use
//Route::post('dashboard/wallet/fund/airtime', 'AirtimeFundingController@store')->name('wallet.fund.airtime');// not in use
//Route::patch('dashboard/wallet/fund/airtime/{airtimeRecord}', 'AirtimeFundingController@scompleted')->name('wallet.fund.airtime.completed');// not in use

Route::post('dashboard/wallet/fund/bank', 'BankTransferController@store')->name('wallet.fund.bank');
Route::patch('dashboard/wallet/fund/bank/{bankTransferRecord}', 'BankTransferController@completed')->name('wallet.fund.bank.completed');


Route::post('dashboard/wallet/fund/voucher', 'VoucherController@store')->name('wallet.fund.voucher');

//withdrawals
Route::get('dashboard/wallet/withdraw', 'WithdrawalController@index')->name('wallet.withdraw');
Route::post('dashboard/wallet/withdraw', 'WithdrawalController@store')->name('wallet.withdraw');

//Paystack
Route::post('dashboard/payments/card', 'PaystackController@redirectToGateway')->name('paystack.pay');
Route::get('dashboard/payments/callback', 'PaystackController@handleGatewayCallback')->name('paystack.callback');
Route::post('control/payments.query', 'PaystackController@queryPaysackTransaction')->name('paystack.transaction.query');
Route::post('payments/paystack/webhook', 'WebhookController@paystackHook')->name('paystack.webhook');

//Sms
Route::get('dashboard/sms/bulk/view', 'SmsController@display')->name('sms.bulk');
Route::post('dashboard/sms/bulk/send', 'SmsController@send')->name('sms.bulk');
Route::get('dashboard/sms/test', 'SmsController@test');
//Testimonials
Route::get('dashboard/testimonials', 'TestimonialController@index')->name('testimonials');
Route::post('dashboard/testimonials', 'TestimonialController@store')->name('testimonial.store');

/**
 * Bill Payments
 */
Route::namespace('Bills')->group(function () {

    Route::get('dashboard/bills/', 'RouteController@index')->name('bills');
    Route::get('dashboard/bills/tv/{product}', 'RouteController@tv')->name('bills.tv');
    Route::get('dashboard/bills/misc/{product}', 'RouteController@misc')->name('bills.misc');
    Route::get('dashboard/airtime/topup', 'AirtimeTopupController@index')->name('airtime.topup');
    Route::get('dashboard/bills/internet/{product}', 'RouteController@internet')->name('bills.internet');
    Route::get('dashboard/bills/electricity/{product}', 'RouteController@electricity')->name('bills.electricity');

    //post
    Route::post('misc/topup', 'MiscController@store')->name('bills.misc.topup');
    Route::post('dashboard/bills/tv/topup', 'TvController@store')->name('bills.tv.topup');
    Route::post('tv/validate/{provider}', 'TvController@validateSmartCard')->name('bills.tv.validate');
    Route::post('internet/topup', 'InternetController@store')->name('bills.internet.topup');
    Route::post('dashboard/airtime/topup', 'AirtimeTopupController@store')->name('airtime.topup');
    Route::post('electricity/topup', 'ElectricityController@store')->name('bills.electricity.topup');
    Route::post('electricity/{serviceId}/validate', 'ElectricityController@validateMeter')->name('bills.electricity.validate');
});


Route::get('dashboard/transactions', 'TransactionController@transactionIndex')->name('user.transactions');

/**
 * Bill Payments
 */
Route::namespace('Control')->middleware('admin')->group(function () {
    // Controllers Within The "App\Http\Controllers\Control" Namespace
    Route::get('control', 'ModController@index')->name('admin.index');
    Route::get('control/transactions', 'TransactionsController@show')->name('admin.transactions');
    Route::post('control/transactions', 'TransactionsController@searchTransactions')->name('admin.transaction.search');
    Route::get('control/transactions/search', 'TransactionsController@searchIndex')->name('admin.transaction.search.index');
    Route::get('control/transactions/user/{user}', 'TransactionsController@userTransactions')->name('admin.user.transactions');

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

    Route::get('control/paystack/transactions', 'FundingsController@paystackTransactions')->name('admin.paystack.transactions');

    //Withdrawal Dashbaord
    Route::patch('control/withdrawals/{trans}/edit', 'WithdrawalsController@edit')->name('admin.withdrawals.edit');
    Route::get('control/withdrawals', 'WithdrawalsController@show')->name('admin.withdrawals');


    //Configuaration index
    Route::get('settings', 'SettingsController@index')->name('admin.settings');
    Route::patch('settings/config/{setting}', 'SettingsController@edit')->name('admin.settings.edit');

    //Data configurations

    Route::get('settings/dataplan/{network}', 'DatasController@settings')->name('admin.dataplan');
    Route::post('settings/dataplan/{network}', 'DatasController@newDataPlan')->name('admin.dataplan.new');
    Route::patch('settings/dataplan/{network}/edit', 'DatasController@editDataPlan')->name('admin.dataplan.edit');
    Route::patch('settings/dataplan/{plan}/delete', 'DatasController@deleteDataPlan')->name('admin.dataplan.delete');
    Route::patch('settings/data/{network}/edit', 'DatasController@editDataPlanNotification')->name('admin.data.edit');
    Route::patch('settings/data/switch/{network}/edit', 'DatasController@editDataPlanSwitchSettings')->name('admin.data.switch.edit');

    //airtime configurations
    Route::get('settings/airtime/config', 'AirtimesController@settings')->name('admin.airtime.config');
    Route::patch('settings/airtime/{network}/edit', 'AirtimesController@editConfig')->name('admin.airtime.config.edit');
    Route::patch('settings/airtime/switch/{network}/edit', 'AirtimesController@configSwitch')->name('admin.airtime.switch.edit');

    //sms & service charges configurations
    Route::get('settings/charges/config', 'SmsChargesController@show')->name('admin.charges.config');
    Route::patch('settings/sms/{route}/edit', 'SmsChargesController@editSmsConfig')->name('admin.sms.config.edit');
    Route::patch('settings/charges/{service}/edit', 'SmsChargesController@editChargesConfig')->name('admin.charges.config.edit');

    //bills configurations
    Route::get('settings/bills/{product}', 'BillsController@show')->name('admin.bills.config');
    Route::patch('settings/bills/{subProduct}/edit', 'BillsController@edit')->name('admin.bill.config.edit');

    //Banks
    //Route::get('settings/banks', 'BanksController@bankSettings')->name('admin.banks'); // not in use

    //Users
    Route::get('control/users', 'UsersController@usersIndex')->name('admin.users');
    Route::get('control/user/{user}', 'UsersController@viewUser')->name('admin.user.view');
    Route::post('control/users', 'UsersController@searchUsers')->name('admin.users.search');
    Route::get('control/users/search', 'UsersController@searchIndex')->name('admin.user.search.index');
    Route::patch('control/user/{user}', 'UsersController@setUserStatus')->name('admin.toggle.user.status');
    Route::patch('control/user/balance/{user}/alter', 'UsersController@alterUserBalance')->name('admin.alter.user.balance');
});
