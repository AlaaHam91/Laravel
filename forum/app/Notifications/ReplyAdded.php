<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Replay;

class ReplyAdded extends Notification
{
    use Queueable;
     public $Reply;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Replay $Reply)
    {
        //
        $this->Reply=$Reply;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
      //delivery channel
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
      //the data feild in the notifications table
        return [
            //
            "user"=>$this->Reply->user->name,
            "discussion"=>$this->Reply->discussion->title
        ];
    }
}
