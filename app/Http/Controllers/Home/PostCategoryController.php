<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostCategoryController extends Controller
{
    public function index()
    {
        $this->spladeTitle('Post Categories');

        $categories = Category::get();
        $posts = Post::with(['category', 'user'])->latest()->paginate(6);

        return view('pages.home.post-category', [
            'categories' => $categories,
            'posts' => $posts,
        ]);
    }

    public function categorySelect(Request $request)
    {
        $posts = Post::with(['category', 'user'])->whereHas('category', function ($query) use ($request) {
            $query->where('slug', $request->slug);
        })->latest()->paginate(6);
        $categories = Category::get();

        return view('pages.home.post-category', [
            'categories' => $categories,
            'posts' => $posts,
        ]);
    }

    public function loadMore(Request $request)
    {
        $page = $request->input('page', 2);
        $posts = Post::paginate(6, ['*'], 'page', $page);
        return view('pages.home.post-load', [
            'posts' => $posts,

        ]);
    }
}
