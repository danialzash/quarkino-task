<?php

namespace App\Listener;

use App\Events\UserRegisteredEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use PHPUnit\Event\Code\Throwable;

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

    /**
     * When event listener may fail the listener call this function with corresponding throwable
     * By now only the throwable message and id of the event user are logged but logics should handle here
     * @param UserRegisteredEvent $event
     * @param Throwable $throwable
     * @return void
     */
    public function failed(UserRegisteredEvent $event, Throwable $throwable): void
    {
        Log::alert($throwable->message() . ":" . $event->user->id);
    }
}
