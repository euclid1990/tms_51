<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\AddUserRequest;
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
        $users = User::trainee()->paginate(ENV('USER_PER_PAGE'));
        return view('common.user.index', [
            'users' => $users,
        ]);
    }

    public function create()
    {
        return view('common.user.add');
    }

    public function store(AddUserRequest $request)
    {
        try {
            $userRequest = $request->only(['name', 'email', 'password']);
            if ($request->hasFile('avatar')) {
                $uploadFile = $this->fileUpload->upload($request->file('avatar'));
                if ($uploadFile) {
                    $userRequest['avatar'] = $uploadFile;
                }
            }
            $user = User::create($userRequest);
            $flashMessage = trans('settings.create_success');
            
        } catch (Exception $ex) {
            $flashMessage = trans('settings.error_exception');
        }
        return redirect()
            ->route('admin.user.index')
            ->with(['flash_message' => $flashMessage]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $activity = $user->activities()->paginate(ENV('ACTIVITY_PER_PAGE'));
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
                return redirect()
                        ->route('user.show', $id)
                        ->with(['flash_message' => trans('settings.not_permission')]);
            }

            $user->update($userRequest);
            $flashMessage = trans('settings.update_success');
        } catch (Exception $ex) {
            $flashMessage = trans('settings.error_exception');
        }
        return redirect()
            ->route('user.show', $id)
            ->with(['flash_message' => $flashMessage]);
        
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            $flashMessage = trans('settings.delete_success');
        } catch (Exception $ex) {
            $flashMessage = trans('settings.error_exception');
        }
        return redirect()
            ->route('admin.user.index')
            ->with(['flash_message' => $flashMessage]);
    }

}
