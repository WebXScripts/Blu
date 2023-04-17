<?php
/** @var \App\Models\User $user */
?>
<div class="grid grid-cols-1 md:grid-cols-4 xl:grid-cols-5 px-4 xl:p-0 gap-y-4 md:gap-6">
    <div class="md:col-span-2 xl:col-span-3 bg-white p-6 rounded-2xl border border-gray-50">
        <div class="flex flex-col space-y-6 md:h-full md:justify-between">
            <div class="flex justify-between">
                <span class="text-xs text-gray-500 font-semibold uppercase tracking-wider">
                    Welcome to Blu!
                </span>
                <span class="text-xs text-gray-500 font-semibold uppercase tracking-wider">
                    Issues found
                </span>
            </div>
            <div class="flex gap-2 md:gap-4 justify-between items-center">
                <div class="flex flex-col space-y-4">
                    <h2 class="text-gray-800 font-bold tracking-widest leading-tight">Hello {{ $user->name }}!</h2>
                    <div class="flex items-center gap-4">
                        <p class="text-lg text-gray-600 tracking-wider">You have <span
                                class="text-blue-600 font-bold">{{ $user->websites()->count() }}</span> servers online.</p>
                    </div>
                </div>
                <h2 class="text-lg md:text-xl xl:text-3xl text-gray-700 font-black tracking-wider">
                    0
                </h2>
            </div>
            <div class="flex gap-2 md:gap-4">
                <a href="#"
                   class="bg-blue-600 px-5 py-3 w-full text-center md:w-auto rounded-lg text-white text-xs tracking-wider font-semibold hover:bg-blue-800 duration-150">
                    Manage servers
                </a>
                <a href="#"
                   class="bg-blue-50 px-5 py-3 w-full text-center md:w-auto rounded-lg text-blue-600 text-xs tracking-wider font-semibold hover:bg-blue-600 hover:text-white duration-150">
                    Account settings
                </a>
            </div>
        </div>
    </div>
    <div
        class="col-span-2 p-6 rounded-2xl bg-gradient-to-r from-blue-500 to-blue-800 flex flex-col justify-between">
        <div class="flex flex-col">
            <p class="text-white font-bold">Blu is up and running!</p>
            <p class="mt-1 text-xs md:text-sm text-gray-50 font-light leading-tight max-w-sm">
                If you have any questions, please check our wiki first. We have a lot of useful information there.
                Thank you for choosing Blu!
            </p>
        </div>
        <div class="flex justify-between items-end">
            <a href="#"
               class="bg-blue-800 px-4 py-3 rounded-lg text-white text-xs tracking-wider font-semibold hover:bg-blue-600 hover:text-white duration-150">
                Go to wiki
            </a>
            <p class="text-xs text-gray-50 font-light">Last updated 3 hours ago</p>
        </div>
    </div>
</div>
