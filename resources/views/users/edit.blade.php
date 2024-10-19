@inject('roleModel','Spatie\Permission\Models\Role' )
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User Page') }}
        </h2>
    </x-slot>


        <x-content-wrapper>
            <x-slot name='body'>
                <form action="{{route('users.update',$record->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3 flex flex-col ">
                       <x-input-label for="name" :value="__('Name')" />
                       <x-text-input id="name" class="block mt-1 mb-2 w-full" type="text" name="name" :value="old('name',$record)"  autofocus />
                       @error('name')
                         <x-input-error :messages="$message" />
                       @enderror  


                       <x-input-label for="email" :value="__('Email')" />
                       <x-text-input id="email" class="block mt-1 mb-2 w-full" type="email" name="email" :value="old('email',$record)"  autofocus />
                       @error('email')
                         <x-input-error :messages="$message" />
                       @enderror  


                       <x-input-label for="password" :value="__('Password')" />
                       <x-text-input id="password" class="block mt-1 mb-2 w-full" type="password" name="password" :value="old('password',$record)"  autofocus />
                       @error('password')
                         <x-input-error :messages="$message" />
                       @enderror  


                       <x-input-label for="passConfirm" :value="__('Password Confirmation')" />
                       <x-text-input id="passConfirm" class="block mt-1 mb-2 w-full" type="password" name="password_confirmation" :value="old('password',$record)"  autofocus />
                
                       {{-- multi select with check boxes  --}}
                        <div class="form-group">
                            <x-input-label for='roles_list' :value="__('Roles')"/>
                            <div class="row">
                                @foreach ($roleModel->all() as $role )
                                    <div class="col-sm-3">
                                         <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="roles_list[]" value="{{$role->id}}"
                                                @if($record->hasRole($role->name)) checked @endif
                                                >
                                                {{$role->name}}
                                            </label>

                                         </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('roles_list')
                                <x-input-error :messages="$message" />
                                
                            @enderror
                        </div>



                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </x-slot>
        </x-content-wrapper>
            
</x-app-layout>