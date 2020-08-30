<?php

namespace App\Listeners\Backend\Sponsor;

class SponsorEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'Sponsor';


    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->sponsor->id)
            ->withText('trans("history.backend.sponsor.created") <strong>'.$event->sponsor->name.'</strong>')
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
            ->withEntity($event->sponsor->id)
            ->withText('trans("history.backend.sponsor.updated") <strong>'.$event->sponsor->name.'</strong>')
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
            ->withEntity($event->sponsor->id)
            ->withText('trans("history.backend.sponsor.deleted") <strong>'.$event->sponsor->name.'</strong>')
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
            \App\Events\Backend\Sponsor\SponsorCreated::class,
            'App\Listeners\Backend\Sponsor\SponsorEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Sponsor\SponsorUpdated::class,
            'App\Listeners\Backend\Sponsor\SponsorEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Sponsor\SponsorDeleted::class,
            'App\Listeners\Backend\Sponsor\SponsorEventListener@onDeleted'
        );
    }
}
