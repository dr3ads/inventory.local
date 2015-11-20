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
Route::resource('inventory', 'ItemsController');

Route::get('transactions/repawn/{id}', 'TransactionsController@repawn');
Route::post('transactions/repawn', 'TransactionsController@storeRepawn');
Route::get('transactions/renew/{id}', 'TransactionsController@reNew');
Route::post('transactions/renew', 'TransactionsController@storeReNew');
Route::get('transactions/claim/{id}', 'TransactionsController@claim');
Route::post('transactions/claim', 'TransactionsController@storeClaim');
Route::get('transactions/show_all/{id}', 'TransactionsController@showAll');
Route::get('transactions/show/{id}', 'TransactionsController@show');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
