<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Api\V1', 'prefix' => 'v1', 'as' => 'v1.'], function () {
    Route::group(['prefix' => 'auth', 'middleware' => ['guest']], function () {
        Route::post('register', 'RegisterController@register');
        Route::post('social-register', 'RegisterController@social_register');
        Route::post('login', 'AuthController@login');
        // Password Reset
        Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
    });

    Route::group(['middleware' => ['auth:api']], function () {
        Route::group(['prefix' => 'auth'], function () {
            Route::post('logout', 'AuthController@logout');
            // Route::post('password/reset', 'ResetPasswordController@reset')->name('password.reset');
        });
        // Users
        Route::resource('users', 'UsersController', ['except' => ['create', 'edit']]);
        Route::post('users/delete-all', 'UsersController@deleteAll');
        //@todo need to change the route name and related changes
        Route::get('deactivated-users', 'DeactivatedUsersController@index');
        Route::get('deleted-users', 'DeletedUsersController@index');

        // Roles
        Route::resource('roles', 'RolesController', ['except' => ['create', 'edit']]);

        // Permission
        Route::resource('permissions', 'PermissionController', ['except' => ['create', 'edit']]);

        // Page
        Route::resource('pages', 'PagesController', ['except' => ['create', 'edit']]);

        // Faqs
        Route::resource('faqs', 'FaqsController', ['except' => ['create', 'edit']]);

        // Blog Categories
        Route::resource('blog_categories', 'BlogCategoriesController', ['except' => ['create', 'edit']]);

        // Blog Tags
        Route::resource('blog_tags', 'BlogTagsController', ['except' => ['create', 'edit']]);

        // Blogs
        Route::resource('blogs', 'BlogsController', ['except' => ['create', 'edit']]);

        // ZumhiCaches
        Route::resource('zumhicaches', 'ZumhiCacheController', ['except' => ['create', 'edit']]);
        Route::post('zumhicaches/search', 'ZumhiCacheController@search');

        // ZumhiCacheLogs
        Route::resource('zumhicachelogs', 'ZumhiCacheLogController');
        Route::get('zumhicaches/{referenceCode}/zumhicachelogs', 'ZumhiCacheLogController@index');
        
        // ZumhiCache Users
        Route::resource('zumhicacheusers', 'ZumhiCacheUserController', ['except' => ['create', 'edit']]);

        // ZumhiCache Sizes
        Route::resource('zumhicachesizes', 'ZumhiCacheSizeController', ['except' => ['create', 'edit']]);
        
        // ZumhiCache Types
        Route::resource('zumhicachetypes', 'ZumhiCacheTypeController', ['except' => ['create', 'edit']]);
        
        // Countries
        Route::resource('countries', 'CountryController', ['except' => ['create', 'edit']]);
        
        // Statuses
        Route::resource('statuses', 'StatusController', ['except' => ['create', 'edit']]);
        
        // Memberships
        Route::resource('zumhicache-memberships', 'ZumhiCacheMembershipController', ['except' => ['create', 'edit']]);
        
        // Attributes
        Route::resource('attributes', 'ZumhiCacheAttributeTypeController', ['except' => ['create', 'edit']]);
        
        // ZumhiCache Log Types
        Route::resource('zumhicachelogtypes', 'ZumhiCacheLogTypeController', ['except' => ['create', 'edit']]);
    });
});
