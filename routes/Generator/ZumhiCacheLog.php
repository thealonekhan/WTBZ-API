<?php
/**
 * ZumhicacheLog
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'ZumhicacheLog'], function () {
        Route::resource('zumhicachelogs', 'ZumhiCacheLogsController');
        //For Datatable
        Route::post('zumhicachelogs/get', 'ZumhiCacheLogsTableController')->name('zumhicachelogs.get');
    });
    
});