<?php

namespace Tests\Feature;

use App\Events\UserRegisteredEvent;
use App\Http\Requests\RegisterRequest;
use App\Services\UserServices\UserRegisterService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class UserRegisterEventTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {

        Event::fake();

        $fakeRequest = $this->createFakeRequest();
        $fakeRegisterService = new UserRegisterService();

        $fakeRegisterService($fakeRequest);

        Event::assertDispatched(UserRegisteredEvent::class);

    }

    /**
     * Create fake RegisterRequest for test
     * @return RegisterRequest
     */
    private function createFakeRequest(): RegisterRequest
    {
        $request = new RegisterRequest();
        $request->name = fake()->name;
        $request->password = fake()->password;
        $request->email = fake()->email;

        return $request;
    }
}
