@extends('layouts.app')

@section('content')
<div class="flex min-h-screen">
    @include('partials.app-sidebar')
    <div class="flex flex-col flex-1 min-w-0">

        <flux:main>
            @yield('main')
        </flux:main>
    </div>
</div>
@endsection
