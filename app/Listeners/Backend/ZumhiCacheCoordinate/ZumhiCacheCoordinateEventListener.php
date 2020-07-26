<?php

namespace App\Listeners\Backend\ZumhiCacheCoordinate;

class ZumhiCacheCoordinateEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'Coordinates';


    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->zumhicachecoordinate->id)
            ->withText('trans("history.backend.zumhicachecoordinate.created") <strong>'.$event->zumhicachecoordinate->name.'</strong>')
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
            ->withEntity($event->zumhicachecoordinate->id)
            ->withText('trans("history.backend.zumhicachecoordinate.updated") <strong>'.$event->zumhicachecoordinate->name.'</strong>')
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
            ->withEntity($event->zumhicachecoordinate->id)
            ->withText('trans("history.backend.zumhicachecoordinate.deleted") <strong>'.$event->zumhicachecoordinate->name.'</strong>')
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
            \App\Events\Backend\ZumhiCacheCoordinate\ZumhiCacheCoordinateCreated::class,
            'App\Listeners\Backend\ZumhiCacheCoordinate\ZumhiCacheCoordinateEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\ZumhiCacheCoordinate\ZumhiCacheCoordinateUpdated::class,
            'App\Listeners\Backend\ZumhiCacheCoordinate\ZumhiCacheCoordinateEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\ZumhiCacheCoordinate\ZumhiCacheCoordinateDeleted::class,
            'App\Listeners\Backend\ZumhiCacheCoordinate\ZumhiCacheCoordinateEventListener@onDeleted'
        );
    }
}
