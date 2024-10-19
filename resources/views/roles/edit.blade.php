@inject('permModel','Spatie\Permission\Models\Permission' )

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Roles Page') }}
        </h2>
    </x-slot>

    <x-content-wrapper>
        <x-slot name='body'>
            <form action="{{route('roles.update',$record->id)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3 flex flex-col ">
                   <x-input-label for="name" :value="__('Name')" />
                   <x-text-input id="name" class="block mt-1 mb-2 w-full" type="text" name="name" :value="old('name',$record)"  autofocus />
                   @error('name')
                     <x-input-error :messages="$message" />
                   @enderror  
            
                   {{-- multi select with check boxes  --}}
                    <div class="form-group">
                        <x-input-label for='permissions_list' :value="__('Permissions')"/>
                        
                        <div class="row">
                            @foreach ($permModel->all() as $permission )
                                <div class="col-sm-3">
                                     <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="permissions_list[]" value="{{$permission->id}}"
                                            @if($record->hasPermissionTo($permission->name)) checked @endif
                                            >
                                            {{$permission->display_name}}
                                        </label>

                                     </div>
                                </div>
                            @endforeach

                            @error('permissions_list')
                            <x-input-error :messages="$message" />
                          @enderror 
                        </div>
                    </div>



                </div>
                <button type="submit" class="btn btn-primary mb-2">Submit</button>
            </form>
            
        </x-slot>
    </x-content-wrapper>
</x-app-layout>