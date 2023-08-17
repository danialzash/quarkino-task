<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * This function is a mess but, it gets the request and validate it. if it was ok
     * set an access token cookie to the response
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'string'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json([], 202)
                ->cookie('access_token', $user->getRememberToken());
        }

        return response()->json(['error' => 'Username or password is incorrect. Please correct it and retry.'], 401);
    }
}
