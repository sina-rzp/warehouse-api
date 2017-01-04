<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


// ADMIN PANEL ROUTES//
Route::group(['middleware' => ['web', 'admin'], 'prefix' => 'admin'], function()
{
	// route for dashboard
    Route::get('dashboard', 'Admin\AdminController@index');

    // [...] other routes

    // Dick CRUD: Define the resources for the entities you want to CRUD.
    \CRUD::resource('order', 'Admin\OrderCrudController');
    \CRUD::resource('product', 'Admin\ProductCrudController');
    \CRUD::resource('item', 'Admin\ItemCrudController');



});