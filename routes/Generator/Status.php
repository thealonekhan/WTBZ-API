<?php
/**
 * Status
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'Status'], function () {
        Route::resource('statuses', 'StatusesController');
        //For Datatable
        Route::post('statuses/get', 'StatusesTableController')->name('statuses.get');
    });
    
});