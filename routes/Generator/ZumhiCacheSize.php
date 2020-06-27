<?php
/**
 * ZumhicacheSizes
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'ZumhicacheSizes'], function () {
        Route::resource('zumhicachesizes', 'ZumhiCacheSizesController');
        //For Datatable
        Route::post('zumhicachesizes/get', 'ZumhiCacheSizesTableController')->name('zumhicachesizes.get');
    });
    
});