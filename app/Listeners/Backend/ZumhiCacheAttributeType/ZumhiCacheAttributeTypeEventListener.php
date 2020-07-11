<?php

namespace App\Listeners\Backend\ZumhiCacheAttributeType;

class ZumhiCacheAttributeTypeEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'ZumhiCacheAttributeType';


    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->zumhicacheattributetype->id)
            ->withText('trans("history.backend.zumhicacheattributetype.created") <strong>'.$event->zumhicacheattributetype->name.'</strong>')
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
            ->withEntity($event->zumhicacheattributetype->id)
            ->withText('trans("history.backend.zumhicacheattributetype.updated") <strong>'.$event->zumhicacheattributetype->name.'</strong>')
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
            ->withEntity($event->zumhicacheattributetype->id)
            ->withText('trans("history.backend.zumhicacheattributetype.deleted") <strong>'.$event->zumhicacheattributetype->name.'</strong>')
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
            \App\Events\Backend\ZumhiCacheAttributeType\ZumhiCacheAttributeTypeCreated::class,
            'App\Listeners\Backend\ZumhiCacheAttributeType\ZumhiCacheAttributeTypeEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\ZumhiCacheAttributeType\ZumhiCacheAttributeTypeUpdated::class,
            'App\Listeners\Backend\ZumhiCacheAttributeType\ZumhiCacheAttributeTypeEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\ZumhiCacheAttributeType\ZumhiCacheAttributeTypeDeleted::class,
            'App\Listeners\Backend\ZumhiCacheAttributeType\ZumhiCacheAttributeTypeEventListener@onDeleted'
        );
    }
}
