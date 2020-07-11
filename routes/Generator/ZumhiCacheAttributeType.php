<?php
/**
 * ZumhicacheAttributetypes
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'ZumhicacheAttributetypes'], function () {
        Route::resource('zumhicacheattributetypes', 'ZumhiCacheAttributeTypesController');
        //For Datatable
        Route::post('zumhicacheattributetypes/get', 'ZumhiCacheAttributeTypesTableController')->name('zumhicacheattributetypes.get');
    });
    
});