<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $this->spladeTitle('Blog Splade');
        $recent_posts = Post::with('category', 'user')->where('status', 'active')->latest()->limit(4)->get();
        $posts = Post::with('category', 'user')->where('status', 'active')->paginate(6);

        return view('pages.home.home', [
            'recent_posts' => $recent_posts,
            'posts' => $posts,
        ]);
    }
}
