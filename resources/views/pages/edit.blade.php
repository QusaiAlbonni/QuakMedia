<x-app-layout>
    @include('layouts.navigation', ['username' => $user->username])
    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 shadow sm:rounded-lg" style="background: linear-gradient(-20deg, #e9defa 0%, #fbfcdb 100%);">
                <div class="max-w-xl">
                    <div class="container">
                        <h1><strong>Update profile information</strong></h1>
                        <form method="post" action="{{ route('page.update', $user) }}" class="mt-6 space-y-6"
                            enctype="multipart/form-data">
                            @csrf
                            @method('patch')

                            <div>
                                <x-input-label for="title" :value="__('title')" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                    :value="old('title', $user->profile->title ?? '')" required autofocus autocomplete="title" />
                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                            </div>

                            <div>
                                <x-input-label for="description" :value="__('description')" />
                                <x-text-input id="description" name="description" type="text"
                                    class="mt-1 block w-full" :value="old('description', $user->profile->description ?? '')" required autofocus
                                    autocomplete="description" />
                                <x-input-error class="mt-2" :messages="$errors->get('description')" />
                            </div>
                            <div>
                                <x-input-label for="url" :value="__('url')" />
                                <x-text-input id="url" name="url" type="text" class="mt-1 block w-full"
                                    :value="old('url', $user->profile->url ?? '')" required autofocus autocomplete="url" />
                                <x-input-error class="mt-2" :messages="$errors->get('url')" />
                            </div>
                            <div>
                                <x-input-label for="image" :value="__('Profile Image')" class="align-left" />
                                <input type="file" class="form-control-file btn btn-outline-danger text-black"
                                     id="image" name="image" accept="image/*">
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>
                            <div class="flex items-center gap-4">
                                <x-primary-button class="bg-warning">{{ __('Save Changes') }}</x-primary-button>

                                @if (session('status') === 'profile-updated')
                                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                                @endif
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
