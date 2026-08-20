@extends('layouts.app')

@section('content')
<div class="flex flex-col min-h-screen flex justify-center items-center">
    <div class="w-full">
        @include('partials.app-header')
    </div>
    <div class="w-full min-m-2">
        @yield('main')
    </div>
</div>
@endsection
