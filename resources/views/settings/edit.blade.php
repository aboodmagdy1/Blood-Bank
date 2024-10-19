@inject('category','App\Models\Category' )
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Setting Page') }}
        </h2>
    </x-slot>


    <x-content-wrapper>
       <x-slot name='body'>
        <form action="{{route('setting.update',$record->id)}}" method="POST">
          @csrf
          @method('PUT')
          <div class="mb-3">
              {{-- update setting record --}}
              <x-input-label for="notification_setting_text" :value="__('notification_setting_text')" />
              <x-text-input id="notification_setting_text" class="block mt-1 w-full" type="text" name="notification_setting_text" :value="$record->notification_setting_text"  autofocus />
              @error('notification_setting_text')
                <x-input-error :messages="$message" />
              @enderror
              <x-input-label for="about_app" :value="__('about_app')" />
              <x-text-input id="about_app" class="block mt-1 w-full" type="text" name="about_app" :value="$record->about_app"  autofocus />
              @error('about_app')
                <x-input-error :messages="$message" />    
              @enderror
              <x-input-label for="phone" :value="__('phone')" />
              <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="$record->phone"  autofocus />
              @error('phone')
                <x-input-error :messages="$message" />
              @enderror
              <x-input-label for="email" :value="__('email')" />
              <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :value="$record->email"  autofocus />
              @error('email')
                <x-input-error :messages="$message" />
              @enderror
              <x-input-label for="fb_link" :value="__('fb_link')" />
              <x-text-input id="fb_link" class="block mt-1 w-full" type="text" name="fb_link" :value="$record->fb_link"  autofocus />
              @error('fb_link')
                <x-input-error :messages="$message" />
              @enderror
              <x-input-label for="tw_link" :value="__('tw_link')" />
              <x-text-input id="tw_link" class="block mt-1 w-full" type="text" name="tw_link" :value="$record->tw_link"  autofocus />
              @error('tw_link')
                <x-input-error :messages="$message" />
              @enderror
              <x-input-label for="insta_link" :value="__('insta_link')" />
              <x-text-input id="insta_link" class="block mt-1 w-full" type="text" name="insta_link" :value="$record->insta_link"  autofocus />
              @error('insta_link')
                <x-input-error :messages="$message" />
              @enderror
              <x-input-label for="youtube_link" :value="__('youtube_link')" />
              <x-text-input id="youtube_link" class="block mt-1 w-full" type="text" name="youtube_link" :value="$record->youtube_link"  autofocus />
              @error('youtube_link')
                <x-input-error :messages="$message" />
              @enderror
              <x-input-label for="watts_link" :value="__('watts_link')" />
              <x-text-input id="watts_link" class="block mt-1 w-full" type="text" name="watts_link" :value="$record->watts_link"  autofocus />
              @error('watts_link')
                <x-input-error :messages="$message" />
              @enderror


          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
      </form>
       </x-slot>
    </x-content-wrapper>
</x-app-layout>