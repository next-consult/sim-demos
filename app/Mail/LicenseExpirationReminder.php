<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LicenseExpirationReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $nom;
    public $dateExpiration;

    public function __construct($nom, $dateExpiration)
    {
        $this->nom = $nom;
        $this->dateExpiration = $dateExpiration;
    }

    public function build()
    {
        return $this->subject('Rappel d\'expiration de licence')
                    ->view('emails.license_expiration_reminder'); // Assurez-vous de créer cette vue
    }
}