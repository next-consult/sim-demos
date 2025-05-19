<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CongeStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $conge;
    public $status;

    public function __construct($user, $conge, $status)
    {
        $this->user = $user;
        $this->conge = $conge;
        $this->status = $status;
    }

    public function build()
    {
        return $this->subject('Changement de statut de votre congé')->view('emails.conge-status-changed')
            ->with([
                'user' => $this->user,
                'conge' => $this->conge,
                'status' => $this->status,
            ]);
    }
}