<div>
    <div class="bg-white shadow overflow-hidden sm:rounded-lg lg:max-w-2xl mx-auto">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Asset Information - {{ $asset->asset_type->label . $asset->getSerial() }}
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                Edit informations about the asset.
            </p>
        </div>
        <div class="border-t border-gray-200">
            <dl>
                <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Serial
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <input class="px-4 py-2.5 bg-white border border-gray-900" wire:model="serial"/>
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Asset Status
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <select wire:model="status">
                            <option value="-1" selected disabled hidden>Choose here</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status }}">{{ ucwords($status, '-') }}</option>
                            @endforeach
                        </select>
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Type
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <select wire:model="asset_type">
                            <option value="-1" selected disabled hidden>Choose here</option>
                            @foreach($assetTypes as $assetType)
                                <option value="{{ $assetType->id }}">{{ $assetType->label }}</option>
                            @endforeach
                        </select>
                    </dd>
                </div>
                <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Employee
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <select wire:model="employee">
                            <option value="-1" selected disabled hidden>Choose here</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->getName() }}</option>
                            @endforeach
                        </select>
                    </dd>
                </div>
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Product Maker
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <select wire:model="productMaker">
                            <option value="-1" selected disabled hidden>Choose here</option>
                            @foreach($productMakers as $productMaker)
                                <option value="{{ $productMaker->id }}">{{ $productMaker->name }}</option>
                            @endforeach
                        </select>
                    </dd>
                </div>
                @if($productTypes && $productTypes->count())
                    <div class=" px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Product Type
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <select wire:model="productType">
                                <option value="-1" selected disabled hidden>Choose here</option>
                                @foreach($productTypes as $productType)
                                    <option value="{{ $productType->id }}">{{ $productType->name }}</option>
                                @endforeach
                            </select>
                        </dd>
                    </div>
                @endif
                @if($products && $products->count())
                    <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            Product Model
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <select wire:model="product">
                                <option value="-1" selected disabled hidden>Choose here</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->model }}</option>
                                @endforeach
                            </select>
                        </dd>
                    </div>
                @endif
                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Export Asset
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <ul role="list" class="border border-gray-200 rounded-md divide-y divide-gray-200">
                            <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                <div class="w-0 flex-1 flex items-center">
                                    <!-- Heroicon name: solid/paper-clip -->
                                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                              d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                    <span class="ml-2 flex-1 w-0 truncate">
                                      {{ $asset->asset_type->label . $asset->getSerial() }} - {{ $asset->product->model }}.csv
                                    </span>
                                </div>
                                <div class="ml-4 flex-shrink-0">
                                    <a href="#" wire:click.prevent="export('csv')"
                                       class="font-medium text-indigo-600 hover:text-indigo-500">
                                        Download
                                    </a>
                                </div>
                            </li>
                            <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                <div class="w-0 flex-1 flex items-center">
                                    <span class="text-gray-200 font-">CSV</span>
                                    <!-- Heroicon name: solid/paper-clip -->
                                    <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                              d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                    <span class="ml-2 flex-1 w-0 truncate">
                                      {{ $asset->asset_type->label . $asset->getSerial() }} - {{ $asset->product->model }}.xlsx
                                    </span>
                                </div>
                                <div class="ml-4 flex-shrink-0">
                                    <a href="#" wire:click.prevent="export('xlsx')"
                                       class="font-medium text-indigo-600 hover:text-indigo-500">
                                        Download
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </dd>
                </div>
                <div
                    class="flex items-center justify-end bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                    <x-action-message on="saved"></x-action-message>
                    <button
                        class="transition transition-duration-50 px-4 py-2 text-white bg-gray-900 rounded-md float-right m-4"
                        wire:click="save"
                        wire:loading.class="opacity-50">
                        Save
                    </button>
                </div>
            </dl>
        </div>
    </div>
</div>
