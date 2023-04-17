<div class="bg-gray-800">
    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-gray-900 rounded-lg shadow-lg p-8 w-full md:w-1/2 lg:w-1/3">
            <h2 class="text-2xl font-bold text-white mb-8 text-center">{{ config('app.name') }}</h2>
            <form wire:submit.prevent="handle">
                <div class="mb-4">
                    <label for="email" class="block text-white font-bold mb-2">Email Address</label>
                    <input wire:model.lazy="email" type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('email') <x-error-message :message="$message"/> @enderror
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-white font-bold mb-2">Password</label>
                    <input wire:model.lazy="password" type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('password') <x-error-message :message="$message"/> @enderror
                </div>

                <div class="flex justify-center">
                    <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Log In</button>
                </div>


                <div class="flex justify-center mt-4">
                    @error('error')
                        <x-error-message :message="$message"/>
                    @enderror
                </div>
            </form>
        </div>
    </div>
</div>
