<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    //
    public function showRegister()
    {
        return view('user.auth.register');
    }

    public function showLogin()
    {
        return view('user.auth.login');
    }

    public function getUserName()
    {
        $user = Auth::user();
        $user_name = $user->name;

        return $user_name;
    }

    public function createUser(Request $request)
    {
        $validator = $this->validateRegister($request);

        //validation
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $user = $this->store($request->name, $request->email, $request->password);

            if ($user['status']) {
                $data = [
                    'status' => true,
                    'message' => 'You have registered successfully'
                ];
            };
        } catch (\Exception $e) {
            $data = [
                'status' => false,
                'message' => $e,
                'error' => $e
            ];
        }

        return $data;
    }

    private function validateRegister(Request $request)
    {
        $rules = [
            'name' => 'required|min:2|max:100',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:6|max:16',
            'confirmPassword' => 'required|same:password',
        ];

        $messages = [
            'name.required' => 'Name is a required field.',
            'name.min' => 'Name must be at least 2 characters long.',
            'name.max' => 'Name can be up to 100 characters long.',
            'email.required' => 'Email is a required field.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'Email can be up to 255 characters long.',
            'email.unique' => 'This email is already registered.',
            'password.required' => 'Password is a required field.',
            'password.min' => 'Password must be at least 6 characters long.',
            'password.max' => 'Password can be up to 16 characters long.',
            // 'password.confirmed' => 'Password confirmation does not match.',
            'confirmPassword.required' => 'Confirm password is required.',
            'confirmPassword.same' => 'Confirm password must match the password.',
        ];

        return Validator::make($request->all(), $rules, $messages);
    }

    public function store(string $name, string $email, string $password)
    {
        try {
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($password),
                'token' => Str::uuid()
            ]);
            $data = [
                'status' => true,
                'message' => 'User have successfully register their account'
            ];
        } catch (\Exception $e) {
            $data = [
                'status' => false,
                'message' => 'User failed to register',
                'error' => $e
            ];
        }


        return $data;
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if ($user->is_active === 'INACTIVE') {
                return redirect()->back()->withErrors(['message' => 'User have been deactivated'])->withInput();
            }

            if ($user->roles === 'ADMIN') {
                return redirect()->back()->withErrors(['message' => 'Admin is not allowed to log in'])->withInput();
            }
        }
        $credentials = $request->only('email', 'password');
        if (Auth::guard('web')->attempt($credentials)) { // 일반 유저
            return redirect()->intended(route('user.home'));
        } else {
            return redirect()->back()->withErrors(['message' => 'Incorrect email or password'])->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        // 세션을 무효화합니다.
        $request->session()->invalidate();

        // CSRF 토큰을 재생성합니다.
        $request->session()->regenerateToken();

        // 로그아웃 후 리다이렉션할 페이지로 리다이렉션합니다.
        return redirect('/');
    }
}
