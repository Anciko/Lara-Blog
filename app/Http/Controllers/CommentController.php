<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request) {
        $comment = new Comment();
        $comment->article_id = $request->article_id;
        $comment->user_id = $request->user_id;
        $comment->content = $request->content;

        $comment->save();

        return redirect()->back();
    }

    public function delete($id) {
        $comment = Comment::find($id);

        if(Gate::denies('comment-delete', $comment)) {
            return back()->with('error', 'Unauthorize');
        }

        $comment->delete();

        return redirect()->back();
    }
}
