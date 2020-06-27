<?php
/**
 * Zumhicache
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'Zumhicache'], function () {
        Route::resource('zumhicaches', 'ZumhiCachesController');
        //For Datatable
        Route::post('zumhicaches/get', 'ZumhiCachesTableController')->name('zumhicaches.get');
        Route::post('zumhicaches/getstate', 'ZumhiCachesController@fecth_states')->name('zumhicaches.get-state');
    });
    
});