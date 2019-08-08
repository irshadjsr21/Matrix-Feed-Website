<?php

namespace App\Http\Controllers;

use App\Category;
use App\PostRequest;
use App\Rules\CategoryId;
use App\Utils\SEO;
use App\Utils\Upload;
use Auth;
use Illuminate\Http\Request;

class PostRequestsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function list() {
        $posts = Auth::user()->postRequests;

        $data = array(
            'SEO' => SEO::minimal('Requested Posts'),
            'categories' => Category::all(),
            'posts' => $posts,
        );

        return view('user.postRequest.index')->with($data);
    }

    public function showAdd()
    {
        $data = array(
            'SEO' => SEO::minimal('Add your post to Matrix Feed'),
            'categories' => Category::all(),
        );

        return view('user.postRequest.add')->with($data);
    }

    public function add(Request $request)
    {
        $request->validate([
            'title' => 'required|regex:/^[a-zA-Z0-9_()*\-.!&@$\s]*$/|unique:posts|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
            'body' => 'required|min:500',
        ]);

        $postReq = new PostRequest;
        $postReq->title = $request->input('title');
        $postReq->user_id = Auth::user()->id;
        $postReq->body = $request->input('body');

        if ($request->has('image')) {
            $image = $request->file('image');
            $postReq->image = Upload::addImage($image, $request->input('title'));
        }

        $postReq->save();

        $request->session()->flash('success', 'Post Requested added successfully!');

        return redirect('/post-request');
    }

    public function show(Request $request, $id)
    {
        $post = PostRequest::where([['id', $id], ['user_id', Auth::user()->id]])->first();

        if (!$post) {
            abort(404);
        }

        $data = array(
            'SEO' => SEO::post($post, $request->url()),
            'categories' => Category::all(),
            'post' => $post,
        );

        return view('user.postRequest.show')->with($data);
    }

    public function delete(Request $request, $id)
    {
        $post = PostRequest::where([['id', $id], ['user_id', Auth::user()->id]])->first();

        if (!$post) {
            abort(404);
        }

        Upload::deleteImage($post->image);
        $post->delete();
        $request->session()->flash('success', 'Post Request deleted successfully!');
        return redirect('/post-request');
    }
}
