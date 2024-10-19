@inject('category','App\Models\Category' )
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Post Page') }}
        </h2>
    </x-slot>


    <x-content-wrapper>
        <x-slot name='body'>
            <form action="{{route('post.update',$record->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                   <x-input-label for="title" :value="__('Title')" />
                   <x-text-input id="title" class="block mt-1 w-full"  type="text" name="title" :value="old('title',$record)"  autofocus />
                   @error('title')
                     <x-input-error :messages="$message" />
                   @enderror

                   <x-input-label for="content" :value="__('Content')" />
                   <x-text-input id="content" class="block mt-1 w-full"  type="text" name="content" :value="old('content',$record)"  autofocus />
                   @error('content')
                     <x-input-error :messages="$message" />
                   @enderror
                    <x-input-label for='category_id' :value="__('Category')" />
                    <select name="category_id" id="category_id" class="block mt-1 w-full">
                        @foreach($category->all() as $category)
                            <option value="{{$category->id}}"
                                   {{$record->category_id == $category->id ? 'selected' : ''}} 
                                >
                                {{$category->name}}
                                
                            </option>
                        @endforeach

                    </select>
                    @error('governorate_id')
                        <x-input-error :messages="$message" />
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </x-slot>
    </x-content-wrapper>
</x-app-layout>