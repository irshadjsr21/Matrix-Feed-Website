<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Rules\CategoryId;
use Illuminate\Http\Request;

class AdminPostsController extends Controller
{
    private $folder = 'images';

    public function __construct()
    {
        $this->middleware('is_admin');
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
        $categories = Category::all();

        $data = array(
            'post' => $post,
            'categories' => $categories,
        );
        return view('admin.post.edit')->with($data);
    }

    public function editPost(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'author' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'body' => 'required',
            'description' => 'nullable',
            'category' => ['required', new CategoryId],
        ]);

        $post = Post::find($id);

        $post->title = $request->input('title');
        $post->author = $request->input('author');
        $post->category_id = $request->input('category');
        $post->body = $request->input('body');
        $post->description = $request->input('description');

        if ($request->has('image') && $request->file('image')) {
            $image = $request->file('image');
            $this->deleteImage($post->image);
            $post->image = $this->addImage($image, $request->input('title'));
        }

        $post->save();

        $request->session()->flash('success', 'Post updated successfully!');

        return redirect('/admin/posts');
    }

    public function addPostPage()
    {
        $categories = Category::all();
        return view('admin.post.add')->with('categories', $categories);
    }

    public function addPost(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:posts|max:255',
            'author' => 'required',
            'body' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif',
            'description' => 'nullable',
            'category' => ['required', new CategoryId],
        ]);

        $post = new Post;
        $post->title = $request->input('title');
        $post->author = $request->input('author');
        $post->category_id = $request->input('category');
        $post->body = $request->input('body');
        $post->description = $request->input('description');

        if ($request->has('image')) {
            $image = $request->file('image');
            $post->image = $this->addImage($image, $request->input('title'));
        }

        $post->save();

        $request->session()->flash('success', 'Post added successfully!');

        return redirect('/admin/posts');
    }

    public function deletePost(Request $request, $id)
    {
        $post = Post::find($id);

        $this->deleteImage($post->image);
        $post->delete();
        $request->session()->flash('success', 'Post deleted successfully!');
        return redirect('/admin/posts');
    }

    private function addImage($image, $title)
    {
        $name = str_slug($title) . '_' . time() . '.' . $image->getClientOriginalExtension();
        $filePath = '/' . $this->folder . '/' . $name;
        $image->move(public_path($this->folder), $name);
        return $filePath;
    }

    private function deleteImage($imageUrl)
    {
        $imageUrlArray = explode('/', $imageUrl);
        $imageName = $imageUrlArray[sizeof($imageUrlArray) - 1];
        $imagePath = public_path($this->folder . '/' . $imageName);
        if (file_exists($imagePath)) {
            @unlink($imagePath);
        }
    }
}
