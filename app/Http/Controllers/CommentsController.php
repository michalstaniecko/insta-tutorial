<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{

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
        return redirect('/p/'.$post->id);

    }
}
