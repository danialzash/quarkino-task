<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * This function is a mess but, it gets the request and validate it. if it was ok
     * set an access token cookie to the response
     * @param Request $request
     * @return Application|ResponseFactory|\Illuminate\Foundation\Application|RedirectResponse|Response
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'string'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response('OK', 200)
                ->cookie('access_token', $user->getRememberToken());
        }

        return back()->withErrors([
            'name' => 'the provided credential do not match our records.',
        ])->onlyInput('name');
    }
}
