<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class UserPagesController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('user.index')->with('posts', $posts);
    }

    public function showPost(Request $request, $id)
    {
        $post = Post::find($id);
        return view('user.post')->with('post', $post);
    }
}
