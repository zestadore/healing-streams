<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Jobs\EmailPayments;

class EmailCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will forward emails to users with their respective payment links';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        EmailPayments::dispatch();
    }
}
