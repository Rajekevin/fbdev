<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DefaultController extends Controller
{
    public function index()
    {
        $countUsers = User::count();

        return view('BO.html.pages.index', [
            'countUsers' => $countUsers,
        ]);
    }
}
