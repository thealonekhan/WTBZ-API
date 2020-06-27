<?php
/**
 * ZumhicacheMemberships
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'ZumhicacheMemberships'], function () {
        Route::resource('zumhicachememberships', 'ZumhiCacheMembershipsController');
        //For Datatable
        Route::post('zumhicachememberships/get', 'ZumhiCacheMembershipsTableController')->name('zumhicachememberships.get');
    });
    
});