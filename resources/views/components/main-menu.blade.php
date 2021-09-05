<div class="{{ $class }}">
    <div class="mb-2 mt-2">
        <a href="{{ route('home') }}" class="flex items-center py-1 group">
            <i class="fas fa-tachometer text-gray-400 group-hover:text-white fill-current mr-2"></i>
            <div class="text-gray-400 group-hover:text-white">Dashboard</div>
        </a>
    </div>
    <div class="mb-2">
        <x-dropdown width="w-36" align="top">
            <x-slot name="trigger">
                <span href="#" class="flex items-center py-1 group cursor-pointer select-none">
                    <i class="fas fa-inventory group-hover:text-white fill-current mr-2"
                        x-bind:class="{ 'text-white': open, 'text-gray-400': !open }"></i>
                    <span class="group-hover:text-white"
                        x-bind:class="{ 'text-white': open, 'text-gray-400': !open }">Assets</span>
                </span>
            </x-slot>
            <x-slot name="content">
                <x-dropdown-link href="{{ route('assets') }}">
                    Show Assets
                </x-dropdown-link>
                <x-dropdown-link href="#">
                    Create Asset
                </x-dropdown-link>
                <x-dropdown-link href="#">
                    Import Assets
                </x-dropdown-link>
            </x-slot>
        </x-dropdown>
    </div>
    <div class="mb-2">
        <x-dropdown width="w-36" align="top">
            <x-slot name="trigger">
                <span href="#" class="flex items-center py-1 group cursor-pointer select-none">
                    <i class="fas fa-desktop group-hover:text-white fill-current mr-2"
                        x-bind:class="{ 'text-white': open, 'text-gray-400': !open }"></i>
                    <span class="group-hover:text-white" x-bind:class="{ 'text-white': open, 'text-gray-400': !open }">
                        Products
                    </span>
                </span>
            </x-slot>
            <x-slot name="content">
                <x-dropdown-link href="#">
                    Show Products
                </x-dropdown-link>
                <x-dropdown-link href="#">
                    Create Product
                </x-dropdown-link>
            </x-slot>
        </x-dropdown>
    </div>
</div>
