<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'username' => 'required|string|max:255|unique:users'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'username' => $request->username,
            'permissions' => "user",
            'avatar' => "avatar",
            'badge' => "user",
        ]);


        // auth()->login($user);

        return redirect('/home');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                Auth::login($user);
                return redirect()->route('home');
            } else {
                // Créez un nouvel utilisateur avec les informations de Google
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make('default-google-password'), // ou un autre mot de passe sécurisé
                    'username' => $googleUser->getNickname() ?: $googleUser->getName(),
                    'permissions' => null,
                    'avatar' => $googleUser->getAvatar(),
                    'badge' => null,
                ]);

                Auth::login($user);
                return redirect()->route('home');
            }

        } catch (Exception $e) {
            return redirect()->route('register')->with('error', 'Something went wrong. Please try again.');
        }
    }
}
