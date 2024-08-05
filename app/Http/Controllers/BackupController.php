<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redirect;

class BackupController extends Controller
{
    public function createBackup()
    {
        // Run the backup command
        Artisan::call('backup:run');

        // Optionally, you can check the output and return a response
        $output = Artisan::output();
        
        // Redirect back with a success message
        return Redirect::back()->with('success', 'Backup created successfully!');
    }
}
