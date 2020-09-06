<?php
/**
 * ListType
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'ListType'], function () {
        Route::resource('listtypes', 'ListTypesController');
        //For Datatable
        Route::post('listtypes/get', 'ListTypesTableController')->name('listtypes.get');
    });
    
});