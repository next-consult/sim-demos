<?php

namespace App\Events;

class UserActionEvent
{
    public $userId;
    public $action;
    public $timestamp;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($userId, $action, $timestamp)
    {
        $this->userId = $userId;
        $this->action = $action;
        $this->timestamp = $timestamp;
    }
}
