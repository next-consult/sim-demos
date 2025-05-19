<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function showLogs()
    {
        $logFile = storage_path('logs/activity.log'); // Path to the log file

        // Check if the log file exists
        if (!File::exists($logFile)) {
            return response()->json(['error' => 'Log file not found.'], 404);
        }

        // Read the contents of the log file
        $logs = File::get($logFile);
        
        // Split the logs into an array by lines
        $logs = explode(PHP_EOL, $logs);
        
        return view('logs.show', ['logs' => $logs]);
    }
}
