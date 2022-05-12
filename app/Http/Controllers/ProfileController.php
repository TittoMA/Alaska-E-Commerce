<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('pages.profile');
    }

    public function editProfile()
    {
        return view('pages.editProfile');
    }

    public function updatePhoto(Request $request)
    {
        $validateData = $request->validate([
            'photo' => 'required|file|image|max:2048'
        ]);

        $extFile = $request->photo->getClientOriginalExtension();
        $fileName = 'profile-' . uniqid() . "-" . time() . "." . $extFile;

        $save = User::where('id', Auth::user()->id)->update(['photo_profile' => $fileName]);

        if ($save) {
            $request->photo->move(public_path("img/profile"), $fileName);
        }

        return redirect()->route('profile.edit')->with('status', 'photo-updated');
    }
}
