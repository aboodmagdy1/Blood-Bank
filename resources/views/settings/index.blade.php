<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Setting Page') }}
        </h2>
    </x-slot>

   
        <x-content-wrapper>
            <x-slot name='actions'>
                <a href="{{route('setting.edit',$record->id)}}" class="btn btn-primary">Edit Setting</a>

            </x-slot>
           <x-slot name='body'>
            <x-table>
                <x-slot name='thead'>
                    <tr>
                      
                        <th>notification_setting_text</th>
                        <th>about_app</th>
                        <th>phone </th>
                        <th>email </th>
                        <th>fb_link </th>
                        <th>tw_link </th>
                        <th>insta_link </th>
                        <th>youtube_link </th>
                        <th>watts_link </th>

                    </tr>
                </x-slot>
                <x-slot name='tbody'>
                    <tr>
                        <td>{{$record->notification_setting_text}}</td>
                        <td>{{$record->about_app}}</td>
                        <td>{{$record->phone}}</td>
                        <td>{{$record->email}}</td>
                        <td>{{$record->fb_link}}</td>
                        <td>{{$record->tw_link}}</td>
                        <td>{{$record->insta_link}}</td>
                        <td>{{$record->youtube_link}}</td>
                        <td>{{$record->watts_link}}</td>
                        <td>
                            {{-- <a href="{{route('setting.edit',$setting->id)}}" class="btn btn-primary">Edit</a> --}}
                        </td>
                    </tr>

                </x-slot>
            </x-table>
           </x-slot>
        </x-content-wrapper>
 
</x-app-layout>
