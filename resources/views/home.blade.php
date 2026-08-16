@extends('layouts.app-with-sidebar')

@section('main')
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 w-full flex-1 min-h-0 items-start">
        <div class="lg:col-span-2 w-full">
            @include('partials.workcountcard')
        </div>
        <div class="lg:col-span-3 w-full">
            @include('partials.taskcountcard')
        </div>
        <div class="lg:col-span-2 w-full">
            @include('partials.dailychart')
        </div>
    </div>

    @vite(['resources/js/home.js'])
@endsection
