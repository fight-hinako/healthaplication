@extends('layouts.app-with-sidebar')

@section('main')
    @vite(['resources/css/app.css','resources/js/home.js'])
    <div class="grid grid-cols-1 lg:grid-cols-9 gap-6 w-full flex-1 min-h-0 items-start">
        <div class="lg:col-span-2 w-full">
            @include('partials.workcountcard')
        </div>
        <div class="lg:col-span-3 w-full">
            @include('partials.taskcountcard')
        </div>
        <div class="lg:col-span-2 w-full">
            @include('partials.goalscard')
        </div>
        <div class="lg:col-span-2 w-full">
            @include('partials.dailychart')
        </div>
    </div>
@endsection
