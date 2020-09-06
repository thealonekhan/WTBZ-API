<?php

namespace App\Events\Backend\ListZumhiCache;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ListZumhiCacheCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var
     */
    public $listzumhicache;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($listzumhicache)
    {
        $this->listzumhicache = $listzumhicache;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
