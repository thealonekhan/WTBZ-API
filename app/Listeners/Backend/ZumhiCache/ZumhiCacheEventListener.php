<?php

namespace App\Listeners\Backend\ZumhiCache;

class ZumhiCacheEventListener
{

    
    /**
     * @var string
     */
    private $history_slug = 'ZumhiCache';


    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->zumhicache->id)
            ->withText('trans("history.backend.zumhicache.created") <strong>'.$event->zumhicache->name.'</strong>')
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
            ->withEntity($event->zumhicache->id)
            ->withText('trans("history.backend.zumhicache.updated") <strong>'.$event->zumhicache->name.'</strong>')
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
            ->withEntity($event->zumhicache->id)
            ->withText('trans("history.backend.zumhicache.deleted") <strong>'.$event->zumhicache->name.'</strong>')
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
            \App\Events\Backend\ZumhiCache\ZumhiCacheCreated::class,
            'App\Listeners\Backend\ZumhiCache\ZumhiCacheEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\ZumhiCache\ZumhiCacheUpdated::class,
            'App\Listeners\Backend\ZumhiCache\ZumhiCacheEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\ZumhiCache\ZumhiCacheDeleted::class,
            'App\Listeners\Backend\ZumhiCache\ZumhiCacheEventListener@onDeleted'
        );
    }
}
