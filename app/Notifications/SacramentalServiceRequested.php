<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SacramentalServiceRequested extends Notification
{
    use Queueable;
    protected $service;
    /**
     * Create a new notification instance.
     */
    public function __construct($service)
    {
        $this->service = $service;
    }
    //

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // return ['mail'];
         return ['database']; // Save to DB
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Sacramental Service Requested',
            'message' => "Your {$this->service->service_type} request has been submitted for {$this->service->date} at {$this->service->time}.",
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
