<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Intervention\Image\Facades\Image;
use DB;

class PostsController extends Controller
{

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);
        return view('posts.index', ['posts'=>$posts, 'username'=> Auth::user()->username]);
    }

    public function create()
    {
        return view('posts/create', ['username' => Auth::user()->username]);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'caption' => 'required',
            'image' => ['required', 'mimetypes:image/png,image/jpeg,image/webp']
        ]);
        $imagePath = request('image')->store('uploads', 'public');

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath
        ]);
        return redirect('/page/' . Auth::user()->username);
    }
    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'username' => User::find($post->user_id)->username,
            'user' => User::find($post->user_id)
        ]);
    }
    public function destroy(Post $post)
    {
        if ($post->user->id !== auth()->user()->id) {
            abort(401);
        }
        DB::table('posts')->where('id', $post->id)->delete();
        return redirect('/page/' . Auth::user()->username);
    }
}
