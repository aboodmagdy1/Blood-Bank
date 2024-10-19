@inject('city','App\Models\City' )
@inject('bloodType','App\Models\BloodType' )
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clients Page') }}
        </h2>
    </x-slot>


    {{-- Main Content  --}}
        <x-content-wrapper>
            <x-slot name='actions'>
                <form action="{{ route('client.index') }}" method="GET">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="city_id" class="form-label">{{ __('City') }}</label>
                            <select name="city_id" id="city_id" class="form-control">
                                <option value="">{{ __('Select City') }}</option>
                                @foreach($city::all() as $cityItem)
                                    <option value="{{ $cityItem->id }}" >
                                        {{ $cityItem->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="blood_type_id" class="form-label">{{ __('Blood Type') }}</label>
                            <select name="blood_type_id" id="blood_type_id" class="form-control">
                                <option value="">{{ __('Select Blood Type') }}</option>
                                @foreach($bloodType::all() as $bloodTypeItem)
                                    <option value="{{ $bloodTypeItem->id }}">
                                        {{ $bloodTypeItem->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mt-4">
                            <button type="submit" class="btn btn-primary">{{ __('Filter') }}</button>
                            <a href="{{ route('client.index') }}" class="btn btn-secondary">{{ __('Reset') }}</a>
                        </div>
                    </div>
                </form>
            </x-slot>

            <x-slot name='body'>
                @if (count($records))
                <x-table>
                    <x-slot name='thead'>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Phone</th>
                        </tr>
                    </x-slot>
                    <x-slot name='tbody'>
                        @foreach ($records as $record )
                        <tr>
                            <th>{{$loop->iteration}}</th>
                            <th>{{$record->name}}</th>
                            <th>{{$record->email}}</th>
                            <th>{{$record->phone}}</th>
                            
                            <th>
                                {{-- toggle active --}}
                                <form action="{{route('client.update',$record->id)}}" method="POST" style="display:inline-block">
                                    @method('PUT')
                                    @csrf
                                    <button type="submit" class="btn btn-{{$record->is_active ? 'danger' : 'success'}}">{{$record->is_active ? 'Deactivate' : 'Activate'}}</button>
                                </form>
    
                                <form action="{{route('client.destroy',$record->id)}}" method="POST" style="display:inline-block">
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
