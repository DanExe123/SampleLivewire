<?php

namespace App\Console\Commands;

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class GenerateEAVTables extends Command
{
    protected $signature = 'make:eav-tables';
    protected $description = 'Run migrations to create EAV tables';

    public function handle()
    {
        $this->info("Running migrations for EAV tables...");
        Artisan::call('migrate');
        $this->info("EAV tables created successfully!");
    }
}
