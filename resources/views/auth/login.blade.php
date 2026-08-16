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
      <div class="border-gray-300 border-2 w-96 rounded-md mx-auto p-6 mt-5 bg-white">
        <h1 class="font-bold text-center">ログイン</h1>
        <p class="text-center my-2">ログイン情報を入力してください。</p>
        <form class="flex flex-col gap-4" method="POST" action="{{ route('login.submit') }}">
                @csrf
                <input class="border-2 rounded-md p-2" type="text" name="email" placeholder="Email" value="{{ old('email') }}" required>
                <input class="border-2 rounded-md p-2" type="password" name="password" placeholder="Password" required>
                <div class="flex items-center gap-2 ml-4">
                    <input type="checkbox" name="remember" id="remember" @checked(old('remember'))>
                    <label for="remember">ログイン状態を保持する</label>
                </div>
                <button  type="submit" class="bg-green-500 hover:bg-green-700 opacity-75 text-white px-3 py-1 rounded-md cursor-pointer">ログイン</button>
                @error('login')
                   <p class="text-red-600 text-sm border border-red-300 bg-red-50 rounded-md p-3" role="alert">{{ $message }}</p>
                @enderror
       </form>
       <div class="mt-4 text-center">
            <a method="GET" href="{{ route('createaccount') }}" class="text-green-500 hover:text-green-700 rounded-lg px-3 py-1 inline-block cursor-pointer">アカウント作成</a>
       </div>
      </div>
    </body>
</html>
