@inject('city','App\Models\City' )

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cities Page') }}
        </h2>
    </x-slot>

    

        <x-content-wrapper>
            <x-slot name='actions'>
                <a href="{{route('city.create')}}" class="btn btn-primary">Add City</a>
            </x-slot>

            <x-slot name='body'>
                
                @if (count($records))
                <x-table>
                    <x-slot name='thead'>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Governorate</th>
                            <th>Actions</th>
                        </tr>
                    </x-slot>
                    <x-slot name='tbody'>
                        @foreach ($records as $record )
                        <tr>
                            <th>{{$loop->iteration}}</th>
                            <th>{{$record->name}}</th>
                            <th>{{$record->governorate->name}}</th>
                            <th>
                                <a href="{{route('city.edit',$record->id)}}" class="btn btn-info">Edit</a>
                                <form action="{{route('city.destroy',$record->id)}}" method="POST" style="display:inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </th>
                        </tr>
                        @endforeach
                    </x-slot>
                </x-table>
                @else
                <div class="alert alert-info text-center text-bold" role="alert">
                    No Data 
                </div>
                
            @endif

            </x-slot>
        </x-content-wrapper>

   
</x-app-layout>
