<?php
/**
 * UserWayPoint
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'UserWayPoint'], function () {
        Route::resource('userwaypoints', 'UserWayPointsController');
        //For Datatable
        Route::post('userwaypoints/get', 'UserWayPointsTableController')->name('userwaypoints.get');
    });
    
});