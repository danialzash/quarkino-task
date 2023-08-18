<?php

namespace App\Services\UserServices;

use App\Events\UserRegisteredEvent;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRegisterService
{

    public function __invoke(RegisterRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->remember_token = Str::random(10);
        $user->save();

        event(new UserRegisteredEvent($user));
        Auth::login($user);

    }
}
