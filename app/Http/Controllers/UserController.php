<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\FileUploadProcessor;
use Request;
use Auth;
use Response;
use Validator;
use App\Models\User;
use Hash;
use Socialite;
use Session;

class UserController extends Controller
{
    protected $fileUpload;
    
    public function __construct(FileUploadProcessor $fileUpload)
    {
        $this->fileUpload = $fileUpload;
    }

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

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store()
    {
        //
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $activity = $user->activities;
        $course = $user->courses()->training()->first();
        $subjects = $course ? $course->subjects : '';
        return view('common.user.show', [
            'user' => $user,
            'activity' => $activity,
            'course' => $course,
            'subjects' => $subjects
        ]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        //check policies
        if (Auth::user()->cannot('updateUser', $user)) {
            return  redirect()
                    ->route('user.show', $id)
                    ->with(['flash_message' => trans('settings.not_permission')]);
        }

        return view('common.user.edit', [
            'user' => $user,
        ]);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        try {
            $userRequest = $request->only(['name', 'email']);
            //check password
            if ($request->password) {
                $userRequest['password'] = $request->password;
            }
            //check avatar
            if ($request->hasFile('avatar') ) {
                $uploadFile = $this->fileUpload->upload($request->file('avatar'));
                if ($uploadFile) {
                    $userRequest['avatar'] = $uploadFile;
                }
            }

            $user = User::findOrFail($id);
            if (Auth::user()->cannot('updateUser', $user)) {
                return  redirect()
                        ->route('user.show', $id)
                        ->with(['flash_message' => trans('settings.not_permission')]);
            }

            $user->update($userRequest);
            return  redirect()
                ->route('user.show', $id)
                ->with(['flash_message' => trans('settings.update_success')
            ]);
            
        } catch (Exception $ex) {
            return  redirect()
                    ->route('user.show', $id)
                    ->with(['flash_message' => trans('settings.error_exception')]);
        }
    }

    public function destroy()
    {
        //
    }

}
