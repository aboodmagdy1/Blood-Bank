<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Governorate Page') }}
        </h2>
    </x-slot>


    <x-content-wrapper>
        <x-slot name='body'>
            <form action="{{route('governorate.update',$record->id)}}" method="POST">
                @method('put')
                @csrf
                <div class="mb-3">
                   <x-input-label for="name" :value="__('Name')" />
                   <x-text-input id="name"  class="block mt-1 w-full" type="text" name="name" :value="old('name',$record)"  autofocus />
                   @error('name')
                     <x-input-error :messages="$message" />
                   @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </x-slot>
    </x-content-wrapper>
    
</x-app-layout>