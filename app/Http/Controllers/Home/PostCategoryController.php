<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostCategoryController extends Controller
{
    public function index()
    {
        $this->spladeTitle('Blog Splade');

        return view('pages.home.post-category');
    }
}
