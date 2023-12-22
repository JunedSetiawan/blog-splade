<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\StorePostRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\FileUploads\ExistingFile;

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
            $posts = Post::with('category', 'user')->where('status', 'active')->orderBy('created_at', 'desc')->paginate($perPage, ['*'], 'page', $page);
        } elseif ($filter === 'oldest') {
            $posts = Post::orderBy('created_at', 'asc')->where('status', 'active')->with('category', 'user')->paginate($perPage, ['*'], 'page', $page);
        } elseif ($filter === 'popular') {
            $posts = Post::orderBy('likes_count', 'desc')->where('status', 'active')->with('category', 'user')->paginate($perPage, ['*'], 'page', $page);
        } else {
            $posts = Post::with('category', 'user')->where('status', 'active')->inRandomOrder()->paginate($perPage, ['*'], 'page', $page);
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

        $this->spladeTitle($post->title);

        $match_posts = Post::query()->with('category')->where('category_id', $post->category_id)->where('id', '!=', $post->id)->where('status', 'active')->limit(6)->get();
        if ($post->status === 'inactive') {
            Toast::message('Your Post Has Been TakdeDown, Please Delete your post')->danger();
            return view('pages.post.report-show', [
                'match_posts' => $match_posts,
                'post' => $post
            ]);
        }
        $tags = $post->tags()->pluck('tags.name', 'tags.id')->toArray();
        $comments = $post->comments()->with('user')->orderBy('created_at', 'desc')->get();

        return view('pages.post.show', [
            'post' => $post,
            'match_posts' => $match_posts,
            'comments' => $comments,
            'tags' => $tags
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
        $tags = Tag::query()->pluck('name', 'id')->toArray();

        return view('pages.post.create', [
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    public function store(StorePostRequest $request)
    {
        $this->authorize('create', Post::class);

        if ($request->hasFile('image')) {
            $ext = $request->file('image')->getClientOriginalExtension();
            $data = $request->file('image')->store('public/images');
            $filename = pathinfo($data, PATHINFO_FILENAME) . '.' . $ext;
        }

        $validated = $request->validated();

        $validated['image'] = $filename ?? null;
        $validated['user_id'] = auth()->user()->id;

        $post = Post::create($validated);

        if ($request->has('tag_id')) {
            $post->tags()->attach($request->tag_id);
        }

        Toast::message('Created Post Successfully!')->autoDismiss(5);

        return redirect()->route('personal-post');
    }

    public function edit($id)
    {
        $this->spladeTitle('Edit Post');

        $post = Post::findOrFail($id);

        if ($post->status === 'inactive') {
            Toast::message('Your Post Has Been TakdeDown, Please Delete your post')->danger();
            abort(404);
        }

        $categories = Category::query()->pluck('name', 'id')->toArray();
        $tags = Tag::query()->pluck('name', 'id')->toArray();

        if ($post->image) {
            $image = ExistingFile::fromDisk('public')->get('images/' . $post->image);
        } else {
            $image = null;
        }

        return view('pages.post.edit', [
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags,
            'image' => $image
        ]);
    }

    public function update(StorePostRequest $request, $id)
    {
        $post = Post::findOrFail($id);

        if ($post->status === 'inactive') {
            Toast::message('Your Post Has Been TakdeDown, Please Delete your post')->danger();
            abort(404);
        }

        $this->authorize('update', $post);

        // Update judul dan konten aktivitas
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->category_id = $request->category_id;
        $post->tags()->sync($request->tags);
        $post->user_id = auth()->user()->id;

        // Jika ada file gambar baru yang diunggah
        if ($request->hasFile('image')) {
            // Menghapus gambar lama (jika ada)

            if ($post->image) {
                // Use the public disk and the correct file path
                $filePath = 'images/' . $post->image;

                // Check if the file exists
                if (Storage::disk('public')->exists($filePath)) {
                    // Delete the file
                    Storage::disk('public')->delete($filePath);
                }
            }

            // Upload dan menyimpan gambar baru
            $ext = $request->file('image')->getClientOriginalExtension();
            $data = $request->file('image')->store('public/images');
            $filename = pathinfo($data, PATHINFO_FILENAME) . '.' . $ext;

            $post->image = $filename;
        } else {
            // Jika tidak ada file gambar baru, tetapi ada gambar lama yang dipilih
            if ($request->image_existing) {
                $post->image = $request->image_existing;
            }
        }

        $post->save();

        Toast::message('Successfully updated the post')->autoDismiss(5);

        return redirect()->route('personal-post');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->status === 'inactive') {
            Toast::message('Your Post Has Been TakdeDown, Please Delete your post')->danger();
            abort(404);
        }
        $this->authorize('delete', [$post, Post::class]);

        // Use the public disk and the correct file path
        $filePath = 'images/' . $post->image;

        // Check if the file exists
        if (Storage::disk('public')->exists($filePath)) {
            // Delete the file
            Storage::disk('public')->delete($filePath);
        }

        $post->delete();

        Toast::message('Deleted Post Successfully!')->autoDismiss(5);

        return redirect()->route('personal-post');
    }

    public function likeStore($id)
    {
        $post = Post::findOrFail($id);

        if ($post->status === 'inactive') {
            Toast::message('Your Post Has Been TakdeDown, Please Delete your post')->danger();
            abort(404);
        }

        if ($post->likes_count >= 0) {
            $user = Auth::user();
            if ($user->hasLiked($post)) {
                // Unlike the post
                $post->decrement('likes_count');
                $user->likes()->detach($post);
            } else {
                // Like the post
                $post->increment('likes_count');
                $user->likes()->attach($post);
            }

            return $post->save();
        }
    }

    public function commentStore(StoreCommentRequest $request, $id)
    {
        $post = Post::findOrFail($id);

        if ($post->status === 'inactive') {
            Toast::message('Your Post Has Been TakdeDown, Please Delete your post')->danger();
            abort(404);
        }
        $validated = $request->validated();

        $validated['user_id'] = auth()->user()->id;

        $post->comments()->create($validated);

        Toast::message('Commented Post Successfully!')->autoDismiss(5);

        return $post->save();
    }

    public function commentDestroy(Post $post, Comment $comment)
    {
        if ($post->status === 'inactive') {
            Toast::message('Your Post Has Been TakdeDown, Please Delete your post')->danger();
            abort(404);
        }
        if ($comment->post_id === $post->id && auth()->user()->id === $comment->user_id) {
            $comment->delete();
            Toast::message('Comment Deleted !')->autoDismiss(5);
            return redirect()->back();
        }
    }
}
