<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password as RulesPassword;
use App\Rules\FullnameRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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
        $validated = Validator::make($request->all(), [
            'name' => ['required', 'min:6', 'max:30', 'string', new FullnameRule()],
            'username' => 'required|min:4|max:20|unique:users|alpha_dash',
            'email' => 'required|email:dns|unique:users',
            'password' => ['required', RulesPassword::min(6)->mixedCase()->letters()->numbers()->symbols()],
            'password_confirm' => 'required|same:password'
        ]);

        if ($validated->fails()) {
            return response()->json([
                'error' => $validated->errors(),
                'type' => 'list'
            ]);
        }

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        User::create($data);

        Session::flash('success', '<strong>Registration successful!</strong> Please login!');

        return response()->json([
            'success' => true,
            'redirect' => route('login')
        ]);
    }

    public function login(Request $request)
    {
        $credentials = Validator::make($request->all(), [
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        if ($credentials->fails()) {
            return response()->json([
                'error' => $credentials->errors(),
                'type' => 'list'
            ]);
        }

        $remember = ($request->has('remember')) ? true : false;

        if (Auth::attempt($request->only(['email', 'password']), $remember)) {
            $request->session()->regenerate();

            $user = User::where(["email" => $request->email])->first();
            Auth::login($user, $remember);
            Auth::logoutOtherDevices($request->password);

            Session::flash('loggedin', 'Login successfully!');

            return response()->json([
                'success' => true,
                'redirect' => route('spaces')
            ]);
        }

        return response()->json([
            'error' => '<strong>Login failed!!</strong>, Please try again!',
            'type' => 'single'
        ]);
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        Session::flash('loggedout', 'See you soon!');

        return redirect('/spaces');
    }
}
