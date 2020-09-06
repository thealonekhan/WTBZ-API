<?php
/**
 * ListZumhiCache
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'ListZumhiCache'], function () {
        Route::resource('listzumhicaches', 'ListZumhiCachesController');
        //For Datatable
        Route::post('listzumhicaches/get', 'ListZumhiCachesTableController')->name('listzumhicaches.get');
    });
    
});