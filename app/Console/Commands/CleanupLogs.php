<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CleanupLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logs:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up Telescope Jobs';

    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Execute the console command.
     */
    public function handle()
    {
         // Define the number of days to keep log files
         $daysToKeep = 7;

         // Get the list of log files
         $logFiles = Storage::files('logs');
 
         foreach ($logFiles as $logFile) {
             // Get the creation date of the log file
             $creationDate = Storage::lastModified($logFile);
 
             // Calculate the difference in days
             $daysDifference = now()->diffInDays(now()->createFromTimestamp($creationDate));
 
             // Delete log files older than the specified days
             if ($daysDifference > $daysToKeep) {
                 Storage::delete($logFile);
                 $this->info("Deleted log file: $logFile");
             }
         }
 
         $this->info('Log cleanup completed.');
    }
}
