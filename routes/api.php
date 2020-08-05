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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('countries', 'CountryAPIController');

Route::resource('provinces', 'ProvinceAPIController');

Route::resource('cities', 'CityAPIController');

Route::resource('municipalities', 'MunicipalityAPIController');

Route::resource('neighborhoods', 'NeighborhoodAPIController');

Route::resource('accounts', 'AccountAPIController');

Route::resource('taxes', 'TaxAPIController');

Route::resource('statuses', 'StatusAPIController');

Route::resource('property_types', 'Property_typeAPIController');

Route::resource('properties', 'PropertyAPIController');

Route::resource('currencies', 'CurrencyAPIController');

Route::resource('expenses', 'ExpenseAPIController');

Route::resource('transaction_types', 'Transaction_typeAPIController');

Route::resource('publications', 'PublicationAPIController');

Route::resource('images', 'ImageAPIController');



Route::resource('transactions', 'TransactionAPIController');

Route::resource('features', 'FeatureAPIController');