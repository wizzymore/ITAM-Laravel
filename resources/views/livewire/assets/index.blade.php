<?php

function getStatusClasses($asset): string
{
    if ($asset->status === 'active') {
        return 'bg-green-100 text-green-800';
    } elseif ($asset->status === 'inactive') {
        return 'bg-red-100 text-red-800';
    }

    return 'bg-yellow-100 text-yellow-800';
}

?>

<div>
    <div class="relative h-full">
        <div class="flex justify-between w-full mb-4 align-middle">
            <input wire:model.debounce.500ms='search' size="large" placeholder="Search Assets"
                   class="px-4 py-2 border border-gray-800 rounded focus:ring-1 focus:ring-gray-500 focus:outline-none"/>
            <a href="#">
                <button type="submit" class="px-4 py-2 bg-white border border-gray-900 rounded-md hover:bg-gray-100">
                    Create Asset
                </button>
            </a>
        </div>
        <div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Serial
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Product
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Employee
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">
                                        Status
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                @if ($data->count())
                                    @foreach ($data as $asset)
                                        <tr>
                                            <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                {{ $asset->asset_type->label . $asset->serial }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    {{ $asset->product->model }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $asset->product->productMaker->name }}
                                                    {{ $asset->product->productType->name }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 w-10 h-10">
                                                        <img class="w-10 h-10 rounded-full"
                                                             src="https://eu.ui-avatars.com/api/?name={{ $asset->employee->getName() }}"
                                                             alt="">
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $asset->employee->getName() }}
                                                        </div>
                                                        <div class="text-sm text-gray-500">
                                                            {{ $asset->employee->email }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ getStatusClasses($asset) }}">
                                                        {{ ucwords($asset->status, '-') }}
                                                    </span>
                                            </td>
                                            <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                                <a href="{{ route('asset.edit', $asset->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5"
                                            class="px-6 py-4 text-sm font-medium whitespace-nowrap text-center">
                                            No assets found...
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                            @if($data->hasPages())
                                <div class="p-4 bg-gray-50 border-t-2">
                                    {{ $data->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
