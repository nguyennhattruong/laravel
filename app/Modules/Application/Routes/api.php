<?php

Route::group([
    'namespace' => 'App\Modules\Application\Controllers\Api',
    'prefix' => 'admin/api',
    'middleware' => ['auth']
//    'middleware' => ['auth:api']
], function () {
    Route::delete('documents_departments/{id}', 'DocumentsDepartmentsApiController@delete')->name('ApiDocumentsDepartmentsDelete');
    Route::delete('documents_types/{id}', 'DocumentsTypesApiController@delete')->name('ApiDocumentsTypesDelete');

    /*
    |--------------------------------------------------------------------------
    | Documents
    |--------------------------------------------------------------------------
    */
    Route::delete('documents/{id}', 'DocumentsApiController@delete')->name('ApiDocumentsDelete');
    Route::put('documents/{id}', 'DocumentsApiController@update')->name('ApiDocumentsUpdate');
});
