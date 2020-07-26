<?php

namespace App\Events\Backend\ZumhiCacheCoordinate;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ZumhiCacheCoordinateCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var
     */
    public $zumhicachecoordinate;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($zumhicachecoordinate)
    {
        $this->zumhicachecoordinate = $zumhicachecoordinate;
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
