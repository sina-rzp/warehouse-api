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


// Route::group(['middleware' => 'web', 'prefix' => 'featured-brands'], function () {

//     Route::get('{title}', ['as' => 'featured-brand-product', 'uses' => 'BrandController@products'], function ($title) {});
//     Route::get('/', ['as' => 'featured-brands', 'uses' => 'BrandController@index'], function () {});

// });


//all the other PAGES
Route::get('{title}', ['middleware' => 'web', 'as' => 'other-page', 'uses' => 'PageController@index'] , function ($title) {});

// ADMIN PANEL ROUTES//
Route::group(['middleware' => ['web', 'admin'], 'prefix' => 'admin'], function()
{
    Route::get('dashboard', 'Admin\AdminController@index');

    // [...] other routes

    // Dick CRUD: Define the resources for the entities you want to CRUD.
    \CRUD::resource('order', 'Admin\OrderCrudController');
    \CRUD::resource('product', 'Admin\ProductCrudController');
    \CRUD::resource('item', 'Admin\ItemCrudController');



});