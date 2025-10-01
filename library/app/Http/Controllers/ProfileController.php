<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Profile; 


class ProfileController extends Controller
{
    // public function __construct(){ $this->middleware('auth'); }

    /**
     * Display the user's profile form.
     */
    public function edit(){
        $user = Auth::user();
        // pastikan profile ada
        $profile = $user->profile()->firstOrCreate([]);
        return view('profile.edit', compact('user','profile'));
    }

    public function upsert(Request $r){
        $data = $r->validate([
            'age'     => 'nullable|integer|min:0|max:150',
            'address' => 'nullable|string|max:255'
        ]);

        $user = auth()->user();
        $user->profile ? $user->profile->update($data)
                       : $user->profile()->create($data);

        return back()->with('ok','Profile saved');
    }

    public function destroy()
    {
        $user = auth()->user();

        if ($user->profile) {
            $user->profile->delete();
        }

        return back()->with('ok', 'Profile deleted');
    }


    /**
     * Update the user's profile information.
     */
    // public function update(ProfileUpdateRequest $request): RedirectResponse
    // {
    //     $request->user()->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     $request->user()->save();

    //     return Redirect::route('profile.edit')->with('status', 'profile-updated');
    // }

    /**
     * Delete the user's account.
     */
    // public function destroy(Request $request): RedirectResponse
    // {
    //     $request->validateWithBag('userDeletion', [
    //         'password' => ['required', 'current_password'],
    //     ]);

    //     $user = $request->user();

    //     Auth::logout();

    //     $user->delete();

    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return Redirect::to('/');
    // }
}
