@inject('permModel','Spatie\Permission\Models\Permission' )
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Permission Page') }}
        </h2>
    </x-slot>


        <x-content-wrapper>
            <x-slot name='body'>
                <form action="{{route('permissions.store')}}" method="POST">
                    @csrf
                    <div class="mb-3 flex flex-col ">
                       <x-input-label for="name" :value="__('Name')" />
                       <x-text-input id="name" class="block mt-1 mb-2 w-full" type="text" name="name" :value="old('name')"  autofocus />
                       @error('name')
                         <x-input-error :messages="$message" />
                       @enderror  
                
                       
                    </div>
                    <div class="mb-3 flex flex-col ">
                        <x-input-label for="display_name" :value="__('Display Name')" />
                        <x-text-input id="display_name" class="block mt-1 mb-2 w-full" type="text" name="display_name" :value="old('display_name')"  autofocus />
                        @error('display_name')
                          <x-input-error :messages="$message" />
                        @enderror    
                     </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </x-slot>
        </x-content-wrapper>
            
</x-app-layout>