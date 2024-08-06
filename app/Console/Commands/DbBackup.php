<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DbBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a database backup';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $backupDirectory = storage_path('app/backup');
        $filename = "backup_" . strtotime(now()) . ".sql";
        $filePath = "{$backupDirectory}/{$filename}";

        // Ensure the backup directory exists
        if (!is_dir($backupDirectory)) {
            mkdir($backupDirectory, 0755, true);
        }

        $command = sprintf(
            'mysqldump --column-statistics=0 --user=%s --password=%s --host=%s %s > %s 2> %s',
            escapeshellarg(env('DB_USERNAME')),
            escapeshellarg(env('DB_PASSWORD')),
            escapeshellarg(env('DB_HOST')),
            escapeshellarg(env('DB_DATABASE')),
            escapeshellarg($filePath),
            escapeshellarg($backupDirectory . '/error.log')
        );

        exec($command, $output, $returnVar);

        // Log the command and output
        Log::info('DbBackup command executed', [
            'command' => $command,
            'output' => $output,
            'returnVar' => $returnVar,
            'filePath' => $filePath,
        ]);

        if ($returnVar !== 0) {
            $this->error('Failed to create database backup');
            return 1;
        }

        // Check if the file was created
        if (file_exists($filePath)) {
            chmod($filePath, 0644); // Set permissions to be readable
            $this->info('Database backup created successfully');
            return 0;
        } else {
            $this->error('Database backup file not found');
            return 1;
        }
    }
}
