@inject('governorate','App\Models\Governorate' )
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create City Page') }}
        </h2>
    </x-slot>


    <x-content-wrapper>
        

        <x-slot name='body'>
            <form action="{{route('city.store')}}" method="POST">
                @csrf
                <div class="mb-3">
                   <x-input-label for="name" :value="__('Name')" />
                   <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"  autofocus />
                   @error('name')
                     <x-input-error :messages="$message" />
                   @enderror
                    <x-input-label for='governorate_id' :value="__('Governorate')" />
                    <select name="governorate_id" id="governorate_id" class="block mt-1 w-full">
                        @foreach($governorate->all() as $governorate)
                            <option value="{{$governorate->id}}">{{$governorate->name}}</option>
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