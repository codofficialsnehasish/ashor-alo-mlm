<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DailyBackup extends Command
{
    protected $signature = 'backup:daily';
    protected $description = 'Take a daily backup of the database';

    public function handle()
    {
        $this->call('backup:run', [
            '--only-db' => true,
        ]);

        $this->info('Daily backup completed!');
    }
}
