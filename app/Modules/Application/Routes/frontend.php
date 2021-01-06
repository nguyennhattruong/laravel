<?php

// Site Area
Route::group([
    'namespace' => 'App\Modules\Application\Controllers\Frontend'
], function () {
    Route::get('/', 'HomeController@index')->name('SiteIndex');
    Route::get('the-loai/{alias}', 'CategoryController@category')->name('SiteCategory');
    Route::get('bai-viet/{alias}', 'ContentController@show')->name('SiteContent');
    Route::get('tin-tuc', 'ContentController@index')->name('SiteContentAll');
    Route::get('page/{alias}', 'PagesController@show')->name('SitePages');
    Route::get('lien-he', 'ContactController@index')->name('SiteContact');

    // Danh mục
    Route::get('danh-muc/{alias}', 'ProductController@category')->name('FrontendProductCategory');
    Route::get('gio-hang', 'ProductController@checkout')->name('FrontendProductCheckout');
    Route::get('thanh-toan', 'ProductController@finish_checkout')->name('FrontendProductFinishCheckout');
    Route::post('gio-hang', 'ProductController@updateCart')->name('FrontendProductUpdateCart');
    Route::get('san-pham/{alias}', 'ProductController@show')->name('FrontendProduct');

    Route::get('sitemap', function () {
        $service = new \App\Modules\Domain\Services\Handle\SitemapServiceHandle();
        $service->storeSiteMap();
    });
});

Route::group([
    'namespace' => 'App\Modules\Application\Controllers\Frontend\Api'
], function () {
    Route::post('api/contact/add', 'ContactApiController@store')->name('ContactSend');

    Route::post('api/products/add_cart', 'CartApiController@addCart')->name('ApiProductAddCart');
    Route::post('api/products/delete_cart', 'CartApiController@deleteCart')->name('ApiProductDeleteCart');
    Route::delete('api/products/delete_cart/{id}', 'CartApiController@deleteCartById')->name('ApiProductDeleteCartById');
    Route::get('api/products/get_list', 'ProductApiController@getListProductByPageAndCategory')->name('ApiGetListProductByPageAndCategory');
});
