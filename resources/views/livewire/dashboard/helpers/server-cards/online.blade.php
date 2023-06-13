<?php
/**
 * @var \App\Models\Website $website
 */
?>
<div class="bg-white p-6 rounded-xl border border-gray-50" wire:poll.5s wire:click="lookUp">
    <div class="flex justify-between items-start">
        <div class="flex flex-col">
            <p class="text-xs text-gray-600 tracking-wide">{{ $website->name }}</p>
            <h3 class="mt-1 text-lg text-green-500 font-bold">Online</h3>
            <span class="mt-4 text-xs text-gray-500">{{ $website->url }}</span>
        </div>
        <div class="bg-green-500 p-2 md:p-1 xl:p-2 rounded-md">
            <i class="fa fa-check text-white"></i>
        </div>
    </div>
</div>
