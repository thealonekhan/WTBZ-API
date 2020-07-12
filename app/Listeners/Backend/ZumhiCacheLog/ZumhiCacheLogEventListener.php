<?php

namespace App\Listeners\Backend\ZumhiCacheLog;

class ZumhiCacheLogEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'ZumhiCacheLog';


    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->zumhicachelog->id)
            ->withText('trans("history.backend.zumhicachelog.created") <strong>'.$event->zumhicachelog->referenceCode.'</strong>')
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
            ->withEntity($event->zumhicachelog->id)
            ->withText('trans("history.backend.zumhicachelog.updated") <strong>'.$event->zumhicachelog->referenceCode.'</strong>')
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
            ->withEntity($event->zumhicachelog->id)
            ->withText('trans("history.backend.zumhicachelog.deleted") <strong>'.$event->zumhicachelog->referenceCode.'</strong>')
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
            \App\Events\Backend\ZumhiCacheLog\ZumhiCacheLogCreated::class,
            'App\Listeners\Backend\ZumhiCacheLog\ZumhiCacheLogEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\ZumhiCacheLog\ZumhiCacheLogUpdated::class,
            'App\Listeners\Backend\ZumhiCacheLog\ZumhiCacheLogEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\ZumhiCacheLog\ZumhiCacheLogDeleted::class,
            'App\Listeners\Backend\ZumhiCacheLog\ZumhiCacheLogEventListener@onDeleted'
        );
    }
}
