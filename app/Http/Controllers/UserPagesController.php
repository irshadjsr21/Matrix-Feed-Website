<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Utils\SEO;
use Illuminate\Http\Request;

class UserPagesController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(15);
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

    public function categoryPage(Request $request, $id)
    {
        $category = Category::find($id);
        $posts = Post::where('category_id', $id)->orderBy('created_at', 'desc')->paginate(15);
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

    public function showPost(Request $request, $id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $SEO = SEO::post($post, $request->url());
        $data = array(
            'post' => $post,
            'categories' => $categories,
            'SEO' => $SEO,
        );
        return view('user.post')->with($data);
    }
}
