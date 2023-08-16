<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('quarkino', function () {
    Artisan::call('app:warm-up-command');
});

Artisan::command('services', function () {
    $servicesList = glob(app_path('Services') . '/*.php');
    if (count($servicesList) > 0) {
        echo implode("\n", array_map('basename', $servicesList)) . PHP_EOL;
    } else {
        echo "No service found in app/Services directory\n";
    }
});
