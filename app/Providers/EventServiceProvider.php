<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

/**
 * Class EventServiceProvider.
 */
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [];

    /**
     * Class event subscribers.
     *
     * @var array
     */
    protected $subscribe = [
        /*
         * Frontend Subscribers
         */

        /*
         * Auth Subscribers
         */
        \App\Listeners\Frontend\Auth\UserEventListener::class,

        /*
         * Backend Subscribers
         */

        /*
         * Access Subscribers
         */
        \App\Listeners\Backend\Access\User\UserEventListener::class,
        \App\Listeners\Backend\Access\Role\RoleEventListener::class,
        \App\Listeners\Backend\Access\Permission\PermissionEventListener::class,
        \App\Listeners\Backend\Pages\PageEventListener::class,
        \App\Listeners\Backend\BlogCategories\BlogCategoryEventListener::class,
        \App\Listeners\Backend\BlogTags\BlogTagEventListener::class,
        \App\Listeners\Backend\Blogs\BlogEventListener::class,
        \App\Listeners\Backend\ZumhiCache\ZumhiCacheEventListener::class,
        \App\Listeners\Backend\ZumhiCacheUser\ZumhiCacheUserEventListener::class,
        \App\Listeners\Backend\ZumhiCacheAttribute\ZumhiCacheAttributeEventListener::class,
        \App\Listeners\Backend\ZumhiCacheAttributeType\ZumhiCacheAttributeTypeEventListener::class,
        \App\Listeners\Backend\ZumhiCacheLog\ZumhiCacheLogEventListener::class,
        \App\Listeners\Backend\ZumhiCacheCoordinate\ZumhiCacheCoordinateEventListener::class,
        \App\Listeners\Backend\Trackable\TrackableEventListener::class,
        \App\Listeners\Backend\TrackableLog\TrackableLogEventListener::class,
        \App\Listeners\Backend\UserWayPoint\UserWayPointEventListener::class,
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
