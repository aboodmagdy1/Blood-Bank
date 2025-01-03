@inject('category', 'App\Models\Category')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Post Page') }}
        </h2>
    </x-slot>


    <x-content-wrapper>
        <x-slot name='body'>
            <form action="{{ route('post.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <x-input-label for="title" :value="__('AR Title')" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title[ar]"
                        :value="old('title.ar')" autofocus />
                    @error('title.ar')
                        <x-input-error :messages="$message" />
                    @enderror
                    <x-input-label for="title" :value="__('EN Title')" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title[en]"
                        :value="old('title.en')" autofocus />
                    @error('title.en')
                        <x-input-error :messages="$message" />
                    @enderror

                    <x-input-label for="content" :value="__('AR Content')" />
                    <x-text-input id="content" class="block mt-1 w-full" type="text" name="content[ar]"
                        :value="old('content.ar')" autofocus />
                    @error('content.ar')
                        <x-input-error :messages="$message" />
                    @enderror
                    <x-input-label for="content" :value="__('EN Content')" />
                    <x-text-input id="content" class="block mt-1 w-full" type="text" name="content[en]"
                        :value="old('content.en')" autofocus />
                    @error('content.en')
                        <x-input-error :messages="$message" />
                    @enderror
                    <x-input-label for='category_id' :value="__('Category')" />
                    <select name="category_id" id="category_id" class="block mt-1 w-full">
                        @foreach ($category->all() as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach

                    </select>
                    @error('category_id')
                        <x-input-error :messages="$message" />
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </x-slot>
    </x-content-wrapper>
</x-app-layout>
