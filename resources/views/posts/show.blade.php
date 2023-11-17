<x-app-layout>

    @include('layouts.navigation')

    <div class="container p-5 mb-3" id="app">
        <div class="row w-75 mx-auto mh-50 m-2 rounded-3" style="background:#fffd6e">
            <div class="col-6 p-0">
                <img class="w-100" style="border-top-left-radius: 1.3%; border-bottom-left-radius: 1.3%" src="/storage/{{ $post->image }}" class="w-100 float-right rounded-2" oncontextmenu="return false" />

            </div>
            <div class="col-6">
                <div>
                    <div class="d-flex align-items-center">
                        <div class="p-3">
                            <a href="{{ route('page.show', $post->user->username) }}">
                                <img src="/storage/{{ $post->user->profile->image }}" class="w-20 rounded-circle" oncontextmenu="return false">
                            </a>
                        </div>
                        <div>
                            <div class="w-100 d-flex">
                                <a class="text-black font-weight-bold p-2 pb-0"
                                    href="{{ route('page.show', $post->user->username) }}"
                                    style="text-decoration: none;">
                                    <span class="h5">{{ $post->user->name }}</span>
                                </a>
                                <span class="h3 mt-1 mr-1 mb-0">· </span>
                                <div class="d-flex justify-content-between mt-2 mb-0">
                                    <div>
                                        @auth
                                            @if (Auth::user()->username !== $username)
                                                <follow user-id="{{ $post->user->id }}"
                                                    follows="{{ auth()->user()? auth()->user()->following->contains($post->user->id): false }}">
                                                </follow>
                                            @endif
                                        @endauth
                                    </div>
                                    @auth
                                        @if (Auth::user()->username == $username)
                                            <div>
                                                <form action="{{ route('p.destroy', $post) }}" method="POST"
                                                    class="text-danger">
                                                    @csrf
                                                    @method('delete')
                                                    <input class="btn btn-default p-0 mb-0 h6" type="submit"
                                                        value="Delete Post" />
                                                </form>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                            <div class="h-25 ml-2 text-muted" style="font-size: 14px">
                                {{ \App\Providers\ContentAgeProvider::calAge($post) }}</div>
                        </div>
                    </div>
                    <hr>


                    <p style="overflow: hidden" class="pb-0 mb-0"><span><a class="text-black font-weight-bold"
                                href="{{ route('page.show', $post->user->username) }}" style="text-decoration: none;">
                                <span class="font-weight-bold h5 p-1">{{ $post->user->name }}</span>
                            </a> </span>{{ $post->caption }}</p>
                </div>
                <div class="d-flex justify-content-left pt-1">
                    <like post-id="{{ $post->id }}" likecount="{{ $post->likers->count() }}"
                        likes="{{ auth()->user() ? $post->likers->contains(auth()->user()->id) : false }}"></like>
                    <button class="bg-white rounded-5 shadow d-flex text-primary ml-1 p-1 px-2 mr-2"
                        onclick="share('{{ url('p', $post->id) }}', {{ $post->id }})">@include('share-icon')
                        <p class="p-0 m-0" id="share-btn-text{{ $post->id }}" style="font-size: 12px">share</p>
                    </button>
                </div>
            </div>

        </div>

        <div class="row w-75 mx-auto">
            @include('comments.post-comments', [
                'imgwidth' => 50,
                'overflow' => false,
            ])
        </div>
    </div>


    <script src="{{ asset('js/posts/index.js') }}"></script>
</x-app-layout>
