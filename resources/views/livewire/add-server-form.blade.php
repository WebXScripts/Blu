<div x-data="{ showPopup: false }" x-on:server-added.window="showPopup = false">
    <a href="#" @click="showPopup = true">
        <div class="p-2 rounded hover:bg-gray-600 text-gray-200 duration-150">
            <i class="fa fa-plus"></i>
        </div>
    </a>

    <div class="fixed z-10 inset-0 overflow-y-auto" x-show="showPopup" x-cloak>
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity duration-150" aria-hidden="true" @click="showPopup = false">
                <div class="absolute inset-0 bg-gray-800 opacity-75"></div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full duration-150" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                <form wire:submit.prevent="handle">
                    <div class="px-4 py-5 bg-gray-50 sm:px-6">
                        <h2 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                            Add a server
                        </h2>
                    </div>
                    <div class="px-4 py-4 sm:p-6">
                        <label for="name" class="block font-medium text-sm text-gray-700">
                            Name
                        </label>
                        <input wire:model.lazy="name" type="text" name="name" id="name" class="form-input rounded-md shadow-sm mt-1 block w-full @error('name') border-red-500 @enderror" placeholder="Laravel">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <label for="url" class="block font-medium text-sm text-gray-700 mt-4">
                            URL
                        </label>
                        <input wire:model.lazy="url"  type="url" name="url" id="url" class="form-input rounded-md shadow-sm mt-1 block w-full @error('url') border-red-500 @enderror" placeholder="laravel.io">
                        @error('url')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <label for="description" class="block font-medium text-sm text-gray-700 mt-4">
                            Description
                        </label>
                        <input wire:model.lazy="description"  type="text" name="description" id="description" class="form-input rounded-md shadow-sm mt-1 block w-full @error('description') border-red-500 @enderror" placeholder="Please stay online!">
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        <div class="flex items-center justify-center w-full mt-4">
                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer @error('image') border-red-500 @enderror">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">Server thumbnail image</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                </div>
                                <input wire:model="image" id="dropzone-file" type="file" class="hidden" />
                            </label>
                        </div>

                        @error('image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror

                        @if($image)
                            <div class="flex justify-center mt-4 h">
                                <img alt="uploaded file" src="{{ $image->temporaryUrl() }}" class="w-16 h-16 object-cover rounded-lg"/>
                            </div>
                        @endif
                    </div>

                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" wire:loading.attr="disabled">
                            Create server
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
