{{-- Logo & Mobile Navigation --}}
<div class="flex items-center justify-between px-6 py-4 bg-gray-900 md:flex-shrink-0 md:w-56 md:justify-center">
    <a class="mt-1" href="/">
        <x-logo class="text-white fill-current" width="120" height="35"></x-logo>
    </a>
    <div x-data="{ mobileOpen: false }" class="relative md:hidden">
        <svg x-on:click="mobileOpen = true" class="w-6 h-6 text-white cursor-pointer fill-current"
            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
        </svg>
        <div x-show="mobileOpen" class="absolute right-0 z-20">
            <x-main-menu class="relative z-20 px-8 py-4 pb-2 mt-2 bg-gray-800 rounded shadow-lg"></x-main-menu>
            <div class="fixed inset-0 z-10 bg-black opacity-25" x-on:click="mobileOpen = false">
            </div>
        </div>
    </div>
</div>

{{-- Top Desktop Panel --}}
<div class="flex items-center justify-between w-full p-4 text-sm bg-white border-b md:py-0 md:px-12 d:text-md">
    <div class="mt-1 mr-4">{{ config('app.name') }}</div>
    <x-dropdown>
        <x-slot name="trigger" class="flex items-center cursor-pointer select-none group">
            <div class="mr-1 text-gray-800 whitespace-nowrap group-hover:text-gray-600 focus:text-gray-600">
                <span class="cursor-pointer">
                    {{ auth()->user()->name }}
                </span>
            </div>
            <i class="w-5 h-5 text-gray-800 fill-current group-hover:text-gray-600 focus:text-gray-600"></i>
        </x-slot>
        <x-slot name="content">
            <div>
                <x-dropdown-link href="#">
                    My Profile
                </x-dropdown-link>
                <x-dropdown-link href="#">
                    Manage Users
                </x-dropdown-link>
                <form class="w-full" action="{{ route('login') }}" method="POST">
                    @csrf
                    <button
                        class="block w-full text-left px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition"
                        type="submit">Logout
                    </button>
                </form>
            </div>
        </x-slot>
    </x-dropdown>
</div>
