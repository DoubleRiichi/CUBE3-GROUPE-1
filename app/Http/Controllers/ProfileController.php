<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

use Exception;

class ProfileController extends Controller
{
  public function show($name)
  {
      $user = User::where('name', $name)->firstOrFail();
      return view('profile', compact('user'));
  }

  public function edit($name)
  {
      $user = User::where('name', $name)->firstOrFail();
      return view('updateprofile', compact('user'));
  }
  public function update(Request $request, $name)
  {
      $request->validate([
          'name' => 'required|string|max:255',
          'email' => 'required|string|email|max:255',
          'badge' => 'required|string|max:255',
          'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      ]);

      $user = User::where('name', $name)->firstOrFail();

      $user->name = $request->input('name');
      $user->email = $request->input('email');
      $user->badge = $request->input('badge');

      if ($request->hasFile('avatar')) {
          // Supprime l'ancien avatar s'il existe
          if ($user->avatar) {
            Storage::disk("public")->delete($user->avatar);
          }
          // Stocke le nouvel avatar
          $path = $request->file('avatar')->store('avatars', 'public');
          $user->avatar = $path;
      }

      $user->save();

      return redirect()->route('profile.show' ,['name' => $user->name])->with('success', 'Profil mis à jour avec succès.');
  }
  
}
