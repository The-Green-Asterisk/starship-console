<?php

namespace App\Notifications;

use App\Models\Starship;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendInvitation extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($email, $starshipId)
    {
        $this->email = $email;
        $this->starshipId = $starshipId;
        $this->starshipName = Starship::find($starshipId)->name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Welcome aboard!')
            ->greeting('Hello!')
            ->line("You have been invited to board the $this->starshipName and access its revolutionary new handy-dandy customizable, remote-capable starship console! Click below to register a new account and join the crew!")
            ->action('Register', url('/register?starship='.$this->starshipId));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     */
    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}
