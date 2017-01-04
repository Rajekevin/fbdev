<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('BO.html.pages.users.index', ['users' => $users]);
    }

    public function toggleActive($id){
        $user = User::findOrFail($id);

        $user->is_active = !$user->is_active;
        $user->save();
    }
}
