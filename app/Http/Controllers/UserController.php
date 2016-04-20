<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Request;
use Auth;
use Response;
use Validator;
use App\Models\User;
use Hash;
use Socialite;

class UserController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (Request::ajax()) {
            if (Auth::attempt($request->only(['email', 'password']))) {
                return Response::json(['success' => true, 'url' => route('home')]);
            }
            return Response::json(['success' => false, 'messages' => trans('auth.failed') ]);
        }        
    }

    public function register(RegisterRequest $request)
    {
        if (Request::ajax()) {
            $user = $request->only(['name', 'email', 'password']);
            $authUser = User::create($user);
            Auth::login($authUser);
            return Response::json(['success' => true, 'url' => route('home')]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function redirectToProvider($social)
    {
        return Socialite::driver($social)->redirect();
    }
    
    public function handleProviderCallback($social)
    {
        $user  = Socialite::driver($social)->user();
        if ($user) {
            $authUser = User::firstOrCreate([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                $social . '_id' => $user->getId(),
                'avatar' => $user->getAvatar(),
                'role' => User::ROLE_TRAINEE
            ]);
            Auth::login($authUser);
        }
        return redirect()->route('home');
    }

}
