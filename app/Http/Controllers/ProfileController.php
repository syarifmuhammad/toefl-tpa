<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Address;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(Request $request): Response
    {
        return Inertia::render('Profile/Index', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    public function password(Request $request): Response
    {
        return Inertia::render('Profile/ChangePassword', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->validate([
            'nim_or_nik' => ['required', 'numeric', 'regex:/^(\d{10}|\d{16})$/'],
            'email' => 'required|string|email|max:255',
            'name' => 'required|string|max:255',
            'street' => 'required|string',
            'village' => 'required|string',
            'sub_district' => 'required|string',
            'district' => 'required|string',
            'province' => 'required|string',
            'postal_code' => 'required|numeric|digits:5',
            'phone' => 'required|numeric|digits_between:10,13|starts_with:62',
            'profile_picture' => 'required'
        ]);

        $user = User::find($request->id);
        $address = Address::where('user_id', $request->id)->first();

        if ($request->profile_picture != null) {
            $file = $request->file('profile_picture');
            $fileName = date('YmdHis') . $file->getClientOriginalName();
            $file->move(public_path('images/profile_picture'), $fileName);
            Storage::delete('images/profile_picture/' . $user->profile_picture);
        } else {
            $fileName = $user->profile_picture;
        }

        $user->update([
            'nim_or_nik' => $request->nim_or_nik,
            'email' => $request->email,
            'name' => $request->name,
            'profile_picture' => $fileName,
            'phone' => $request->phone,
        ]);

        $address->update([
            'street' => $request->street,
            'village' => $request->village,
            'sub_district' => $request->sub_district,
            'district' => $request->district,
            'province' => $request->province,
            'postal_code' => $request->postal_code,
        ]);

        return Redirect::route('profile.index');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return Redirect::route('profile.index');
    }
}
