<?php

namespace App\Listeners\Backend\ListZumhiCache;

class ListZumhiCacheEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'ListZumhiCache';


    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->listzumhicache->id)
            ->withText('trans("history.backend.listzumhicache.created") <strong>'.$event->listzumhicache->listItemName.'</strong>')
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
            ->withEntity($event->listzumhicache->id)
            ->withText('trans("history.backend.listzumhicache.updated") <strong>'.$event->listzumhicache->listItemName.'</strong>')
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
            ->withEntity($event->listzumhicache->id)
            ->withText('trans("history.backend.listzumhicache.deleted") <strong>'.$event->listzumhicache->listItemName.'</strong>')
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
            \App\Events\Backend\ListZumhiCache\ListZumhiCacheCreated::class,
            'App\Listeners\Backend\ListZumhiCache\ListZumhiCacheEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\ListZumhiCache\ListZumhiCacheUpdated::class,
            'App\Listeners\Backend\ListZumhiCache\ListZumhiCacheEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\ListZumhiCache\ListZumhiCacheDeleted::class,
            'App\Listeners\Backend\ListZumhiCache\ListZumhiCacheEventListener@onDeleted'
        );
    }
}
