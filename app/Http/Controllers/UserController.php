<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(User $user)
    {
        if ($user->social) {
            $user->attr = explode(',', $user->social);
        }
        $view = (Auth::user()->id == $user->id) ? 'user.index' : 'user.show';
        return view($view, compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'bio' => 'max:150',
        ];

        if ($request->username != $user->username) {
            $rules['username'] = 'required|min:4|max:20|unique:users|alpha_dash';
        }

        $validatedData = $request->validate($rules);

        if ($request->has('social')) {
            $validatedData['social'] = implode(',', array_map(
                fn ($value) => $value ?? 'null',
                $request->social_attr
            ));
        } else {
            $validatedData['social'] = null;
        }

        User::where('email', $user->email)->update($validatedData);

        return redirect()->route('user.profile', ['user' => $user->username])->with('success', '<strong>Your Profile updated successfully!!</strong>');
    }

    public function profile_update(Request $request)
    {
        $folderPath = storage_path('app/public/');
        $image_parts = explode(";base64,", $request->image);
        $image_type = explode("image/", $image_parts[0])[1];
        $image_base64 = base64_decode($image_parts[1]);
        $imageName = "profile_images/" . Str::random(30) . date('Y-m-d') . ".{$image_type}";
        $imageFullPath = $folderPath . $imageName;

        if (Auth::user()->profile_image) Storage::delete(Auth::user()->profile_image);
        file_put_contents($imageFullPath, $image_base64);

        User::where('email', Auth::user()->email)->update([
            'profile_image' => $imageName,
        ]);

        Session::flash('success', '<strong>Horray!</strong> Your profile photo updated successfully!!');

        return response()->json([
            'success' => asset('storage/' . $imageName)
        ]);
    }

    public function delete_profile()
    {
        if (Auth::user()->profile_image) Storage::delete(Auth::user()->profile_image);
        User::where('email', Auth::user()->email)->update([
            'profile_image' => null,
        ]);
        return redirect()->route('user.profile', ['user' => Auth::user()->username])->with('success', '<strong>Wow</strong> Your profile photo deleted successfully!!');
    }
}
