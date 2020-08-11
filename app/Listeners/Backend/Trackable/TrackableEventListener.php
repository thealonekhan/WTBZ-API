<?php

namespace App\Listeners\Backend\Trackable;

class TrackableEventListener
{

    
    /**
     * @var string
     */
    private $history_slug = 'Trackable';


    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->trackable->id)
            ->withText('trans("history.backend.trackable.created") <strong>'.$event->trackable->name.'</strong>')
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
            ->withEntity($event->trackable->id)
            ->withText('trans("history.backend.trackable.updated") <strong>'.$event->trackable->name.'</strong>')
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
            ->withEntity($event->trackable->id)
            ->withText('trans("history.backend.trackable.deleted") <strong>'.$event->trackable->name.'</strong>')
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
            \App\Events\Backend\Trackable\TrackableCreated::class,
            'App\Listeners\Backend\Trackable\TrackableEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Trackable\TrackableUpdated::class,
            'App\Listeners\Backend\Trackable\TrackableEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Trackable\TrackableDeleted::class,
            'App\Listeners\Backend\Trackable\TrackableEventListener@onDeleted'
        );
    }
}
