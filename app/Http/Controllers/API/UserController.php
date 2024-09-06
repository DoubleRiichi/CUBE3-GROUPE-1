<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource. 
     * /!\ S'assurer qu'il n'y pas de mots de passe envoyés avec la requête*/
    public function index()
    {
        $users = User::all();

        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::ById($id);

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateUserAvatar(Request $request)
    {
        $user = Auth::user();
 
        if (!$request->hasFile('avatar')) {
            return response()->json(['error' => 'No file uploaded'], 400);
        }

        // Supprime l'ancien avatar s'il existe et si différent de default_avatar
        if ($user->avatar && !str_contains($user->avatar, 'default_avatar')) {
            Storage::disk('public')->delete($user->avatar);
        }

        // Stocke le nouvel avatar
        $path = $request->file('avatar')->store('avatars', 'public');
        $user->avatar = $path;

        $user->save();

        return response()->json([
            'success' => true,
            'avatar' => $user->avatar,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function getUserData(Request $request)
    {
        return response()->json(Auth::user());
    }

    public function checkEmail(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email']
        ]);

        $user = User::where('email', $request->email)->first();

        return response()->json([
            'exists' => (bool) $user,
        ]);
    }
}
