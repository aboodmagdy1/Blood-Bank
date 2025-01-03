@inject('category', 'App\Models\Category')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts Page') }}
        </h2>
    </x-slot>




    <x-content-wrapper>
        <x-slot name='actions'>
            <a href="{{ route('post.create') }}" class="btn btn-primary">Add Post</a>
        </x-slot>

        <x-slot name='body'>

            @if (count($records))
                <x-table>
                    <x-slot name='thead'>
                        <tr>
                            <th>#</th>
                            <th>@lang('AR Title')</th>
                            <th>@lang('EN Title')</th>
                            <th>@lang('AR Content')</th>
                            <th>@lang('EN Content')</th>
                            <th>Category </th>
                            <th>Actions </th>
                        </tr>
                    </x-slot>
                    <x-slot name='tbody'>
                        @foreach ($records as $record)
                            dd($record);
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <th>{{ $record->getTranslation('title', 'ar') }}</th>
                                <th>{{ $record->getTranslation('title', 'en') }}</th>
                                <th>{{ $record->getTranslation('content', 'ar') }}</th>
                                <th>{{ $record->getTranslation('content', 'en') }}</th>
                                <th>{{ $category->find($record->category_id)->name }}</th>
                                <th>
                                    <a href="{{ route('post.edit', $record->id) }}" class="btn btn-info">Edit</a>
                                    <form action="{{ route('post.destroy', $record->id) }}" method="POST"
                                        style="display:inline-block">
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
