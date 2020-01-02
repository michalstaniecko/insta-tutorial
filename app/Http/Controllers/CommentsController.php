<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function store(Post $post) {
        $data = \request()->validate([
            'content' => 'required',
            'parent_id' => ''
        ]);
        $post->comments()->create(array_merge(
            $data,
            [
                'user_id' => auth()->user()->id
            ]
        ));
        return redirect('/p/' . $post->id);

    }

    public function fetchComments(Post $post) {

        $offset = request('offset');
        $comments = $post->comments();
        $commentsCount = $comments->count();
        $comments = $comments->latest()->offset($offset)->limit(5)->get();

        return response()->json(['comments' => $comments, 'count' => $commentsCount]);
    }

    public function fetchReplyComments(Comment $comment) {

        $offset = request('offset');
        $comments = $comment->replies();
        $count = $comments->count();
        $comments = $comments->latest()->offset($offset)->limit(5)->get();
        return response()->json(['comments' => $comments, 'count' => $count]);
    }
}
