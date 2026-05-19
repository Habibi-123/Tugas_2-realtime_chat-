<?php

namespace App\Events;

use App\Models\GroupMessage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GroupMessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(GroupMessage $message)
    {
        $this->message = $message->load('user');
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('group.' . $this->message->group_id),
        ];
    }

    public function broadcastAs(): string
    {
        return 'group.message';
    }
}