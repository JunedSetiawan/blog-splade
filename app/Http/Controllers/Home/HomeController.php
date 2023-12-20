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

    public function search()
    {
        // search posts
        $posts = Post::with('category', 'user')->where('status', 'active')->where('title', 'LIKE', '%' . request('search') . '%')->paginate(6);

        // search post count
        $posts_count = $posts->total();

        return view('pages.home.home', [
            'posts' => $posts,
            'posts_count' => $posts_count,
        ]);
    }
}
