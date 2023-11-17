<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $resultCount = 0;
        if (request('search')) {
            $users = User::where('username', 'like', '%' . request('search') . '%')->latest()->paginate(5);
            $resultCount = User::where('username', 'like', '%' . request('search') . '%')->latest()->get()->count();
        } else {
            $users = User::latest()->paginate(5);
            $resultCount = User::latest()->get()->count();
        }

        return view('search.index', [
            'username' => (auth()->user()) ? auth()->user()->username : null,
            'users' => $users,
            'placeholder'=> request('search'),
            'resultCount' => $resultCount
        ]);
    }
}
