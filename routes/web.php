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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/register', function (){ return abort(404); });

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('dashboard')->middleware('role:admin')->group(function () {
    Route::get('/', 'Admin\DashboardController@index');

    Route::prefix('companies')->group(function () {
        Route::get('/', 'Admin\CompaniesController@companies');
        Route::get('/{id?}', 'Admin\CompaniesController@single_company');
        Route::post('/create', 'Admin\CompaniesController@create_company');
        Route::get('/remove/{id?}', 'Admin\CompaniesController@remove_company');
        Route::post('/update/{id?}', 'Admin\CompaniesController@update_company');
    });

    Route::prefix('employees')->group(function () {
        Route::get('/', 'Admin\EmployeesController@employees');
        Route::get('/{id?}', 'Admin\EmployeesController@single_employee');
        Route::post('/create', 'Admin\EmployeesController@create_employee');
        Route::get('/remove/{id?}', 'Admin\EmployeesController@remove_employee');
        Route::post('/update/{id?}', 'Admin\EmployeesController@update_employee');
    });
});