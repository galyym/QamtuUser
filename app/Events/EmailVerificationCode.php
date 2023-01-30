<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EmailVerificationCode
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $verification_code;
    public $email;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($verification_code, $email)
    {
        $this->verification_code = $verification_code;
        $this->email = $email;
    }

//    /**
//     * Get the channels the event should broadcast on.
//     *
//     * @return \Illuminate\Broadcasting\Channel|array
//     */
//    public function broadcastOn()
//    {
//        return new PrivateChannel('channel-name');
//    }
}
