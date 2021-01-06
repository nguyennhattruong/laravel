<?php

Route::group([
    'namespace' => 'App\Modules\Application\Controllers\Backend',
    'prefix' => 'admin',
    'middleware' => ['auth']
], function () {
    Route::get('products', 'ProductsController@index')->name('ProductsIndex');
    Route::get('products/edit', 'ProductsController@create')->name('ProductsInsert');
    Route::post('products/edit', 'ProductsController@store');
    Route::get('products/edit/{id}', 'ProductsController@edit')->name('ProductsEdit');
    Route::post('products/edit/{id}', 'ProductsController@update');
    Route::post('products/manage', 'ProductsController@manage')->name('ProductsManage');

    Route::get('products_categories', 'ProductsCategoriesController@index')->name('ProductsCategoriesIndex');
    Route::get('products_categories/edit', 'ProductsCategoriesController@create')->name('ProductsCategoriesInsert');
    Route::post('products_categories/edit', 'ProductsCategoriesController@store');
    Route::get('products_categories/edit/{id}', 'ProductsCategoriesController@edit')->name('ProductsCategoriesEdit');
    Route::post('products_categories/edit/{id}', 'ProductsCategoriesController@update');
    Route::post('products_categories/manage', 'ProductsCategoriesController@manage')->name('ProductsCategoriesManage');
});
