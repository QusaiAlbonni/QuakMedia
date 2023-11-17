<?php

namespace App\Http\Controllers;

use App\Models\comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function store()
    {
        $data = request()->validate([
            'comment_text' => ['string', 'max:500', 'required']
        ]);
        $comment = auth()->user()->comments()->create([
            'post_id' => request()->post,
            'comment_text' => request()->comment_text,

        ]);
        return $comment;
    }
    public function destroy(comment $comment)
    {
        if ($comment->user->id !== Auth::user()->id) {
            abort(401);
        }
        $comment->replies()->delete();
        $commentgone = DB::table('comments')->where('id', $comment->id)->delete();
        return $commentgone;
    }
    public function update(comment $comment)
    {
        if ($comment->user->id !== Auth::user()->id) {
            abort(401);
        }
        else {
            $data = request()->validate([
                'comment_text'=>'required',
            ]);
            return ['status' => request()->comment->update(['comment_text' => request()->comment_text]), 'comment'=>$comment, 'new_comment'=>request()->comment_text];
        }
    }
}
