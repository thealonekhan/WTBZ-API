<?php
/**
 * Sponsor
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'Sponsor'], function () {
        Route::resource('sponsors', 'SponsorsController');
        //For Datatable
        Route::post('sponsors/get', 'SponsorsTableController')->name('sponsors.get');
    });
    
});