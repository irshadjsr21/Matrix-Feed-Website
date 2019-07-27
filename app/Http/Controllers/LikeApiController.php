<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use Auth;
use Illuminate\Http\Request;

class LikeApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addLike(Request $request, $id)
    {
        $post = Post::find($id);
        if (!$post) {
            $error = array('postId' => 'The given post does not exist.');
            return response($error->toJson(), 404);
        }
        $like = Like::where([['post_id', $post->id], ['user_id', Auth::user()->id]])->first();
        if ($like) {
            $like->delete();
            $data = array("liked" => false);
        } else {
            $newLike = new Like;
            $newLike->user_id = Auth::user()->id;
            $newLike->post_id = $post->id;
            $newLike->save();
            $data = array("liked" => true);
        }

        return $data;
    }

    public function getLike(Request $request, $id)
    {
        $post = Post::find($id);
        if (!$post) {
            $error = array('postId' => 'The given post does not exist.');
            return response($error->toJson(), 404);
        }
        $like = Like::where([['post_id', $post->id], ['user_id', Auth::user()->id]])->count();
        if ($like) {
            $data = array("liked" => true);
        } else {
            $data = array("liked" => false);
        }
        return $data;
    }
}
