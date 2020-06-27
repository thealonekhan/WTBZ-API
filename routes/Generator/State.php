<?php
/**
 * State
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'State'], function () {
        Route::resource('states', 'StatesController');
        //For Datatable
        Route::post('states/get', 'StatesTableController')->name('states.get');
    });
    
});