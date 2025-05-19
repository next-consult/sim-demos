<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CamionNotif extends Notification
{
    use Queueable;
    public $description;
    public $camion_id;
    public $type;
    public $categorie;

    /**
     * Create a new notification instance.
     *
     * @return void
     */




    public function __construct($description,$camion_id,$type,$categorie)
    {
        $this->description=$description;
        $this->camion_id=$camion_id;
        $this->type=$type;
        $this->categorie=$categorie;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'description'=>$this->description,
            'camion_id'=>$this->camion_id,
            'type'=>$this->type,
            'categorie'=>$this->categorie,
        ];
    }
}
