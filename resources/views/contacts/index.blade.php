<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contacts Page') }}
        </h2>
    </x-slot>

    <x-content-wrapper>
         
        
        <x-slot name='actions'>
            <form action="{{ route('contact.index') }}" method="GET">
                <div class="row mb-3 flex justify-center">
                    <div class="col-md-4">
                        <x-input-label for="email" class="form-label">{{ __('Email') }}</x-input-label>
                        <input type="email" class="form-control" id="email" name="email">
    
                    </div>
                    <div class="col-md-4 mt-4">
                        <button type="submit" class="btn btn-primary">{{ __('Filter') }}</button>
                        <a href="{{ route('contact.index') }}" class="btn btn-secondary">{{ __('Reset') }}</a>
                    </div>
                </div>
            </form>
        </x-slot>
       
      <x-slot name='body'>
          
          <x-table>
              <x-slot name='thead'>
                  <tr>
                      <th>#</th>
                      <th>name</th>
                      <th>email</th>
                      <th>phone</th>
                      <th>message</th>
                      <th>subject</th>
                      <th>Actions</th>
                  </tr>
              </x-slot>
              <x-slot name='tbody'>
                  @foreach ($records as $record )
                  <tr>
                      <th>{{$loop->iteration}}</th>
                      <th>{{$record->name}}</th>
                      <th>{{$record->email}}</th>
                      <th>{{$record->phone}}</th>
                      <th>{{$record->message}}</th>
                      <th>{{$record->subject}}</th>
                      
                      <th>
                          
                          <form action="{{route('contact.destroy',$record->id)}}" method="POST" style="display:inline-block">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger">Delete</button>
                          </form>
                      </th>
                  </tr>
                  @endforeach
              </x-slot>
          </x-table>
       
      </x-slot>
    </x-content-wrapper>

  
</x-app-layout>
