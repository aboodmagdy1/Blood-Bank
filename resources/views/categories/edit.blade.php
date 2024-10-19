@inject('category','App\Models\Category' )
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Category Page') }}
        </h2>
    </x-slot>

    <x-content-wrapper>
        <x-slot name='body'>
            <form action="{{ route('category.update', $record->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <!-- Name input -->
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $record->name)" autofocus />
                    @error('name')
                        <x-input-error :messages="$message" />
                    @enderror
            
                
                </div>
            
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            
        </x-slot>
    </x-content-wrapper>
</x-app-layout>