<?php

namespace App\Listeners\Backend\ZumhiCacheAttribute;

class ZumhiCacheAttributeEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'ZumhiCacheAttribute';


    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->zumhicacheattribute->id)
            ->withText('trans("history.backend.zumhicacheattribute.created") <strong>'.$event->zumhicacheattribute->name.'</strong>')
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
            ->withEntity($event->zumhicacheattribute->id)
            ->withText('trans("history.backend.zumhicacheattribute.updated") <strong>'.$event->zumhicacheattribute->name.'</strong>')
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
            ->withEntity($event->zumhicacheattribute->id)
            ->withText('trans("history.backend.zumhicacheattribute.deleted") <strong>'.$event->zumhicacheattribute->name.'</strong>')
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
            \App\Events\Backend\ZumhiCacheAttribute\ZumhiCacheAttributeCreated::class,
            'App\Listeners\Backend\ZumhiCacheAttribute\ZumhiCacheAttributeEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\ZumhiCacheAttribute\ZumhiCacheAttributeUpdated::class,
            'App\Listeners\Backend\ZumhiCacheAttribute\ZumhiCacheAttributeEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\ZumhiCacheAttribute\ZumhiCacheAttributeDeleted::class,
            'App\Listeners\Backend\ZumhiCacheAttribute\ZumhiCacheAttributeEventListener@onDeleted'
        );
    }
}
