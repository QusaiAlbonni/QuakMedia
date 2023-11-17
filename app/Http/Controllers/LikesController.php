<?php

namespace App\Http\Controllers;

use App\Models\comment;
use App\Models\Post;
use App\Models\reply;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function store(Post $post){
        return auth()->user()->likes()->toggle($post->id);
    }
    public function likecomment(comment $comment){
        return auth()->user()->commentlikes()->toggle($comment->id);
    }
    public function likereply(reply $reply){
        return auth()->user()->replylikes()->toggle($reply->id);
    }
}
