<?php

namespace App\Notifications;

use App\Models\Notification as NotificationModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Notify extends Notification implements ShouldBroadcast
{
    use Queueable;

    public string $message;
    public string $action;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $message, string $action = "#", int $userId)
    {
        $this->message = $message;
        $this->action = $action;

        $notification = new NotificationModel();
        $notification->user_id = $userId;
        $notification->body = $this->message;
        $notification->save();
        $notification->action = $this->action . "?n=" . $notification->id;
        $notification->save();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['broadcast'];
    }

    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'message' => $this->message,
            'action' => $this->action
        ]);
    }
}
