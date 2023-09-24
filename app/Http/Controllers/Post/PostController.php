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

        return view('pages.post.show', [
            'post' => $post
        ]);
    }
}
