<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class AdminPagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('is_admin');
    }

    public function index()
    {
        return redirect('/admin/posts');
    }

    public function listPosts()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.post.index')->with('posts', $posts);
    }

    public function showPost(Request $request, $id)
    {
        $post = Post::find($id);
        return view('admin.post.show')->with('post', $post);
    }

    public function editPostPage(Request $request, $id)
    {
        $post = Post::find($id);
        return view('admin.post.edit')->with('post', $post);
    }

    public function editPost(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $post = Post::find($id);

        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();

        $request->session()->flash('success', 'Post updated successfully!');

        return redirect('/admin/posts');
    }

    public function addPostPage()
    {
        return view('admin.post.add');
    }

    public function addPost(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ]);

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();

        $request->session()->flash('success', 'Post added successfully!');

        return redirect('/admin/posts');
    }

    public function deletePost(Request $request, $id)
    {
        $post = Post::find($id);

        $post->delete();
        $request->session()->flash('success', 'Post deleted successfully!');
        return redirect('/admin/posts');
    }

}
