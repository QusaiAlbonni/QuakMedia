<x-app-layout>
    @include('layouts.navigation', ['username' => Auth::user() ? Auth::user()->username : null])
    <div class="container p-5 rounded-4 mt-5 w-50" style="" id="app">
        <div class="h4">Followers</div>
        @foreach ($users as $user)
            <div class="row items-center pb-4 pt-4">
                <div class="col-4">
                    <a href="{{ route('page.show', $user->username) }}">
                        <img src="/storage/{{ $user->profile->image }}" class="w-75 rounded-circle">
                    </a>
                </div>
                <div class="col-8">
                    <div class="h3"><a href="{{ route('page.show', $user->username) }}" class="text-dark"
                            style="text-decoration: none">{{ '@' . $user->username }}</a></div>
                    <div class="d-flex justify-content-between">
                        <p>{{ $user->profile->followers->count() }} followers</p>
                        @auth
                            @if (Auth::user()->username !== $user->username)
                                <follow user-id="{{ $user->id }}"
                                    follows="{{ auth()->user()? auth()->user()->following->contains($user->profile->id): false }}">
                                </follow>
                            @endif
                        @else
                            <follow user-id="{{ $user->id }}"
                                follows="{{ auth()->user()? auth()->user()->following->contains($user->profile->id): false }}">
                            </follow>
                        @endauth

                    </div>
                    <div>
                        <p>{{ $user->profile->title }}</p>
                    </div>
                </div>
            </div>
            <hr>
        @endforeach
        <div class="row p-5">
            <div class="col-12 d-flex justify-content-center">
                {{ $users->links() }}
            </div>
        </div>
        @if($users->count() == 0)
        <div class="row p-5">
            <div class="col-12 d-flex justify-content-center text-center text-muted h5">
                <h3>This User Doesnt have any followers!</h3>
            </div>
        </div>
        @endif
    </div>
</x-app-layout>
