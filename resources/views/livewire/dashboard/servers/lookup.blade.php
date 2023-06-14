<main class="container mx-w-6xl mx-auto py-4">
    @if(!$website->hasThumbnail())
        <div class="rounded-xl bg-gradient-to-r from-cyan-500 to-blue-500">
            <div class="backdrop-brightness-50 rounded-xl h-48">
                <div class="flex justify-end px-4 pt-4">
                    <span class="flex w-3 h-3 rounded-full animate-pulse {{ $this->generateStatusDot() }}" wire:poll.10s></span>
                </div>
                <div class="flex flex-col h-3/4 items-center justify-center">
                    <p class="text-white text-5xl font-bold tracking-wide">{{ $website->name }}</p>
                    <span class="text-white mt-4 text-lg text-gray-500">{{ $website->description }}</span>
                </div>
            </div>
        </div>
    @else
        <div class="rounded-xl bg-cover bg-no-repeat bg-center"
             style="background-image: url('{{ $website->getThumbnailUrl() }}')">
            <div class="backdrop-brightness-50 rounded-xl h-48">
                <div class="flex justify-end px-4 pt-4">
                    <span class="flex w-3 h-3 rounded-full animate-pulse {{ $this->generateStatusDot() }}" wire:poll.10s></span>
                </div>
                <div class="flex flex-col h-3/4 items-center justify-center">
                    <p class="text-white text-5xl font-bold tracking-wide">{{ $website->name }}</p>
                    <span class="text-white mt-4 text-lg text-gray-500">{{ $website->description }}</span>
                </div>
            </div>
        </div>
    @endif
</main>
