<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'TransactionsController@index');

Route::resource('customers', 'CustomersController');
Route::resource('transactions', 'TransactionsController');

Route::get('dashboard', 'DashboardController@index');
Route::get('inventory', 'ItemsController@index');
Route::get('inventory/buy', 'ItemsController@buyItem');
Route::get('inventory/sell/{id}', 'ItemsController@sellItem');
Route::get('inventory/show/{id}', 'ItemsController@itemDetails');
Route::post('inventory/buy', array(
    'uses' => 'ItemsController@doBuyItem',
    'as' => 'item.buy'
));
Route::post('inventory/sell', array(
    'uses' => 'ItemsController@doSellItem',
    'as' => 'item.sell'
));


Route::get('alerts', 'AlertsController@index');

Route::get('transactions/repawn/{id}', 'TransactionsController@repawn');
Route::post('transactions/repawn', 'TransactionsController@storeRepawn');
Route::get('transactions/renew/{id}', 'TransactionsController@reNew');
Route::post('transactions/renew', 'TransactionsController@storeReNew');
Route::get('transactions/claim/{id}', 'TransactionsController@claim');
Route::post('transactions/claim', 'TransactionsController@storeClaim');
Route::get('transactions/hold/{id}', 'TransactionsController@hold');
Route::post('transactions/hold', 'TransactionsController@storeHold');
Route::get('transactions/show_all/{id}', 'TransactionsController@showAll');
Route::get('transactions/show/{id}', 'TransactionsController@show');

Route::get('misc', 'MiscellaneousController@index');
Route::get('misc/earn', 'MiscellaneousController@createIn');
Route::get('misc/spend', 'MiscellaneousController@createOut');
Route::post('misc/store', 'MiscellaneousController@store');
// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
