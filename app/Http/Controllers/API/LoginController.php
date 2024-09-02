<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
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

    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'status_code' => 404, 
                'status' => 'error', 
                'message' => 'Email inconnu'
            ], 404);
        }

        if (!Auth::attempt($credentials)) {
            return response()->json([
                "status_code" => 401, 
                "status" => 'error', 
                "message" => 'Mot de passe incorrect'
            ], 401);
        }

        $tokenResult = $user->createToken('authToken', ['*'], now()->addWeek())->plainTextToken;
        return response()->json([
            "status_code" => 200, 
            'status' => 'success', 
            'access_token' => $tokenResult, 
            'token_type' => 'Bearer', 
            'user' => $user
        ], 200);

    }
}
