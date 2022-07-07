<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password as RulesPassword;
use App\Rules\FullnameRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registration(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:6', 'max:30', 'string', new FullnameRule()],
            'username' => 'required|min:4|max:20|unique:users|alpha_dash',
            'email' => 'required|email:dns|unique:users',
            'password' => ['required', RulesPassword::min(6)->mixedCase()->letters()->numbers()->symbols()],
            'password_confirm' => 'required|same:password'
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('login')->with('success', '<strong>Registration successful!</strong> Please login!');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        $remember = ($request->has('remember')) ? true : false;

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            $user = User::where(["email" => $credentials['email']])->first();
            Auth::login($user, $remember);
            Auth::logoutOtherDevices($credentials['password']);

            return redirect()->intended('spaces');
        }

        return back()->with('error', '<strong>Login failed!!</strong>, Please try again!');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/spaces');
    }
}
