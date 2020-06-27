<?php

namespace App\Listeners\Backend\ZumhiCacheUser;

class ZumhiCacheUserEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'ZumhiCacheUser';


    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->zumhicacheuser->id)
            ->withText('trans("history.backend.zumhicacheuser.created") <strong>'.$event->zumhicacheuser->referenceCode.'</strong>')
            ->withIcon('plus')
            ->withClass('bg-green')
            ->log();
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->zumhicacheuser->id)
            ->withText('trans("history.backend.zumhicacheuser.updated") <strong>'.$event->zumhicacheuser->referenceCode.'</strong>')
            ->withIcon('save')
            ->withClass('bg-aqua')
            ->log();
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->zumhicacheuser->id)
            ->withText('trans("history.backend.zumhicacheuser.deleted") <strong>'.$event->zumhicacheuser->referenceCode.'</strong>')
            ->withIcon('trash')
            ->withClass('bg-maroon')
            ->log();
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\ZumhiCacheUser\ZumhiCacheUserCreated::class,
            'App\Listeners\Backend\ZumhiCacheUser\ZumhiCacheUserEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\ZumhiCacheUser\ZumhiCacheUserUpdated::class,
            'App\Listeners\Backend\ZumhiCacheUser\ZumhiCacheUserEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\ZumhiCacheUser\ZumhiCacheUserDeleted::class,
            'App\Listeners\Backend\ZumhiCacheUser\ZumhiCacheUserEventListener@onDeleted'
        );
    }
}
