<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;

class ClearLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logs:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear log files';

    public function handle(): void
    {
        $this->info('🔐 Clearing log files...');
        // Write keys to files
        try {
            exec('echo "" > ' . storage_path('logs/laravel.log'));
            exec('echo "" > ' . storage_path('logs/php-error.log'));
        } catch (Exception $e) {
            $this->error('❌ Failed clear log files.');
            return;
        }

        $this->info('✅ Logs cleared!');
    }
}
