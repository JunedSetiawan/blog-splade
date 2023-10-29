<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
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
