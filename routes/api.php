<?php

use Illuminate\Support\Facades\Route;

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth',
    'namespace' => 'Api'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::group([
    'namespace' => 'Api',
    // 'middleware' => 'JWT' 
], function() {
    Route::apiResource('employees', 'EmployeeController');
    Route::get('/suppliers/list', 'SupplierController@supplierList');
    Route::apiResource('suppliers', 'SupplierController');
    Route::get('/categories/list', 'CategoryController@categoryList');
    Route::apiResource('categories', 'CategoryController');
    Route::apiResource('products', 'ProductController');
    Route::apiResource('expenses', 'ExpenseController');
    Route::apiResource('customers', 'CustomerController');

    // Salary.
    Route::get('/salaries', 'SalaryController@index');
    Route::post('/salary/paid/{id}', 'SalaryController@paid');
    Route::get('/employees-salaries', 'SalaryController@employeesSalaries');
    Route::get('/salary/view/{id}', 'SalaryController@viewSalary');
    Route::get('/salary/show/{id}', 'SalaryController@show');
    Route::post('/salary/update/{id}', 'SalaryController@update');
});