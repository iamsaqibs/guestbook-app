<?php

namespace App\Console\Commands;

use App\Jobs\GenerateEntryReportJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GenerateEntriesReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:entry-report-queue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates json report of guestbook entries : runs hourly';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info('Disptching job...');
        GenerateEntryReportJob::dispatch()->onQueue('reports');
        return Command::SUCCESS;
    }
}
