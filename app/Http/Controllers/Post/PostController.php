<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{

    public function index(Request $request)
    {
        $this->spladeTitle('Posts');

        $filters = ['all', 'latest', 'oldest', 'popular'];
        $selectedFilter = $request->route('filter');

        if (!in_array($selectedFilter, $filters)) {
            $selectedFilter = 'all';
        }

        return view('pages.post.index', [
            'filters' => $filters,
            'selectedFilter' => $selectedFilter,
        ]);
    }

    public function filter(Request $request, $filter = 'all')
    {
        $perPage = 10; // Jumlah item yang ingin Anda muat setiap kali
        $page = $request->input('page', 1); // Ambil nomor halaman dari permintaan, default 1

        if ($filter === "latest") {
            $posts = Post::with('category', 'user')->orderBy('created_at', 'desc')->paginate($perPage, ['*'], 'page', $page);
        } elseif ($filter === 'oldest') {
            $posts = Post::orderBy('created_at', 'asc')->with('category', 'user')->paginate($perPage, ['*'], 'page', $page);
        } elseif ($filter === 'popular') {
            $posts = Post::orderBy('likes_count', 'desc')->with('category', 'user')->paginate($perPage, ['*'], 'page', $page);
        } else {
            $posts = Post::with('category', 'user')->inRandomOrder()->paginate($perPage, ['*'], 'page', $page);
        }

        // Return the posts
        return response()->json([
            'data' => $posts, // Ambil item data dari objek Pagination
            'current_page' => $posts->currentPage(),
            'last_page' => $posts->lastPage(),
        ]);
    }
    public function show($id)
    {
        $post = Post::findOrFail($id);

        $match_posts = Post::query()->where('category_id', $post->category_id)->where('id', '!=', $post->id)->limit(6)->get();

        return view('pages.post.show', [
            'post' => $post,
            'match_posts' => $match_posts,
        ]);
    }
}
