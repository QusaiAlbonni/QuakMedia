<form action="{{ route('comment.create', $post->id) }}" method="POST">
    @csrf
    <input type="text" name="comment_text" class="rounded-1 shadow mx-2 mt-0 w-100 h-50"
        style="border: none">

    <div class="d-flex justify-content-left">
        <button type="submit" class="btn btn-danger btn-sm mx-2 h-50 mt-2">Submit</button>
        <x-input-error :messages="$errors->get('comment_text')" class="mt-2" />
    </div>

</form>
<div class="bg-warning shadow rounded-4">
    you have posted a comment pls refresh page to see it!
</div>
