@extends('layouts.app')

@section('content')
<div class="flex min-h-screen">
    @include('partials.app-sidebar')
    <div class="flex flex-col flex-1 min-w-0">
        @include('partials.app-header')

        <flux:main class="w-full max-w-none flex flex-col flex-1 min-h-0 p-4 lg:p-6">
            @yield('main')
        </flux:main>
    </div>
</div>
@endsection
