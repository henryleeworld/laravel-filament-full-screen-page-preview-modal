<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        abort_unless($post = Post::whereSlug($slug)->first(), 404);

        return view('post.show', ['post' => $post]);
    }
}
