@inject('city','App\Models\City' )
@inject('bloodType','App\Models\BloodType' )
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users Page') }}
        </h2>
    </x-slot>


    {{-- Main Content  --}}
        <x-content-wrapper>
            <x-slot name='actions'>
                <a href="{{route('users.create')}}" class="btn btn-primary">Add User</a>
            </x-slot>

            <x-slot name='body'>
                <x-table>
                    <x-slot name='thead'>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </x-slot>
                    <x-slot name='tbody'>
                        @foreach ($records as $record )
                        <tr>
                            <th>{{$loop->iteration}}</th>
                            <th>{{$record->name}}</th>
                            <th>{{$record->email}}</th>
                            
                            <th>
                                {{-- toggle active --}}
                                @role('admin')
                                <form action="{{route('users.update',$record->id)}}" method="POST" style="display:inline-block">
                                    @method('PUT')
                                    @csrf
                                    <button type="submit" class="btn btn-{{$record->is_active ? 'danger' : 'success'}}">{{$record->is_active ? 'Deactivate' : 'Activate'}}</button>
                                </form>

                                <form action="{{route('users.destroy',$record->id)}}" method="POST" style="display:inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                @endrole

                                <form action="{{route('users.show',$record->id)}}" method="Get" style="display:inline-block">
                                    @csrf
                                    <button type="submit" class="btn btn-info">Show</button>
                                </form>
    
                             
                            </th>
                        </tr>
                        @endforeach
                    </x-slot>
                </x-table>
            </x-slot>
          
        </x-content-wrapper>
    
</x-app-layout>
