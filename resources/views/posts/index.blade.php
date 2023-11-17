<x-app-layout>
    @include('layouts.navigation');
    <div id="app">
        @foreach ($posts as $post)
            <div class="container w-100 pb-0">
                <div class="row pb-0 rounded-4 mt-4 w-75 mx-auto"
                    style="background: radial-gradient(circle at 10% 20%, rgb(254, 255, 165) 0%, rgb(255, 232, 182) 90%);">
                    <div class="row w-100 pl-0 ml-0 mb-5">
                        <div class="col-6 pt-0 mt-0 pl-0 pr-0"><a href="/p/{{ $post->id }}"><img
                                    src="/storage/{{ $post->image }}" class="w-100 mx-auto" style="border-top-left-radius: 3%" oncontextmenu="return false" /></a>
                        </div>
                        <div class="col-6">
                            <div>
                                <div class="d-flex align-items-center">
                                    <div class="p-3">
                                        <a href="{{ route('page.show', $post->user->username) }}"><img
                                                src="/storage/{{ $post->user->profile->image }}"
                                                class="w-20 rounded-circle" oncontextmenu="return false"/></a>
                                    </div>
                                    <div>
                                        <div class="d-flex mb-0">
                                            <a class="text-black font-weight-bold p-2 pb-0"
                                                href="{{ route('page.show', $post->user->username) }}"
                                                style="text-decoration: none;">
                                                <span class="h5">{{ $post->user->name }}</span>
                                            </a>
                                            <span class="h3 mb-0">·</span>
                                            <div class="pt-2 mb-0 pb-0">
                                                <follow user-id="{{ $post->user->id }}"
                                                    follows="{{ auth()->user()? auth()->user()->following->contains($post->user->id): false }}"
                                                    class="a">
                                                </follow>
                                            </div>
                                        </div>
                                        <div class="h-25 ml-2 text-muted" style="font-size: 14px">
                                            {{ \App\Providers\ContentAgeProvider::calAge($post) }}</div>
                                    </div>
                                </div>
                                @include('comments.post-comments', [
                                    'imgwidth' => 100,
                                    'overflow' => true,
                                ])

                            </div>

                        </div>

                        <div class="row pt-3">

                            <p><span><a class="text-black font-weight-bold"
                                        href="{{ route('page.show', $post->user->username) }}"
                                        style="text-decoration: none;">
                                        <span class="font-weight-bold h5 p-1">{{ $post->user->name }}</span>
                                    </a> </span>{{ $post->caption }}</p>
                        </div>
                        <div class="d-flex justify-content-left pt-1">
                            <like post-id="{{ $post->id }}" likecount="{{ $post->likers->count() }}"
                                likes="{{ auth()->user() ? $post->likers->contains(auth()->user()->id) : false }}">
                            </like>
                            <button class="bg-white rounded-5 shadow d-flex text-primary ml-0 p-1 px-2 mr-2"
                                onclick="share('{{ url('p', $post->id) }}', {{ $post->id }})">@include('share-icon')
                                <p class="p-0 m-0" id="share-btn-text{{ $post->id }}" style="font-size: 12px">
                                    share
                                </p>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
        <div class="row p-5">
            <div class="col-12 d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>
        @if ($posts->count() == 0)
            <div class="row p-5">
                <div class="col-12 d-flex justify-content-center text-center text-muted h5">
                    <h3>Oops! nothing to see here <br> follow Users to see their latest posts!</h3>
                </div>
            </div>
        @endif
    </div>
    <script src="{{ asset('js/posts/index.js') }}"></script>
</x-app-layout>
