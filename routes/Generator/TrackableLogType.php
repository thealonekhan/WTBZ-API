<?php
/**
 * TrackableLogType
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'TrackableLogType'], function () {
        Route::resource('trackablelogtypes', 'TrackableLogTypesController');
        //For Datatable
        Route::post('trackablelogtypes/get', 'TrackableLogTypesTableController')->name('trackablelogtypes.get');
    });
    
});