<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Tables\Posts;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('pages.dashboard.dashboard');
    }

    public function posts(): View
    {
        return view('pages.dashboard.posts', [
            'posts' => Posts::class,
        ]);
    }
}
