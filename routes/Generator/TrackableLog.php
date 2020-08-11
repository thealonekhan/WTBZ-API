<?php
/**
 * TrackableLog
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'TrackableLog'], function () {
        Route::resource('trackablelogs', 'TrackableLogsController');
        //For Datatable
        Route::post('trackablelogs/get', 'TrackableLogsTableController')->name('trackablelogs.get');
    });
    
});