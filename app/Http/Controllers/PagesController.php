<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class PagesController extends Controller
{
    public function index($user)
    {
        $userVar = DB::table('users')->where('username', $user)->get();
        if ($userVar->value('username') !== null) {
            $userObj = User::find($userVar->value('id'));
            $follows = (auth()->user()) ? auth()->user()->following->contains($userObj->profile->id) : false;

            $followings = Cache::remember(
                'count.followings.' . $userObj->id,
                now()->addSeconds(30),
                function () use ($userObj) {
                    return $userObj->following->count();
                }
            );
            $followers = Cache::remember(
                'count.followers.' . $userObj->id,
                now()->addSeconds(30),
                function () use ($userObj) {
                    return $userObj->profile->followers->count();
                }
            );
            $posts = Cache::remember(
                'count.posts.' . $userObj->id,
                now()->addSeconds(30),
                function () use ($userObj) {
                    return $userObj->posts->count();
                }
            );


            return view('/pages/dashboard', [
                'username' => $userVar->value('username'),
                'name' => $userVar->value('name'),
                'email' => $userVar->value('email'),
                'user' => $userObj,
                'follows' => $follows,
                'followingsCount' => $followings,
                'followersCount' => $followers,
                'postsCount' => $posts,
            ]);
        } else
            abort(404);
    }
    public function main()
    {
        if (isset(Auth::user()->username)) {
            return redirect('/page/' . Auth::user()->username);
        } else
            return redirect('login');
    }
    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);
        return view('pages.edit', compact('user'));
    }
    public function update(User $user)
    {
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => ['mimetypes:image/png,image/jpeg,image/webp', 'max:5120'],
        ]);
        if (request('image')) {
            $imagePath = request('image')->store('profile', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();

            $data = array_merge(
                $data,
                ['image' => $imagePath]
            );

        }


        auth()->user()->profile->update($data);

        return redirect('page');
    }

    public function followers(User $user){
        $users = $user->profile->followers()->paginate(5);
        return view('follow.followers',[
            'users'=>$users
        ]);
    }
    public function followings(User $user){
        $profiles = $user->following()->paginate(5);
        return view('follow.followings',[
            'profiles'=>$profiles
        ]);
    }
}
