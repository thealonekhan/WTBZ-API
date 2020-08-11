<?php

namespace App\Listeners\Backend\TrackableLog;

class TrackableLogEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'TrackableLog';


    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->trackablelog->id)
            ->withText('trans("history.backend.trackablelog.created") <strong>'.$event->trackablelog->referenceCode.'</strong>')
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
            ->withEntity($event->trackablelog->id)
            ->withText('trans("history.backend.trackablelog.updated") <strong>'.$event->trackablelog->referenceCode.'</strong>')
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
            ->withEntity($event->trackablelog->id)
            ->withText('trans("history.backend.trackablelog.deleted") <strong>'.$event->trackablelog->referenceCode.'</strong>')
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
            \App\Events\Backend\TrackableLog\TrackableLogCreated::class,
            'App\Listeners\Backend\TrackableLog\TrackableLogEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\TrackableLog\TrackableLogUpdated::class,
            'App\Listeners\Backend\TrackableLog\TrackableLogEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\TrackableLog\TrackableLogDeleted::class,
            'App\Listeners\Backend\TrackableLog\TrackableLogEventListener@onDeleted'
        );
    }
}
