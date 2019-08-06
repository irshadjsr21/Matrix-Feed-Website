<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use Auth;
use Illuminate\Http\Request;

class LikeApiController extends Controller
{
    public function addLike(Request $request, $id)
    {
        $post = Post::find($id);
        if (!$post) {
            $error = array('postId' => 'The given post does not exist.');
            return response($error, 404);
        }

        $like = Like::where([['post_id', $post->id], ['user_id', Auth::user()->id]])->first();

        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            $newLike = new Like;
            $newLike->user_id = Auth::user()->id;
            $newLike->post_id = $post->id;
            $newLike->save();
            $liked = true;
        }

        $totalLikes = Like::where('post_id', $post->id)->count();
        $data = array('liked' => $liked, 'total' => $totalLikes);
        return $data;
    }

    public function getLike(Request $request, $id)
    {
        $post = Post::find($id);
        if (!$post) {
            $error = array('postId' => 'The given post does not exist.');
            return response($error, 404);
        }
        $like = false;
        if (Auth::user()) {
            $like = Like::where([['post_id', $post->id], ['user_id', Auth::user()->id]])->count();
        }
        $totalLikes = Like::where('post_id', $post->id)->count();

        $data = array('liked' => $like, 'total' => $totalLikes);
        return $data;
    }
}
