@extends('layouts.app-with-sidebar')

@section('main')
    @vite(['resources/css/app.css','resources/js/home.js'])
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-2 w-full">
        <div class="lg:col-span-2">
            @include('partials.workcountcard')
        </div>
        <div class="lg:col-span-3">
            @include('partials.taskcountcard')
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-2 w-full mt-3">
        <div class="lg:col-span-2">
            @include('partials.goalscard')
        </div>
        <div class="lg:col-span-3">
            @include('partials.dailychart')
        </div>
    </div>
@endsection
