<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Tables\Users;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users = Users::class;
        return view('pages.dashboard.user.index', [
            'users' => $users
        ]);
    }
}
