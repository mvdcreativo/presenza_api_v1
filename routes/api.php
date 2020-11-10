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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'Auth\AuthController@login');
    Route::post('signup', 'Auth\AuthController@signup');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('logout', 'Auth\AuthController@logout');
        Route::get('user', 'Auth\AuthController@user');
    });
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::apiResource('expenses_properties_users', 'ExpensesPropertiesUsersAPIController');
    
    
    Route::get('properties_user/{id}', 'UserAPIController@properties_user');
    Route::get('expenses_properties_users/user/{id}', 'ExpensesPropertiesUsersAPIController@user_expenses_all');
});

Route::apiResource('users', 'UserAPIController');

Route::apiResource('countries', 'CountryAPIController');

Route::apiResource('provinces', 'ProvinceAPIController');

Route::apiResource('cities', 'CityAPIController');

Route::apiResource('municipalities', 'MunicipalityAPIController');

Route::apiResource('neighborhoods', 'NeighborhoodAPIController');

Route::apiResource('accounts', 'AccountAPIController');

Route::apiResource('taxes', 'TaxAPIController');

Route::apiResource('statuses', 'StatusAPIController');

Route::apiResource('property_types', 'Property_typeAPIController');

Route::apiResource('properties', 'PropertyAPIController');

Route::apiResource('currencies', 'CurrencyAPIController');

Route::apiResource('expenses', 'ExpenseAPIController');

Route::apiResource('transaction_types', 'Transaction_typeAPIController');

Route::apiResource('publications', 'PublicationAPIController');

Route::apiResource('images', 'ImageAPIController');



Route::apiResource('transactions', 'TransactionAPIController');

Route::apiResource('features', 'FeatureAPIController');
Route::get('features_all', 'FeatureAPIController@all');


