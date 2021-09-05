@section('title', 'Dashboard')

<x-app-layout>
    <div class="px-4 md:px-10 mx-auto w-full">
        <div class="flex flex-wrap">
            <x-card icon="fal fa-inventory" icon-color="indigo" title="Assets" :subtitle="$assets">
            </x-card>
            <x-card icon="fal fa-desktop" icon-color="red" title="Products" :subtitle="$products">
            </x-card>
            <x-card icon="fal fa-users" icon-color="green" title="Employees" :subtitle="$employees">
            </x-card>
            <x-card icon="fal fa-user-tie" icon-color="yellow" title="IT Accounts" :subtitle="$staff"></x-card>
        </div>
    </div>
</x-app-layout>
