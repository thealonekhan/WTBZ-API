<?php

namespace App\Listeners\Backend\ZCList;

class ZCListEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'List';


    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->zclist->id)
            ->withText('trans("history.backend.zclist.created") <strong>'.$event->zclist->name.'</strong>')
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
            ->withEntity($event->zclist->id)
            ->withText('trans("history.backend.zclist.updated") <strong>'.$event->zclist->name.'</strong>')
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
            ->withEntity($event->zclist->id)
            ->withText('trans("history.backend.zclist.deleted") <strong>'.$event->zclist->name.'</strong>')
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
            \App\Events\Backend\ZCList\ZCListCreated::class,
            'App\Listeners\Backend\ZCList\ZCListEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\ZCList\ZCListUpdated::class,
            'App\Listeners\Backend\ZCList\ZCListEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\ZCList\ZCListDeleted::class,
            'App\Listeners\Backend\ZCList\ZCListEventListener@onDeleted'
        );
    }
}
