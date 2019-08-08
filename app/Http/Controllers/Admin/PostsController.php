<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Rules\CategoryId;
use App\User;
use App\Utils\Upload;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('is_author');
    }

    public function listPosts()
    {
        $posts = DB::table('posts')
            ->leftJoin('users', 'users.id', '=', 'posts.author_id')
            ->select(DB::raw('posts.*, users.firstName as author_firstName, users.lastName as author_lastName'))
            ->orderBy('created_at', 'desc')
            ->paginate(9);
        return view('admin.post.index')->with('posts', $posts);
    }

    public function showPost(Request $request, $id)
    {
        $post = Post::find($id);
        if (!$post) {
            abort(404);
        }

        $category = $post->category;
        $author = $post->authorObj;
        $data = array(
            'post' => $post,
            'category' => $category,
            'author' => $author,
        );
        return view('admin.post.show')->with($data);
    }

    public function editPostPage(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            abort(404);
        }

        if (!(Auth::user()->isAdmin() || $post->author_id == Auth::user()->id)) {
            abort(401);
        }

        $categories = Category::all();
        $authors = User::where('type', User::AUTHOR_TYPE)->get();

        $data = array(
            'post' => $post,
            'categories' => $categories,
            'authors' => $authors,
        );
        return view('admin.post.edit')->with($data);
    }

    public function editPost(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|regex:/^[a-zA-Z0-9_()*\-.!&@$\s]*$/|max:255',
            'author' => 'nullable',
            'authorId' => 'nullable',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'body' => 'required',
            'description' => 'required',
            'keywords' => 'required',
            'category' => ['required', new CategoryId],
        ]);

        $post = Post::find($id);

        if (!$post) {
            abort(404);
        }

        if (!(Auth::user()->isAdmin() || $post->author_id == Auth::user()->id)) {
            abort(401);
        }

        $posts = Post::where([['title', $request->input('title')], ['id', '!=', $id]])->count();
        if ($posts != 0) {
            $error = ValidationException::withMessages(['title' => 'Post with this title already exists.']);
            throw $error;
        }

        $authorName = $request->author;
        $authorId = $request->authorId;

        if (Auth::user()->isAuthor()) {
            $authorId = Auth::user()->id;
            $authorName = null;
        }

        if ($authorId == -1 && !$authorName) {
            $error = ValidationException::withMessages(['authorId' => 'Please select author from dropdown or provide the author name.']);
            throw $error;
        }

        $post->title = $request->input('title');
        $post->category_id = $request->input('category');
        $post->body = $request->input('body');
        $post->description = $request->input('description');
        $post->keywords = $request->input('keywords');

        if ($authorId != -1) {
            $author = User::where([['id', $authorId], ['type', User::AUTHOR_TYPE]])->count();
            if ($author <= 0) {
                $error = ValidationException::withMessages(['authorId' => 'The selected author does not exist.']);
                throw $error;
            }
            $post->author_id = $authorId;
            $post->author = null;
        } else {
            $post->author = $authorName;
            $post->author_id = null;
        }

        if ($request->has('image') && $request->file('image')) {
            $image = $request->file('image');
            Upload::deleteImage($post->image);
            $post->image = Upload::addImage($image, $request->input('title'));
        }

        $post->save();

        $request->session()->flash('success', 'Post updated successfully!');

        return redirect('/admin/posts');
    }

    public function addPostPage()
    {
        $categories = Category::all();
        $authors = User::where('type', User::AUTHOR_TYPE)->get();
        $data = array(
            'categories' => $categories,
            'authors' => $authors,
        );
        return view('admin.post.add')->with($data);
    }

    public function addPost(Request $request)
    {
        $request->validate([
            'title' => 'required|regex:/^[a-zA-Z0-9_()*\-.!&@$\s]*$/|unique:posts|max:255',
            'author' => 'nullable',
            'authorId' => 'nullable',
            'body' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif',
            'description' => 'required',
            'keywords' => 'required',
            'category' => ['required', new CategoryId],
        ]);

        $authorName = $request->author;
        $authorId = $request->authorId;

        if (Auth::user()->isAuthor()) {
            $authorId = Auth::user()->id;
            $authorName = null;
        }

        if ($authorId == -1 && !$authorName) {
            $error = ValidationException::withMessages(['authorId' => 'Please select author from dropdown or provide the author name.']);
            throw $error;
        }

        $post = new Post;
        $post->title = $request->input('title');
        $post->category_id = $request->input('category');
        $post->body = $request->input('body');
        $post->description = $request->input('description');
        $post->keywords = $request->input('keywords');

        if ($authorId != -1) {
            $author = User::where([['id', $authorId], ['type', User::AUTHOR_TYPE]])->count();
            if ($author <= 0) {
                $error = ValidationException::withMessages(['authorId' => 'The author selected does not exist.']);
                throw $error;
            }
            $post->author_id = $authorId;
        } else {
            $post->author = $authorName;
        }

        if ($request->has('image')) {
            $image = $request->file('image');
            $post->image = Upload::addImage($image, $request->input('title'));
        }

        $post->save();

        $request->session()->flash('success', 'Post added successfully!');

        return redirect('/admin/posts');
    }

    public function deletePost(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            abort(404);
        }

        if (!(Auth::user()->isAdmin() || $post->author_id == Auth::user()->id)) {
            abort(401);
        }

        Upload::deleteImage($post->image);
        $post->delete();
        $request->session()->flash('success', 'Post deleted successfully!');
        return redirect('/admin/posts');
    }
}
