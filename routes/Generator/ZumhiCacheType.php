<?php
/**
 * ZumhicacheTypes
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'ZumhicacheTypes'], function () {
        Route::resource('zumhicachetypes', 'ZumhiCacheTypesController');
        //For Datatable
        Route::post('zumhicachetypes/get', 'ZumhiCacheTypesTableController')->name('zumhicachetypes.get');
    });
    
});