<x-app-layout>
    @include('layouts.navigation', ['username' => $username]);
    <style>
        body {
            background: linear-gradient(-20deg, #e9defa 0%, #fbfcdb 100%);
        }

        a {
            text-decoration: none;
        }
    </style>
    <div class="container" style="margin: auto; max-width: 935px;" id="app">
        <div class="row rounded-3 mb-3 pb-5"
            style="background: linear-gradient(135deg, rgb(255, 168, 168) 10%, rgb(252, 255, 0) 100%);">
            <div class="col-3 p-5">
                <img src="/storage/{{ $user->profile->image }}" class="rounded-circle"
                    style="width: 150px; height: 150px;" />
            </div>
            <div class="col-9 pt-5">
                <div class="pl-3 d-flex justify-content-between align-items-baseline">
                    <div class="d-flex align-items-center">
                        <div class="h2">{{ '@' . $username }} ·</div>
                        @auth
                            @if (Auth::user()->username !== $username)
                                <follow user-id="{{ $user->id }}" follows="{{ $follows }}"></follow>
                            @endif
                        @else
                            <follow user-id="{{ $user->id }}" follows="{{ $follows }}"></follow>
                        @endauth

                    </div>

                    @auth

                        @if (Auth::user()->username == $username)
                            <a class="text-primary" href={{ url('/p/create') }}>add a new post</a>
                        @else
                            <a class="px-2 py-0 d-flex align-items-center bg-light rounded-3 shadow " href="/chat/{{ $user->id }}">
                                <p class=" px-1 my-1 text-primary text-bald">Message</p>
                                @include('share-icon')
                            </a>
                        @endif
                    @endauth
                </div>
                @auth
                    @if (Auth::user()->username == $username)
                        <a href={{ route('page.edit', $user) }} class="pl-3 text-danger"> Edit profile Info</a>
                    @endif
                @endauth
                <div class="d-flex">
                    <div class="p-2"><strong>{{ $postsCount }} </strong>posts </div>
                    <div class="p-2"><a href="/page/{{ $user->id }}/followers" class="text-dark"
                            style="text-decoration: none"><strong>{{ $followersCount }} </strong>followers</a> </div>
                    <div class="p-2"><a href="/page/{{ $user->id }}/followings" class="text-dark"
                            style="text-decoration: none"><strong>{{ $followingsCount }} </strong>following </a></div>
                </div>
                <div class="pl-3 pt-3" style="font-weight: bold">{{ $user->profile->title ?? '' }}</div>
                <div class="pl-3">{{ $user->profile->description ?? '' }}</div>
                <div class="pl-3 text-primary"><a href="{{ $user->profile->url ?? '' }}">{{ $user->profile->url ?? '' }}</a>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($user->posts as $post)
                <div class="col-4 pb-4" style="width: 300px; height: 300px">
                    <a href="/p/{{ $post->id }}">
                        <img src="/storage/{{ $post->image }}" />
                    </a>
                </div>
            @endforeach
        </div>
</x-app-layout>
