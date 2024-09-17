<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;
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
    $comments = Comment::ByUserId($user->id);

    return view('profile', compact('user', "comments"));
  }

  public function edit($name)
  {
    $user = User::where('name', $name)->firstOrFail();
    return view('updateprofile', compact('user'));
  }
  public function update(Request $request, $name)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|max:255',
      'email' => 'required|email|max:255',
      'badge' => 'required|string|max:255',
      'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ], [
      'avatar.image' => 'Le fichier doit être une image.',
      'avatar.mimes' => 'Le fichier doit être au format jpeg, png, jpg ou gif.',
      'avatar.max' => 'L\'image ne doit pas dépasser 2MB.',
    ]);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
    }

    $user = User::where('name', $name)->firstOrFail();

    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->badge = $request->input('badge');

    if ($request->hasFile('avatar')) {
      // Supprime l'ancien avatar s'il existe et si différent de default_avatar
      if ($user->avatar && !str_contains($user->avatar, 'default_avatar')) {
        Storage::disk('public')->delete($user->avatar);
      }
      // Stocke le nouvel avatar
      $path = $request->file('avatar')->store('avatars', 'public');
      $user->avatar = $path;
    }

    $user->save();

    return redirect()->route('profile.show', ['name' => $user->name])->with('success', 'Profil mis à jour avec succès.');
  }

}
