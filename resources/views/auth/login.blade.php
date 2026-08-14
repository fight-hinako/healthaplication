<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ __('Login') }} - {{ config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css'])
        @livewireStyles
    </head>
    <body>
      <div class="border-2 rounded-md w-96 mx-auto p-6 border-black">
        <h1 class="font-bold text-center">Login</h1>
        <p class="text-center my-2">Please enter your details.</p>
        <form class="flex flex-col gap-4" method="POST" action="{{ route('login.submit') }}">
                @csrf
                <input class="border-2 rounded-md p-2" type="text" name="email" placeholder="Email" value="{{ old('email') }}" required>
                <input class="border-2 rounded-md p-2" type="password" name="password" placeholder="Password" required>
                <div class="flex items-center gap-2 ml-4">
                    <input type="checkbox" name="remember" id="remember" @checked(old('remember'))>
                    <label for="remember">Remember me</label>
                </div>
                <button  type="submit" class="bg-blue-500 text-white bg-blue-500 px-3 py-1 rounded-md">Login</button>
                @error('login')
                   <p class="text-red-600 text-sm border border-red-300 bg-red-50 rounded-md p-3" role="alert">{{ $message }}</p>
                @enderror
       </form>
       <div class="mt-4 text-center">
            <a method="GET" href="{{ route('createaccount') }}" class="bg-yellow-500 text-white rounded-lg px-3 py-1 inline-block">Create account</a>
       </div>
      </div>
    </body>
</html>
