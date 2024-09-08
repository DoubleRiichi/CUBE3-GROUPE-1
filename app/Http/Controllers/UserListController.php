<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserListController extends Controller
{
    

    private static function is_admin()
    {
        if (Auth::check()) {
            $user = User::find(Auth::id());
            if ($user->permissions == "admin") {
                return true;
            }
        }

        return false;
    }


    public function show() {

        if(!UserListController::is_admin()) {
            return redirect("/");
        }

        $users = User::all();
        
        return view("user-list", compact("users"));
    }


    public function search(Request $request) {

        if(!UserListController::is_admin()) {
            return redirect("/");
        }

        $params = [];

        if($request->name) {
            array_push($params, ["users.name", "LIKE", "%$request->name%"]);
        }

        if ($request->beforeDate) {
            array_push($params, ["users.created_at", "<", $request->beforeDate]);
        }

        if ($request->afterDate) {
            array_push($params, ["users.created_at", ">", $request->afterDate]);
        }


        $users = DB::table("users")->where($params)->get();

        return view("user-list", compact("users"));
    }
}
