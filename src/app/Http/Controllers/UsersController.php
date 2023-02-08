<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function viewIndex()
    {
        $users = User::get();
        return view('users.index', compact('users'));
    }

    public function index()
    {
        $users = User::get();
        return response()->json([
            $users
        ]);
    }
}
