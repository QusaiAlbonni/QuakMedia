<x-app-layout>
    @include('layouts.navigation', ['username' => Auth::user()->username])
    <div class="h1 d-flex mt-4 text-success justify-content-center">
        <p class="rounded-3 p-2 mb-0 pb-0">
            The Land Of The Quak
        </p>
    </div>
    @livewire('duckie', ['animal' => $animal])
</x-app-layout>
