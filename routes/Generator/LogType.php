<?php
/**
 * LogType
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'LogType'], function () {
        Route::resource('logtypes', 'LogTypesController');
        //For Datatable
        Route::post('logtypes/get', 'LogTypesTableController')->name('logtypes.get');
    });
    
});