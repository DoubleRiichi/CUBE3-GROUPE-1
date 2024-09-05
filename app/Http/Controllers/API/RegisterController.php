<?php

namespace App\Http\Controllers\Api;

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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
            return response()->json($validator->errors(), 422);
        }


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


        $token = $user->createToken("auth_token", ['*'], now()->addWeek())->plainTextToken;

        return response()->json([
            "status_code" => 200, 
            'status' => 'success', 
            'access_token' => $token, 
            'token_type' => 'Bearer', 
            'user' => $user
        ], 200);
    }
}
