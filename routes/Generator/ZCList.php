<?php
/**
 * ZCList
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'ZCList'], function () {
        Route::resource('zclists', 'ZCListsController');
        //For Datatable
        Route::post('zclists/get', 'ZCListsTableController')->name('zclists.get');
    });
    
});