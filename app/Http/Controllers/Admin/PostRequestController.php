<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\PostRequest;
use App\Rules\CategoryId;
use App\Utils\Upload;
use Illuminate\Http\Request;

class PostRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('is_admin');
    }

    function list(Request $request) {
        $query = $request->input('only');

        if (!($query == 'process' || $query == 'accepted' || $query == 'rejected')) {
            $query = null;
        }

        if ($query) {
            $posts = PostRequest::where('status', $query)->orderBy('created_at', 'desc')->paginate(9);

        } else {
            $posts = PostRequest::orderBy('created_at', 'desc')->paginate(9);
        }

        return view('admin.postRequest.index')->with('posts', $posts);
    }

    public function show(Request $request, $id)
    {
        $post = PostRequest::find($id);
        if (!$post) {
            abort(404);
        }

        $user = $post->user;
        $data = array(
            'post' => $post,
            'user' => $user,
            'categories' => Category::all(),
        );

        return view('admin.postRequest.show')->with($data);
    }

    public function accept(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|regex:/^[a-zA-Z0-9_()*\-.!&@$\s]*$/|unique:posts|max:255',
            'body' => 'required',
            'description' => 'required',
            'keywords' => 'required',
            'category' => ['required', new CategoryId],
            'review' => 'nullable|string|max:150',
        ]);

        $postRequest = PostRequest::find($id);
        $user = $postRequest->user;

        if (!$postRequest) {
            abort(404, 'Post Request not found.');
        }

        if (!$user) {
            abort(404, 'User that request the post does not exist.');
        }

        $post = new Post;

        $post->title = $request->input('title');
        $post->category_id = $request->input('category');
        $post->body = $request->input('body');
        $post->description = $request->input('description');
        $post->keywords = $request->input('keywords');
        $post->author = $user->firstName . ' ' . $user->lastName;
        $post->image = Upload::duplicateImage($postRequest->image, $post->title);

        $post->save();

        $postRequest->status = PostRequest::STATUS_ACCEPTED;
        $postRequest->post_id = $post->id;
        $postRequest->review = $request->input('review');

        $postRequest->save();

        $request->session()->flash('success', 'Post added successfully!');
        return back();
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'review' => 'nullable|string|max:150',
        ]);

        $postRequest = PostRequest::find($id);

        if (!$postRequest) {
            abort(404, 'Post Request not found.');
        }

        $postRequest->status = PostRequest::STATUS_REJECTED;
        $postRequest->review = $request->input('review');

        $postRequest->save();

        return back();
    }

    public function delete(Request $request, $id)
    {
        $post = PostRequest::find($id);

        if (!$post) {
            abort(404);
        }

        Upload::deleteImage($post->image);
        $post->delete();
        $request->session()->flash('success', 'Post Request deleted successfully!');
        return redirect('/admin/post-request');
    }
}
