<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CommentsApiController extends Controller
{

    public function addComment(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'body' => 'required|string|max:255',
        ]);

        $errors = $validation->errors();
        if ($validation->fails()) {
            return response($errors->toJson(), 400);
        }

        $post = Post::find($id);
        if (!$post) {
            $error = array('postId' => 'The given post does not exist.');
            return response($error, 404);
        }

        $comment = new Comment;
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $post->id;
        $comment->body = $request->input('body');
        $comment->save();

        $comment['user_firstName'] = Auth::user()->firstName;
        $comment['user_lastName'] = Auth::user()->lastName;

        return $comment->toJson();
    }

    public function getComment(Request $request, $id)
    {
        $post = Post::find($id);
        if (!$post) {
            $error = array('postId' => 'The given post does not exist.');
            return response($error, 404);
        }

        $comments = DB::table('comments')
            ->where('post_id', $post->id)
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->select('comments.*', 'users.firstName as user_firstName', 'users.lastName as user_lastName')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return $comments;
    }

    public function deleteComment(Request $request, $postId, $commentId)
    {
        $post = Post::find($postId);
        if (!$post) {
            $error = array('postId' => 'The given post does not exist.');
            return response($error, 404);
        }

        $comment = Comment::where([['post_id', $postId], ['id', $commentId]])->first();

        if (!$comment || ($comment->user_id != Auth::user()->id && !Auth::user()->isAdmin())) {
            $error = array('commentId' => 'The given comment does not exist.');
            return response($error, 404);
        }

        $comment->delete();

        return 'Comment deleted';
    }
}
