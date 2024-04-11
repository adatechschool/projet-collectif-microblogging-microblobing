<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('posts.store') }}">
            @csrf

            <textarea
                name="title"
                placeholder="{{ __('Titre') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('title') }}</textarea>
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                
            <textarea
                name="picture"
                placeholder="{{ __('Image') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('picture') }}</textarea>
            <x-input-error :messages="$errors->get('picture')" class="mt-2" />

            <textarea
                name="content"
                placeholder="{{ __('What\'s on your mind ?') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('content') }}</textarea>
            <x-input-error :messages="$errors->get('content')" class="mt-2" />

            <textarea
            name="tag"
                placeholder="{{ __('Tag') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('tag') }}</textarea>   
            <x-input-error :messages="$errors->get('tag')" class="mt-2" />       

            <x-primary-button class="mt-4">{{ __('Post') }}</x-primary-button>
        </form>
    </div>
</x-app-layout>