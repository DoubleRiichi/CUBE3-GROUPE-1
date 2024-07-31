<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Banned_User;
use App\Models\Comment;
use App\Models\Moderation_Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    private static function is_admin() {
        if(Auth::check()) {
            $user = User::find(Auth::id());
            if($user->permissions == "admin") {
                return true;
            }
        }

        return false;
    }


    private static function validate(Request $request) {

        $validator = Validator::make($request->all(), [
            'description' => 'required|string|max:400',
        ]);

        return $validator;
    }

    public function ban(Request $request) {

        $validator = AdminController::validate($request);

        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if(AdminController::is_admin()) {
            $target_user = User::find($request->id);
            $user = User::find(Auth::id());

            if($target_user && $target_user->permissions != "admin") {
                Banned_User::createOrFirst([
                    'id' => $target_user->id,
                    'name' => $target_user->name,
                    'email' => $target_user->email,
                    "email_verified_at" => $target_user->email_verified_at,
                    'password' => $target_user->password,
                    'remember_token' => $target_user->remember_token,
                    "username" => $target_user->username,
                    "permissions" => $target_user->permissions,
                    "avatar" => $target_user->avatar,
                    "badge" => $target_user->badge,
                ]);

                $target_user->delete();

                
                $description = "~> Admin $user->name a banni $target_user->name le " . date("d/m/Y à H:i:s") . "\n";
                $description .= $request->description;

                Moderation_Log::create([
                    "description" => $description,
                    "action" => "ban",
                    "user_id" => Auth::id(),
                ]);
            }

            return redirect("/admin");
        }
    }


    public function unban(Request $request) {
        $validator = AdminController::validate($request);

        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if(AdminController::is_admin()) {
            $target_user = Banned_User::find($request->id);
            $user = User::find(Auth::id());

            if($target_user) {
                User::createOrFirst([
                    'id' => $target_user->id,
                    'name' => $target_user->name,
                    'email' => $target_user->email,
                    "email_verified_at" => $target_user->email_verified_at,
                    'password' => $target_user->password,
                    'remember_token' => $target_user->remember_token,
                    "username" => $target_user->username,
                    "permissions" => $target_user->permissions,
                    "avatar" => $target_user->avatar,
                    "badge" => $target_user->badge,
                ]);

                $target_user->delete();

                
                $description = "~> Admin $user->name a débanni $target_user->name le " . date("d/m/Y à H:i:s") . "\n";
                $description .= $request->description;

                Moderation_Log::create([
                    "description" => $description,
                    "action" => "unban",
                    "user_id" => Auth::id(),
                ]);
            }

            return redirect()->back();
        }
    }

    public function show() {

        if(!AdminController::is_admin()) {
            return redirect()->back();
        }

        $banned_users = Banned_User::all()->sortByDesc("created_at");
        $comments = Comment::all()->sortByDesc("modified_at");
        $moderation_log = Moderation_Log::all()->sortByDesc("created_at");

        return view("admin-panel", compact("banned_users", "comments", "moderation_log"));
    }
}
