<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Mail\Email;
use Illuminate\Support\Facades\Mail;
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

        // Attribuer un avatar aléatoirement
        $avatars = [
            'avatars/default_avatars/Avatar_1.png',
            'avatars/default_avatars/Avatar_2.png',
            'avatars/default_avatars/Avatar_3.png',
            'avatars/default_avatars/Avatar_4.png'
        ];
        $randomAvatar = $avatars[array_rand($avatars)];

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'username' => $request->username,
            'permissions' => "user",
            'avatar' => $randomAvatar,
            'badge' => "user",
        ]);

        $mail = new Email();
        Mail::to($user->email)->send($mail);
        auth()->login($user);

        return redirect('/home');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {

        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::where('email', $googleUser->getEmail())->first();

        $avatars = [
            'avatars/default_avatars/Avatar_1.png',
            'avatars/default_avatars/Avatar_2.png',
            'avatars/default_avatars/Avatar_3.png',
            'avatars/default_avatars/Avatar_4.png'
        ];
        $randomAvatar = $avatars[array_rand($avatars)];

        if (!$user) {
            // Créer un nouvel utilisateur avec les informations de Google
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => Hash::make('default-google-password'), // ou un autre mot de passe sécurisé
                'username' => $googleUser->getNickname() ?: $googleUser->getName(),
                'permissions' => 'user',
                'avatar' => $randomAvatar,
                'badge' => 'user',
            ]);

            $mail = new Email();
            Mail::to($user->email)->send($mail);

            Auth::login($user);
            return redirect('/home');
        } else {
            // Connecter l'utilisateur existant
            Auth::login($user);
            return redirect('/home');
        }

    }
}
