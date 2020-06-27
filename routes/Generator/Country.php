<?php
/**
 * Country
 *
 */
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
    
    Route::group( ['namespace' => 'Country'], function () {
        Route::resource('countries', 'CountriesController');
        //For Datatable
        Route::post('countries/get', 'CountriesTableController')->name('countries.get');
    });
    
});