<?php
/**
 * ZumhicacheAttributes
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'ZumhicacheAttributes'], function () {
        Route::resource('zumhicacheattributes', 'ZumhiCacheAttributesController');
        //For Datatable
        Route::post('zumhicacheattributes/get', 'ZumhiCacheAttributesTableController')->name('zumhicacheattributes.get');
    });
    
});