<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User;
use App\Models\Conge;

class CongeRequestCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $conge;

    public function __construct(User $user, Conge $conge)
    {
        $this->user = $user;
        $this->conge = $conge;
    }

    public function build()
    {
        return $this->subject('Nouvelle demande de congé')
            ->view('emails.conge_request_created');
    }
}

