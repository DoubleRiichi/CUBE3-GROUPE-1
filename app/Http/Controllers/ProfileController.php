<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class ProfileController extends Controller
{
  public function show($name)
  {
      $user = User::where('name', $name)->firstOrFail();
      return view('profile', compact('user'));
  }
  
}
