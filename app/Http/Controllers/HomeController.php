<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function editProfile()
    {
        return view('profile.edit');
    }

    public function updateProfile(Request $request)
    {

        $request->validate([
            "name" => "required|min:3|max:50",
            "profile_photo" => "nullable|file|mimes:jpeg,png|max:1000"
        ]);

        $user = User::find(auth()->user()->id);
        $user->name = $request->name;

        if ($request->hasFile('profile_photo')) {
            $newName = "profile_" . uniqid() . "." . $request->file('profile_photo')->extension();
            $request->file('profile_photo')->storeAs('public/profile', $newName);

            $user->profile_photo = "storage/profile/" . $newName;
        }

        $user->update();
        return redirect()->back();
    }

    public function editPassword()
    {
        return view('profile.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            "old_password" => ['required', new MatchOldPassword],
            "password" => ['required', 'min:8'],
            "password_confirmation" => ['same:password']
        ]);

        $user = new User();
        $currentUser = $user->find(Auth::id());
        $currentUser->password = Hash::make($request->password);
        $currentUser->update();
        Auth::logout();

        return redirect()->route('login');
    }
}
