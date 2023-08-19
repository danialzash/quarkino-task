<?php

namespace Tests\Feature;

use App\Events\UserRegisteredEvent;
use App\Listener\WelcomeNotifierListener;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class WelcomeListenerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {

        Event::fake();

        Event::assertListening(
            UserRegisteredEvent::class,
            WelcomeNotifierListener::class
        );

    }
}
