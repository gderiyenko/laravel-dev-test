<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- Load template based on user's role --}}
    @include('dash.' . auth()->user()->role)
</x-app-layout>

@include('notifications.dashboard-welcome')
@include('notifications.dashboard-successful-payment')
@include('notifications.dashboard-failed-payment')