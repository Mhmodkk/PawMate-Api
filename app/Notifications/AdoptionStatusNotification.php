<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdoptionStatusNotification extends Notification
{
    use Queueable;
    public $adoption;

    public function __construct($adoption)
    {
        $this->adoption = $adoption;
    }


    public function via($notifiable)
    {
        return ['database'];
    }


    public function toArray($notifiable)
    {
        return [
            'adoption_id' => $this->adoption->id,
            'status' => $this->adoption->status,
            'message' => "Status is updated {$this->adoption->status}"
        ];
    }

}
