<?php
/**
 * ZumhicacheCoordinates
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'ZumhicacheCoordinates'], function () {
        Route::resource('zumhicachecoordinates', 'ZumhiCacheCoordinatesController');
        //For Datatable
        Route::post('zumhicachecoordinates/get', 'ZumhiCacheCoordinatesTableController')->name('zumhicachecoordinates.get');
    });
    
});