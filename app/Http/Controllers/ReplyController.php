<?php

namespace App\Http\Controllers;

use App\Models\reply;
use Illuminate\Http\Request;
use App\Http\Requests\StorereplyRequest;
use App\Http\Requests\UpdatereplyRequest;
use DB;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'text'=>['string', 'max:500', 'required']
        ]);
        $reply = auth()->user()->replies()->create([
            'comment_id'=> $request->comment,
            'reply_text'=>$request->text,

        ]);
        return $reply;
    }

    /**
     * Display the specified resource.
     */
    public function show(reply $reply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(reply $reply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(reply $reply)
    {
        if ($reply->user->id !== Auth::user()->id) {
            abort(401);
        }
        else {
            $data = request()->validate([
                'comment_text'=>'required',
            ]);
            return ['status' => request()->reply->update(['reply_text' => request()->comment_text]), 'comment'=>$reply, 'new_comment'=>request()->comment_text];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(reply $reply)
    {
        if ($reply->user->id !== auth()->user()->id) {
            abort(401);
        }
        $status = DB::table('replies')->where('id', $reply->id)->delete();
        return $status;
    }
}
