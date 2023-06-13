<nav class="p-4 md:py-8 xl:px-0 md:container md:mx-w-6xl md:mx-auto">
    <div class="hidden lg:flex lg:justify-between lg:items-center">
        <a href="{{ route('dashboard') }}" class="flex items-start gap-2 group">
            <div class="bg-blue-600 text-white p-2 rounded-md group-hover:bg-blue-800 duration-150">
                <span class="fa-brands fa-2x fa-laravel"></span>
            </div>
            <p class="text-sm font-light uppercase text-white">
                {{ config('app.name') }}
                <span class="text-base block font-bold tracking-widest text-white">
                        Dashboard
                    </span>
            </p>
        </a>
        <ul class="flex items-center space-x-4 text-sm font-semibold">
            <li>
                <a href="{{ route('dashboard') }}" class="px-2 xl:px-4 py-2 text-gray-200 rounded-md hover:bg-gray-600 duration-150 @if(request()->routeIs('dashboard')) bg-gray-600 @endif">Dashboard</a>
            </li>
            <li>
                <a href="{{ route('servers') }}" class="px-2 xl:px-4 py-2 text-gray-200 rounded-md hover:bg-gray-600 duration-150 @if(request()->routeIs('servers')) bg-gray-600 @endif">My servers</a>
            </li>
            <li>
                <a href="#" class="px-2 xl:px-4 py-2 text-gray-200 rounded-md hover:bg-gray-600 duration-150">Accounts</a>
            </li>
        </ul>
        @if(request()->routeIs('dashboard'))
            <x-dashboard.navbar.dashboard-items />
        @endif
        @if(request()->routeIs('servers'))
            <x-dashboard.navbar.servers-list-items />
        @endif
        @if(request()->routeIs('servers.lookup'))
            <x-dashboard.navbar.look-up-items />
        @endif
        <ul class="flex items-center gap-6">
            <li>
                <a href="#" class="text-sm font-sans text-gray-200 font-semibold tracking-wider">
                    {{ Auth::user()->name }}
                </a>
            </li>
            <li>
                <a href="{{ route('logout') }}">
                    <div class="p-2 rounded hover:bg-gray-600 text-gray-200 duration-150">
                        <i class="fa fa-sign-out-alt"></i>
                    </div>
                </a>
            </li>
        </ul>
    </div>
    <div x-data="{ open: false }" class="lg:hidden relative flex justify-between w-full">
        <a href="#" class="flex items-start gap-2 group">
            <div class="bg-blue-600 text-white p-3 rounded-md group-hover:bg-blue-800">
                <span class="fa-brands fa-2x fa-laravel"></span>
            </div>
            <p class="text-sm font-light uppercase text-white">
                {{ config('app.name') }}
                <span class="text-base block font-bold tracking-widest text-white">
                    Dashboard
                </span>
            </p>
        </a>
        <button x-on:click="open = !open" type="button" class="p-3 rounded-md text-gray-200">
            <i class="fa fa-bars" x-show="!open"></i>
            <i class="fa fa-times" x-show="open"></i>
        </button>
        <div x-show="open" x-transition class="absolute top-14 left-0 right-0 w-full bg-white rounded-md border">
            <ul class="p-4">
                <li class="px-4 py-2 rounded hover:bg-gray-200">
                    <a href="#" class="flex items-center gap-4">
                        Dashboard
                    </a>
                </li>
                <li class="px-4 py-2 rounded hover:bg-gray-200">
                    <a href="#" class="flex items-center gap-4">
                        My servers
                    </a>
                </li>
                <li class="px-4 py-2 rounded hover:bg-gray-200">
                    <a href="#" class="flex items-center gap-4">
                        Accounts
                    </a>
                </li>
                <!-- spacer -->
                <li class="h-4"></li>
                <li class="px-4 py-2 rounded hover:bg-gray-200">
                    <a href="#" class="flex items-center gap-4">
                        My account
                    </a>
                </li>
                <li class="px-4 py-2 rounded hover:bg-gray-200">
                    <a href="{{ route('logout') }}" class="flex items-center gap-4">
                        Logout
                    </a>
            </ul>
        </div>
    </div>
</nav>
