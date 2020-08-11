<?php
/**
 * Trackable
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'Trackable'], function () {
        Route::resource('trackables', 'TrackablesController');
        //For Datatable
        Route::post('trackables/get', 'TrackablesTableController')->name('trackables.get');
    });
    
});