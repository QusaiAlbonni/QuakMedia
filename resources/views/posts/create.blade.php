<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<link href="{{ asset('css/submit.css') }}" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>

<x-app-layout>
    @include('layouts.navigation');
    <div class="container mh-100 rounded-3 p-5 mt-5" style="background:#e2df40">
        <form action="/p" enctype="multipart/form-data" method="post" class="form-prevent-multiple-submits">
            @csrf
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="row p-4 ">
                        <h1 class="display-5">New Post</h1>
                    </div>
                    <div>
                        <x-input-label for="caption" :value="__('Post Caption')" />
                        <x-text-input id="caption" class="block mt-1 w-50" type="text" name="caption" caption="caption"
                            :value="old('caption')" required autofocus autocomplete="caption" />
                        <x-input-error :messages="$errors->get('caption')" class="mt-2" />
                    </div>
                    <br>

                    <div class="row pl-3">
                        <x-input-label for="image" :value="__('Post Image')" class="align-left" />
                        <input type="file" class="form-control-file btn btn-outline-danger text-white w-100 h-100"
                        required autofocus autocomplete="caption" id="image" name="image">
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>
                    <div class="row pt-4 pl-3 pb-5">
                        <button type="submit" class="btn btn-outline-danger button-prevent-multiple-submits">Add a new post </button>
                    </div>
                </div>
            </div>

        </form>
    </div>
    <script src="{{asset('js/submit.js')}}"></script>
</x-app-layout>
