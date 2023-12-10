<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function personal_post()
    {
        $posts = Post::with('user', 'category')->where('user_id', Auth::user()->id)->paginate(6);

        return view('pages.post.personal-post', [
            'posts' => $posts
        ]);
    }

    // create method for create post, update post, and delete post
    public function create()
    {
        $this->spladeTitle('Create Post');
        $categories = Category::query()->pluck('name', 'id')->toArray();
        // dd($categories);

        return view('pages.post.create', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        dd($request->all());
        $request->validate([
            'title' => 'required|min:10|max:255',
            'category_id' => 'required|exists:categories,id',
            'body' => 'required|min:10',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $thumbnail = $request->file('thumbnail')->store('images/posts');

        $post = Post::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'body' => $request->body,
            'thumbnail' => $thumbnail,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('post.show', $post->id)->with('success', 'Post was created!');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        $this->spladeTitle('Edit Post');

        return view('pages.post.edit', [
            'post' => $post,
        ]);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title' => 'required|min:10|max:255',
            'category_id' => 'required|exists:categories,id',
            'body' => 'required|min:10',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $thumbnail = $post->thumbnail;

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail')->store('images/posts');
        }

        $post->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'body' => $request->body,
            'thumbnail' => $thumbnail,
        ]);

        return redirect()->route('post.show', $post->id)->with('success', 'Post was updated!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $post->delete();

        return redirect()->route('post.index')->with('success', 'Post was deleted!');
    }
}
