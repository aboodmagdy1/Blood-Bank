@inject('client','App\Models\Client' )
@inject('request','App\Models\DonationRequest' )

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Statistics Page') }}
        </h2>
    </x-slot>

    <x-content-wrapper>
        <x-slot name='body'>
            <x-card
            :count="$client->count()"
            title='Clients'
            icon='ion ion-person-add'
            :href="route('client.index')"/>


            <x-card
            :count="$request->count()"
            title='Donation Requests'
            icon='ion ion-stats-bars'
            color='danger'
            :href="route('donation-request.index')"
            />

            
        </x-slot>
    </x-content-wrapper>
</x-app-layout>
