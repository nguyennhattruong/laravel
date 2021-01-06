<?php

Route::group([
    'namespace' => 'App\Modules\Application\Controllers\Backend',
    'prefix' => 'admin',
    'middleware' => ['auth']
], function () {
    Route::get('apartment', 'ApartmentController@index')->name('ApartmentIndex');
    Route::get('apartment/edit', 'ApartmentController@create')->name('ApartmentInsert');
    Route::post('apartment/edit', 'ApartmentController@store');
    Route::get('apartment/edit/{id}', 'ApartmentController@edit')->name('ApartmentEdit');
    Route::post('apartment/edit/{id}', 'ApartmentController@update');
    Route::post('apartment/manage', 'ApartmentController@manage')->name('ApartmentManage');

    Route::get('apartment-locations', 'ApartmentLocationsController@index')->name('ApartmentLocationsIndex');
    Route::get('apartment-locations/edit', 'ApartmentLocationsController@create')->name('ApartmentLocationsInsert');
    Route::post('apartment-locations/edit', 'ApartmentLocationsController@store');
    Route::get('apartment-locations/edit/{id}', 'ApartmentLocationsController@edit')->name('ApartmentLocationsEdit');
    Route::post('apartment-locations/edit/{id}', 'ApartmentLocationsController@update');
    Route::post('apartment-locations/manage', 'ApartmentLocationsController@manage')->name('ApartmentLocationsManage');

});

Route::group([
    'namespace' => 'App\Modules\Application\Controllers\Backend\Api',
    'prefix' => 'admin',
    'middleware' => ['auth']
], function () {
    // Apartment
    Route::delete('api/apartment/delete_image/{apartment_id}/{name}', 'ApartmentApiController@destroyImage')->name('ApartmentDeleteImage');
});