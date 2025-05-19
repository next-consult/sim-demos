<?php

namespace App\Listeners;

use App\Events\UserActionEvent;
use Illuminate\Support\Facades\Log;

class LogUserActionListener
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\UserActionEvent  $event
     * @return void
     */
    public function handle(UserActionEvent $event)
    {
        // Enregistrer les informations de l'événement dans le log
        Log::channel('activity')->info('Action utilisateur enregistrée.', [
            'user_id' => $event->userId,
            'action' => $event->action,
            'timestamp' => $event->timestamp,
        ]); // Correctly closed array and method call
    }
}
