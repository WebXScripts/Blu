@extends('layouts.dashboard.app')
@section('content')
    <main class="container mx-w-6xl mx-auto py-4">
        <div class="flex flex-col space-y-8">
            <x-dashboard.first-row />
            <x-dashboard.second-row />
        </div>
    </main>
@endsection
