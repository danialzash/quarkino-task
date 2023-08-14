<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class WarmUpCommand extends Command
{
    Const COLOR_GREEN = "\033[37;42m";
    Const COLOR_RESET = "\033[0m";
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:warm-up-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command prepares the project for verification and testing purposes.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Artisan::call('migrate:fresh');
        $this->printSuccessMessages("Migration has been done successfully");
        Artisan::call('db:seed');
        $this->printSuccessMessages("Seeding has been done successfully");
    }

    private function printSuccessMessages(String $message = "Ok"): void
    {
        echo(self::COLOR_GREEN . $message . self::COLOR_RESET . "\n");
    }
}
