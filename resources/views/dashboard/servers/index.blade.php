<?php
/** @var \App\Models\Website[] $servers */
?>
@extends('layouts.dashboard.app')
@section('content')
    <main class="container mx-w-6xl mx-auto py-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 px-4 xl:p-0 gap-4 xl:gap-6">
            <div class="col-span-1 md:col-span-2 lg:col-span-4 flex justify-between">
                <h2 class="text-xs md:text-sm text-gray-200 font-bold tracking-wide md:tracking-wider">
                    Servers</h2>

                @foreach($servers as $server)
                    <livewire:server-card :server="$server" />
                @endforeach
            </div>
        </div>
    </main>
@endsection
