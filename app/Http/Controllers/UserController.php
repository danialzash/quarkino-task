<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\UserServices\UserRegisterService;
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

    public function register(RegisterRequest $request, UserRegisterService $registerService): JsonResponse
    {
        try {
            $registerService($request);
            return response()->json('The user has been created.', 201);
        } catch (\Exception $exception) {
            return response()->json(['error' => 'User register was unsuccessful please try again'], 401);
        }
    }
}
