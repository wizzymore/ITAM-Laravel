<div class="w-full lg:w-6/12 xl:w-3/12 px-4">
    <div class="relative flex flex-col min-w-0 break-words bg-gray-50 rounded mb-6 xl:mb-0 shadow-lg">
        <div class="flex-auto p-4">
            <div class="flex flex-wrap">
                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                    <h5 class="text-blueGray-400 uppercase font-bold text-xs">
                        {{ $title }}
                    </h5>
                    <span class="font-semibold text-lg text-blueGray-700">
                        {{ $subtitle }}
                    </span>
                </div>
                <div class="relative w-auto pl-4 flex-initial">
                    <div
                        class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-{{ $iconColor }}-500">
                        <i class="{{ $icon }}"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
