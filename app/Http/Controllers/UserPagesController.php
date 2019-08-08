<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\User;
use App\Utils\SEO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserPagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('listPostRequest', 'showPostRequest', 'showAddPostRequest', 'deletePostRequest', 'addPostRequest', 'showProfile');
    }

    public function index(Request $request)
    {
        $posts = Post::leftJoin('users', 'users.id', '=', 'posts.author_id')
            ->select(DB::raw('posts.*, users.firstName as author_firstName, users.lastName as author_lastName'))
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        $categories = Category::all();
        $SEO = SEO::home($request->url());
        $data = array(
            'posts' => $posts,
            'title' => 'Home',
            'categories' => $categories,
            'SEO' => $SEO,
        );
        return view('user.index')->with($data);
    }

    public function categoryPage(Request $request, $slug)
    {
        $decodedSlug = urldecode($slug);
        $category = Category::where('name', '=', $decodedSlug)->first();
        if (!$category) {
            abort(404);
        }

        $posts = Post::leftJoin('users', 'users.id', '=', 'posts.author_id')
            ->select(DB::raw('posts.*, users.firstName as author_firstName, users.lastName as author_lastName'))
            ->where('category_id', $category->id)
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        $categories = Category::all();
        $SEO = SEO::home($request->url());
        $data = array(
            'posts' => $posts,
            'title' => $category->name,
            'categories' => $categories,
            'SEO' => $SEO,
        );
        return view('user.index')->with($data);
    }

    public function showPost(Request $request, $slug)
    {
        $decodedSlug = urldecode($slug);
        $post = Post::leftJoin('users', 'users.id', '=', 'posts.author_id')
            ->select(DB::raw('posts.*, users.firstName as author_firstName, users.lastName as author_lastName'))
            ->where('title', '=', $decodedSlug)
            ->first();
        if (!$post) {
            abort(404);
        }

        $categories = Category::all();
        $SEO = SEO::post($post, $request->url());
        $data = array(
            'post' => $post,
            'categories' => $categories,
            'SEO' => $SEO,
        );
        return view('user.post')->with($data);
    }

    public function showProfile(Request $request)
    {
        $data = array(
            'SEO' => SEO::minimal('Profile'),
            'categories' => Category::all(),
        );
        return view('user.profile', $data);
    }

    public function showTermsAndConditions()
    {
        $data = array(
            'SEO' => SEO::minimal('Terms And Conditions'),
            'categories' => Category::all(),
        );
        return view('user.termsAndConditions', $data);
    }

    public function showAuthorPage(Request $request, $id)
    {
        $author = User::where([['id', $id], ['type', User::AUTHOR_TYPE]])->first();
        if (!$author) {
            abort(404);
        }

        $posts = Post::leftJoin('users', 'users.id', '=', 'posts.author_id')
            ->select(DB::raw('posts.*, users.firstName as author_firstName, users.lastName as author_lastName'))
            ->where('author_id', $id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $data = array(
            'SEO' => SEO::author($author, $request->url()),
            'categories' => Category::all(),
            'author' => $author,
            'posts' => $posts,
        );

        return view('user.author', $data);
    }
}
