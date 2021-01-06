<?php
// Admin area
Route::group([
    'namespace' => 'App\Modules\Application\Controllers\Backend',
    'prefix' => 'admin',
    'middleware' => ['auth']
], function () {
    // Home
    Route::get('/', 'HomeController@index')->name('admin');

    // BEGIN: GROUP SYSTEM
    Route::get('config/general', 'ConfigController@general')->name('ConfigGeneral');
    Route::post('config/general', 'ConfigController@generalPost');

    Route::get('config/mail', 'ConfigController@mail')->name('ConfigMail');
    Route::post('config/mail', 'ConfigController@mailPost');
    // END: GROUP SYSTEM

    // BEGIN: MEDIA
    Route::get('media', 'MediaController@index')->name('Media');
    // END: MEDIA

    // BEGIN: OPTIMIZATION
    Route::get('tool/clean_system', 'ToolController@cleanSystem');
    Route::post('tool/clean_system', 'ToolController@cleanSystemPost');
    // END: OPTIMIZATION

    // BEGIN: SEO & TOOLS
    Route::get('config/metadata', 'ConfigController@metadata')->name('ConfigMetadata');
    Route::post('config/metadata', 'ConfigController@metadataPost');

    Route::get('config/embed_script', 'ConfigController@embedScript')->name('ConfigEmbedScript');
    Route::post('config/embed_script', 'ConfigController@embedScriptPost');

    Route::get('config/embed_css', 'ConfigController@embedCSS')->name('ConfigEmbedCSS');
    Route::post('config/embed_css', 'ConfigController@embedCSSPost');

    Route::get('config/embed_link', 'ConfigController@embedLink')->name('ConfigEmbedLink');
    Route::post('config/embed_link', 'ConfigController@embedLinkPost');

    Route::get('config/design_content', 'ToolController@designContent')->name('DesignContent');
    // END: SEO & TOOLS

    // BEGIN: CONTENT
    Route::get('content', 'ContentController@index')->name('ContentIndex');
    Route::get('content/edit', 'ContentController@create')
//        ->middleware('can:update,App\Modules\Domain\Models\Content')
        ->name('ContentInsert');
    Route::post('content/edit', 'ContentController@store');
    Route::get('content/edit/{id}', 'ContentController@edit')->name('ContentEdit');
    Route::post('content/edit/{id}', 'ContentController@update');
    Route::post('content/manage', 'ContentController@manage')->name('ContentManage');
    Route::post('content/ajax_upload', 'ContentController@ajaxUpload')->name('ContentAjaxUpload');

    Route::get('categories', 'CategoriesController@index')->name('CategoriesIndex');
    Route::get('categories/edit', 'CategoriesController@create')->name('CategoriesInsert');
    Route::post('categories/edit', 'CategoriesController@store');
    Route::get('categories/edit/{id}', 'CategoriesController@edit')->name('CategoriesEdit');
    Route::post('categories/edit/{id}', 'CategoriesController@update');
    Route::post('categories/manage', 'CategoriesController@manage')->name('CategoriesManage');
    // END: CONTENT

    Route::get('bill', 'BillController@index')->name('BillIndex');
    Route::get('bill/edit/{id}', 'BillController@edit')->name('BillEdit');
    Route::get('bill/update/{id}', 'BillController@update')->name('BillUpdate');
    Route::get('bill/delete/{id}', 'BillController@delete')->name('BillDelete');

    // BEGIN: PAGES
    Route::get('pages', 'PagesController@index')->name('PagesIndex');
    Route::get('pages/edit', 'PagesController@create')->name('PagesInsert');
    Route::post('pages/edit', 'PagesController@store');
    Route::get('pages/edit/{id}', 'PagesController@edit')->name('PagesEdit');
    Route::post('pages/edit/{id}', 'PagesController@update');
    Route::post('pages/manage', 'PagesController@manage')->name('PagesManage');
    // END: PAGES

    // BEGIN: TEMPLATE
    Route::get('widgets', 'WidgetsController@index')->name('WidgetsIndex');
    Route::get('widgets/{id}', 'WidgetsController@edit')->name('WidgetsEdit');
    Route::post('widgets/{id}', 'WidgetsController@update')->name('WidgetsUpdate');
    // END: TEMPLATE

    /*
    |--------------------------------------------------------------------------
    | Menu & Menu Types
    |--------------------------------------------------------------------------
    */
    Route::get('menu_types', 'MenuTypesController@index')->name('MenuTypesIndex');
    Route::get('menu_types/edit', 'MenuTypesController@create')->name('MenuTypesInsert');
    Route::post('menu_types/edit', 'MenuTypesController@store');
    Route::get('menu_types/edit/{id}', 'MenuTypesController@edit')->name('MenuTypesEdit');
    Route::post('menu_types/edit/{id}', 'MenuTypesController@update');
    Route::post('menu_types/manage', 'MenuTypesController@manage')->name('MenuTypesManage');

    Route::get('menu', 'MenuController@index')->name('MenuIndex');
    Route::get('menu/edit', 'MenuController@create')->name('MenuInsert');
    Route::post('menu/edit', 'MenuController@store');
    Route::get('menu/edit/{id}', 'MenuController@edit')->name('MenuEdit');
    Route::post('menu/edit/{id}', 'MenuController@update');
    Route::post('menu/manage', 'MenuController@manage')->name('MenuManage');

    /*
    |--------------------------------------------------------------------------
    | Users & Users Groups
    |--------------------------------------------------------------------------
    */
    Route::get('users', 'UsersController@index')->name('UsersIndex');
    Route::post('users/manage', 'UsersController@manage')->name('UsersManage');
    Route::get('users/edit/{id}', 'UsersController@edit')->name('UsersEdit');
    Route::post('users/edit/{id}', 'UsersController@update');

    Route::get('users_groups', 'UsersGroupsController@index')->name('UsersGroupsIndex');
    Route::get('users_groups/edit', 'UsersGroupsController@create')->name('UsersGroupsInsert');
    Route::post('users_groups/edit', 'UsersGroupsController@store');
    Route::get('users_groups/edit/{id}', 'UsersGroupsController@edit')->name('UsersGroupsEdit');
    Route::post('users_groups/edit/{id}', 'UsersGroupsController@update');
    Route::post('users_groups/manage', 'UsersGroupsController@manage')->name('UsersGroupsManage');
});

Route::group([
    'namespace' => 'App\Modules\Application\Controllers\Backend\Api',
    'prefix' => 'admin',
    'middleware' => ['auth']
], function () {
    Route::post('api/widgets/store', 'WidgetsApiController@store')->name('WidgetStore');
    Route::put('api/widgets/update', 'WidgetsApiController@update')->name('WidgetUpdate');
    Route::delete('api/widgets/destroy/{id}', 'WidgetsApiController@destroy')->name('WidgetDestroy');

    // Products
    Route::delete('api/products/delete_image/{product_id}/{name}', 'ProductsApiController@destroyImage')->name('ProductsDeleteImage');
});
