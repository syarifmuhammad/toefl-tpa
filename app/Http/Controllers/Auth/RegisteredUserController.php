<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nim_or_nik' => ['required', 'numeric', 'regex:/^(\d{10}|\d{16})$/', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'email' => 'required|string|email|max:255|unique:' . User::class,
            'name' => 'required|string|max:255',
            'profile_picture' => 'required',
            'street' => 'required|string',
            'village' => 'required|string',
            'sub_district' => 'required|string',
            'district' => 'required|string',
            'province' => 'required|string',
            'postal_code' => 'required|numeric|digits:5',
            'phone' => 'required|numeric|digits_between:10,13|starts_with:62',
        ]);

        $address = Address::create([
            'street' => $request->street,
            'village' => $request->village,
            'sub_district' => $request->sub_district,
            'district' => $request->district,
            'province' => $request->province,
            'postal_code' => $request->postal_code,
        ]);

        if ($request->file('profile_picture')) {
            $file = $request->file('profile_picture');
            $fileName = date('YmdHis') . $file->getClientOriginalName();        
            $file->move(public_path('images/profile_picture'), $fileName);
        }
        

        $user = User::create([
            'nim_or_nik' => $request->nim_or_nik,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'name' => $request->name,
            'profile_picture' => $fileName,
            'address_id' => $address->id,
            'phone' => $request->phone,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
