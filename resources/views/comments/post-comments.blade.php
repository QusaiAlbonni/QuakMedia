<div class="mt-2" style="
    @if ($post->comments->count() !== 0 && $overflow) overflow-y: auto; overflow-x:hidden; @endif">

    <div class="d-flex justify-content-between">
        <div class="pl-2 h6"> Comments </div>
        <h6 class="pt-0 px-3 text-danger text-bald">{{ $post->comments->count() }}
            comments</h6>
    </div>
    <div class="my-3">
        <h6 class="p-2 pb-0">Leave a Comment: </h6>
        <commentform post-id="{{ $post->id }}"></commentform>
    </div>
    @if ($post->comments->count() !== 0)
        <div @if ($overflow) style="max-height:250px" @endif>
            <div>
                <!-- COMMENTS -->

                @foreach ($post->comments as $comment)
                    <commentedit oct="{{ $comment->comment_text }}" img="{{ auth()->user()->profile->image }}"
                        id="commentEdit{{ $comment->id }}" cid="{{ $comment->id }}" comrep="comment"
                        v-show="editsEnabled[{{ $comment->id }}]">
                    </commentedit>
                    <div id="comment{{ $comment->id }}">

                        <div class="row bg-white rounded-2 p-2 shadow m-2 ">
                            <div class="col-2 px-0">
                                <a href="/page/{{ $comment->user->username }}"><img
                                        src="/storage/{{ $comment->user->profile->image }}"
                                        class="w-{{ $imgwidth }} rounded-circle"></a>
                            </div>
                            <div class="col-10 px-2">
                                <div class="d-flex justify-content-between w-100">
                                    <div class="d-flex justify-content-left">
                                        <a href="/page/{{ $comment->user->username }}" style="text-decoration: none">
                                            <div class="h6 text-danger">
                                                {{ $comment->user->name }}
                                            </div>
                                        </a>
                                        <div class="h-25 ml-2 text-muted " style="font-size: 13px">
                                            {{ \App\Providers\ContentAgeProvider::calAge($comment) }}</div>
                                    </div>
                                    @auth
                                        @if (Auth::user()->id === $comment->user_id)
                                            <commentdropdown cid="{{ $comment->id }}" comrep="comment"></commentdropdown>
                                        @endif
                                    @endauth
                                </div>
                                <p style="overflow: hidden" id="commenttext{{ $comment->id }}">
                                    {{ $comment->comment_text }}
                                </p>
                                <div class="d-flex justify-content-between" style="font-size: 13px">
                                    <div class="d-flex justify-content-left mt-2">
                                        <commentlike comment-id="{{ $comment->id }}"
                                            likecount="{{ $comment->likers->count() }}"
                                            likes="{{ auth()->user() ? $comment->likers->contains(auth()->user()->id) : false }}">
                                        </commentlike>
                                        @auth<button class="mr-2 text-danger" id="reply-btn{{ $comment->id }}"
                                            onclick="reply({{ $comment->id }})">reply</button>@endauth
                                    </div>
                                    <div>
                                        @if ($comment->replies->count() !== 0)
                                            <button class="mr-2 text-muted" onclick="showReplies({{ $comment->id }})"
                                                id="show-replies-btn{{ $comment->id }}">show
                                                replies</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @auth
                            <div id="addreply{{ $comment->id }}" style="display: none">
                                <replyform comment-id="{{ $comment->id }}" img="{{ auth()->user()->profile->image }}">
                                </replyform>
                            </div>
                        @endauth
                        <!-- REPLIES -->
                        <div id="replies{{ $comment->id }}" style="display: none">
                            @foreach ($comment->replies as $reply)
                                <div class="d-flex justify-content-end">
                                    <commentedit class="w-75 align-items-right" oct="{{ $reply->reply_text }}"
                                        img="{{ auth()->user()->profile->image }}" id="replyEdit{{ $reply->id }}"
                                        cid="{{ $reply->id }}" comrep="reply"
                                        v-show="replyEditsEnabled[{{ $reply->id }}]">
                                    </commentedit>
                                </div>
                                <div id="reply{{ $reply->id }}">
                                    <div class="d-flex">
                                        <div class="w-25"></div>
                                        <div class="row rounded-2 p-2 shadow m-2 w-75"
                                            style="background: rgb(211, 240, 253)">
                                            <div class="col-2 px-0">
                                                <a href="/page/{{ $reply->user->username }}"><img
                                                        src="/storage/{{ $reply->user->profile->image }}"
                                                        class="w-75 ml-1 rounded-circle"></a>
                                            </div>
                                            <div class="col-10 px-2">
                                                <div class="d-flex justify-content-between">
                                                    <div class="d-flex justify-content-left">
                                                        <a href="/page/{{ $reply->user->username }}"
                                                            style="text-decoration: none">
                                                            <div class="h6 text-danger">
                                                                {{ $reply->user->name }}
                                                            </div>
                                                        </a>
                                                        <div class="h-25 ml-2 text-muted " style="font-size: 13px">
                                                            {{ \App\Providers\ContentAgeProvider::calAge($reply) }}
                                                        </div>
                                                    </div>
                                                    @auth
                                                        @if (Auth::user()->id === $reply->user_id)
                                                            <commentdropdown cid="{{ $reply->id }}" comrep="reply">
                                                            </commentdropdown>
                                                        @endif
                                                    @endauth
                                                </div>
                                                <p style="overflow: hidden" id="replytext{{$reply->id}}">
                                                    {{ $reply->reply_text }}
                                                </p>
                                                <div class="d-flex justify-content-between" style="font-size: 13px">
                                                    <div class="d-flex justify-content-left">
                                                        <replylike reply-id="{{ $reply->id }}"
                                                            likecount="{{ $reply->likers->count() }}"
                                                            likes="{{ auth()->user() ? $reply->likers->contains(auth()->user()->id) : false }}">
                                                        </replylike>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    @endif
</div>
