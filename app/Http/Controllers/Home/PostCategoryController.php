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

        return view('pages.post.post-category', [
            'categories' => $categories,
        ]);
    }

    public function categorySelect(Request $request)
    {
        $posts = Post::with(['category', 'user'])->whereHas('category', function ($query) use ($request) {
            $query->where('slug', $request->slug);
        })->latest()->paginate(10);
        $categories = Category::get();

        return view('pages.post.post-category', [
            'categories' => $categories,
            'posts' => $posts,
        ]);
    }

    public function loadMore(Request $request, $slug = '')
    {
        $perPage = 10; // Jumlah item yang ingin Anda muat setiap kali
        $page = $request->input('page', 1); // Ambil nomor halaman dari permintaan, default 1

        $posts = Post::with('category', 'user')->orderBy('created_at')->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'data' => $posts, // Ambil item data dari objek Pagination
            'current_page' => $posts->currentPage(),
            'last_page' => $posts->lastPage(),
        ]);
    }

    /**
     * Load more posts for a given category.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function loadMoreCategory(Request $request, $slug)
    {
        $perPage = 10;
        $page = $request->input('page', 1);

        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = Post::with('category', 'user')
            ->where('category_id', $category->id)
            ->orderBy('created_at')
            ->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'data' => $posts,
            'current_page' => $posts->currentPage(),
            'last_page' => $posts->lastPage(),
        ]);
    }
}
