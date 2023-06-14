<main class="container mx-w-6xl mx-auto py-4">
    @if(!$website->hasThumbnail())
        <div class="lg:rounded-xl bg-gradient-to-r from-cyan-500 to-blue-500">
            <div class="backdrop-brightness-50 lg:rounded-xl h-48">
                <div class="flex justify-end px-4 pt-4">
                    <span class="flex w-3 h-3 rounded-full {{ $this->generateStatusDot() }}"></span>
                </div>
                <div class="flex flex-col h-3/4 items-center justify-center">
                    <p class="text-white text-5xl font-bold tracking-wide">{{ $website->name }}</p>
                    <span class="text-white mt-4 text-lg text-gray-500 md:hidden">{{ $website->description }}</span>
                </div>
            </div>
        </div>
    @else
        <div class="lg:rounded-xl bg-cover bg-no-repeat bg-center"
             style="background-image: url('{{ $website->getThumbnailUrl() }}')">
            <div class="backdrop-brightness-50 lg:rounded-xl h-48">
                <div class="flex justify-end px-4 pt-4">
                    <span class="flex w-3 h-3 rounded-full {{ $this->generateStatusDot() }}"></span>
                </div>
                <div class="flex flex-col h-3/4 items-center justify-center">
                    <p class="text-white text-5xl font-bold tracking-wide">{{ $website->name }}</p>
                    <span class="text-white mt-4 text-lg text-gray-500 md:hidden">{{ $website->description }}</span>
                </div>
            </div>
        </div>
    @endif
    <div class="flex flex-col md:flex-row mt-4 space-x-3.5 items-stretch -mx-4 mx-auto p-6">
        <div class="flex-1 md:w-1/3 md:mt-0">
            <div class="bg-white p-6 rounded-xl border border-gray-50 h-full">
                <livewire:tables.scan-histories-table :website="$website" wire:key="scan-histories-table" />
            </div>
        </div>
        <div class="flex-1 md:w-1/3 mt-4 md:mt-0">
            <div class="bg-white p-6 rounded-xl border border-gray-50 h-full">
                <div class="flex justify-between items-start">
                    <div class="flex flex-col">
                        <p class="text-xl text-gray-600 tracking-wide">{{ $website->name }}</p>
                        <h3 class="mt-1 text-xs text-gray-500 font-bold">{{ $website->description }}</h3>
                        <div class="flex flex-col justify-start space-y-1">
                            <div class="mt-4 font-bold text-xs text-gray-500">{{ $website->id }}</div>
                            <div class="font-bold text-xs text-gray-500">{{ $website->url }}</div>
                            <div class="text-xs text-gray-500">Status: {{ $this->getLastCheckedStatus() }}</div>
                            <div class="text-xs text-gray-500">Time: {{ $this->getLastCheckedResponseTime() }}ms</div>
                            <div class="text-xs text-gray-500">Last checked: {{ $this->getLastCheckedDate() }}</div>
                        </div>
                        <div class="flex flex-col justify-start mt-5">
                            <div class="text-xs text-gray-500">
                                <a href="{{ $website->url }}" target="_blank" class="text-blue-500 hover:text-blue-600">Go to the website</a>
                            </div>
                            <div class="text-xs text-gray-500">
                                <a class="text-blue-500 hover:text-blue-600">Scan now</a>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-row justify-start space-x-1.5">
                        <div class="pb-3">
                            <div class="flex bg-green-500 p-2 md:p-1 xl:p-2 rounded-md justify-center">
                                <i class="fa fa-check text-white mr-1.5"></i>
                                <span class="text-xs text-white tracking-wide">{{ $this->getPositiveStatusCount() }}</span>
                            </div>
                        </div>
                        <div class="pb-3">
                            <div class="flex bg-red-500 p-2 md:p-1 xl:p-2 rounded-md justify-center">
                                <i class="fa fa-warning text-white mr-1.5"></i>
                                <span class="text-xs text-white tracking-wide">{{ $this->getNegativeStatusCount() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex-1 md:w-1/3 mt-4 md:mt-0">
            <div class="bg-white p-6 rounded-xl border border-gray-50 h-full">
                <div class="flex flex-col justify-center items-center h-full">
                    <div
                        class="flex justify-center items-center bg-gray-100 rounded-full w-24 h-24 mb-4">
                        <i class="fa fa-robot text-gray-500 text-4xl"></i>
                    </div>
                    <div class="flex flex-col justify-center items-center">
                        <p class="text-xl text-gray-600 tracking-wide">Lyra</p>
                        <h3 class="mt-1 text-xs text-gray-500 font-bold">Lyra is not connected.</h3>
                        <div class="flex flex-col justify-center items-center mt-4">
                            <button
                                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-xl duration-150">
                                Connect
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
