<?php

namespace App\Listeners\Backend\UserWayPoint;

class UserWayPointEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'UserWayPoint';


    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->userwaypoint->id)
            ->withText('trans("history.backend.userwaypoint.created") <strong>'.$event->userwaypoint->referenceCode.'</strong>')
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
            ->withEntity($event->userwaypoint->id)
            ->withText('trans("history.backend.userwaypoint.updated") <strong>'.$event->userwaypoint->referenceCode.'</strong>')
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
            ->withEntity($event->userwaypoint->id)
            ->withText('trans("history.backend.userwaypoint.deleted") <strong>'.$event->userwaypoint->referenceCode.'</strong>')
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
            \App\Events\Backend\UserWayPoint\UserWayPointCreated::class,
            'App\Listeners\Backend\UserWayPoint\UserWayPointEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\UserWayPoint\UserWayPointUpdated::class,
            'App\Listeners\Backend\UserWayPoint\UserWayPointEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\UserWayPoint\UserWayPointDeleted::class,
            'App\Listeners\Backend\UserWayPoint\UserWayPointEventListener@onDeleted'
        );
    }
}
