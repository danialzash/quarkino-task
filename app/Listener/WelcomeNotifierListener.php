<?php

namespace App\Listener;

use App\Events\UserRegisteredEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class WelcomeNotifierListener implements ShouldQueue
{

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserRegisteredEvent $event): bool
    {
        Log::info("We have a new user: " . $event->user->email);

        // to stop the propagation of an event to other listeners.
        return false;
    }
}
