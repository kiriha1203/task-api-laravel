<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::get();

        return response()->json([
            $users
        ]);
    }

    public function create(Request $request) {
        $user = User::create([
            'name' => $request->name,
            "email" => $request->email,
        ]);

        return response()->json($user);
    }

    public function fetch(Request $request) {
        $user = User::find($request->user_id);

        return response()->json($user);
    }

    public function update(Request $request) {
        $user = User::find($request->user_id);
        $user->update([
            'name' => $request->name,
        ]);

        return response()->json($user);
    }

    public function delete(Request $request) {
        $user = User::find($request->user_id);
        $user->delete();

        return response()->json();
    }
}
