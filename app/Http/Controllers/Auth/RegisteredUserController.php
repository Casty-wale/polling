<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $request->validate([
            // 'firstName' => ['required', 'string', 'max:255'],
            // 'lastName' => ['required', 'string', 'max:255'],
            // 'dateOfBirth' => ['date'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'phoneNr' => ['numeric'],
            // 'gender' => ['string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'dateOfBirth' => $request->dateOfBirth,
            'email' => $request->email,
            'phoneNumber' => $request->phoneNr,
            'gender' => strtolower($request->gender),
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // Auth::login($user);

        // return response()->noContent();

        return response()->json([
            'success' => true,
            'data' => [
                'name' => $user->firstName." ".$user->lastName,
                'email' => $user->email,
                'token' => $user->createToken(strtolower($user->firstName."".$user->lastName))->plainTextToken,
            ],
            'message' => 'Please an email has been sent to your email inbox to verify.'
        ]);
    }
}
