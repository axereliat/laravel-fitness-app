<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $request->user()->fill([
            'name' => $data['name'],
            'email' => $data['email']
        ]);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        $request->user()->userInformation()->update([
            'height' => $data['height'],
            'weight' => $data['weight']
        ]);

        if ($request->hasFile('avatar')) {
            try {
                $avatarUrl = cloudinary()->upload($request->file('avatar')->getRealPath())->getSecurePath();

                $request->user()->userInformation()->update([
                    'avatar' => $avatarUrl
                ]);
            } catch (Exception $ex) {
                dd($ex->getMessage());
            }
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
