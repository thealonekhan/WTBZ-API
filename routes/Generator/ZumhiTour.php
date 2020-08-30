<?php
/**
 * ZumhiTour
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'ZumhiTour'], function () {
        Route::resource('zumhitours', 'ZumhiToursController');
        //For Datatable
        Route::post('zumhitours/get', 'ZumhiToursTableController')->name('zumhitours.get');
    });
    
});