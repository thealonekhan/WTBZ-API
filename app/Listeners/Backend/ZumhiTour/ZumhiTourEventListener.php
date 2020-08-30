<?php

namespace App\Listeners\Backend\ZumhiTour;

class ZumhiTourEventListener
{

    
    /**
     * @var string
     */
    private $history_slug = 'Tour';


    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->zumhitour->id)
            ->withText('trans("history.backend.zumhitour.created") <strong>'.$event->zumhitour->name.'</strong>')
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
            ->withEntity($event->zumhitour->id)
            ->withText('trans("history.backend.zumhitour.updated") <strong>'.$event->zumhitour->name.'</strong>')
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
            ->withEntity($event->zumhitour->id)
            ->withText('trans("history.backend.zumhitour.deleted") <strong>'.$event->zumhitour->name.'</strong>')
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
            \App\Events\Backend\ZumhiTour\ZumhiTourCreated::class,
            'App\Listeners\Backend\ZumhiTour\ZumhiTourEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\ZumhiTour\ZumhiTourUpdated::class,
            'App\Listeners\Backend\ZumhiTour\ZumhiTourEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\ZumhiTour\ZumhiTourDeleted::class,
            'App\Listeners\Backend\ZumhiTour\ZumhiTourEventListener@onDeleted'
        );
    }
}
