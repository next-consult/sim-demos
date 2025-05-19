<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;
use Log;

class UpdateCongeMaladie extends Command
{
    protected $signature = 'conge:update-maladie';
    protected $description = 'Increment soldeCongeMaladie by 1.5 days each month and reset it at the start of a new year';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Increment soldeCongeMaladie for all users
        User::query()->each(function ($user) {
            $user->resetSoldeCongeMaladie();
        });
    }
}