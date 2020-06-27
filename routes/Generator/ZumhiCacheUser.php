<?php
/**
 * ZumhicacheUser
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'ZumhicacheUser'], function () {
        Route::resource('zumhicacheusers', 'ZumhiCacheUsersController');
        //For Datatable
        Route::post('zumhicacheusers/get', 'ZumhiCacheUsersTableController')->name('zumhicacheusers.get');
    });
    
});