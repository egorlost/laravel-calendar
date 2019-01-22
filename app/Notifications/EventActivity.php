<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\EventActivity as EventActivityModel;

class EventActivity extends Notification implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $eventActivity;

    /**
     * Create a new notification instance.
     *
     * @param EventActivityModel $eventActivity
     * @param int $delay
     * @return void
     */
    public function __construct(EventActivityModel $eventActivity, int $delay)
    {
        $this->eventActivity = $eventActivity;

        $this->delay($delay);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast'];
    }

    /**
     * Get the broadcast representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\BroadcastMessage
     */
    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'eventActivity' => $this->eventActivity,
            'user' => auth()->user()
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
