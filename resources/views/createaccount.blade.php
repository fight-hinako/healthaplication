<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>アカウント作成</title>
  @vite(['resources/css/app.css'])
</head>
<body class="w-full h-full mt-5 flex items-start">
  <div class="max-w-xl mx-auto border-gray-300 border-2 rounded-md p-8 bg-white">
    <h1 class="font-bold text-center text-2xl">アカウント作成</h1>
    <form class="flex flex-col gap-4 m-4" method="POST" action="{{ route('createaccount.submit') }}">
            @csrf

            {{-- メールアドレス --}}
            <div class="items-center gap-2 mb-4 text-left w-full">
                <label class="text-right text-lg mb-2 shrink-0">メールアドレス</label>
                <input type="text" name="email"
                    class="w-full border-gray-300 hover:border-black transition-colors border-2 rounded-md p-2" />
            </div>
            @error('email')
                <p class="text-red-500 text-xs ml-32 mt-2 mb-2 text-left">{{ $message }}</p>
            @enderror

            {{-- パスワード --}}
            <div class="items-center gap-2 mb-4 w-full">
                <label class="text-right text-lg mb-2 shrink-0">パスワード</label>
                <input type="password" name="password"
                    class="w-full border-gray-300 hover:border-black transition-colors border-2 rounded-md p-2" />
            </div>
            @error('password')
                <p class="text-red-500 text-xs ml-32 -mt-3 mb-2 text-left">{{ $message }}</p>
            @enderror

            {{-- パスワード確認 --}}
            <div class="items-center gap-2 mb-4 w-full">
                <label class="text-right text-lg mb-2 shrink-0">パスワード確認</label>
                <input type="password" name="password_confirmation"
                    class="w-full border-gray-300 hover:border-black transition-colors border-2 rounded-md p-2" />
            </div>
            @error('password_confirmation')
                <p class="text-red-500 text-xs ml-32 -mt-3 mb-2 text-left">{{ $message }}</p>
            @enderror

            {{-- ボタン --}}
            <div class="flex justify-center gap-4">
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white rounded-md px-8 py-2 transition-colors cursor-pointer" type="submit">
                    アカウント作成
                </button>
                @if(session('success'))
                      <div class="text-green-600">
                            {{ session('success') }}
                      </div>
                @endif
                <button type="button"
                    onclick="location.href='{{ route('login') }}'"
                    class="border border-gray-400 rounded-md text-gray-600 text-lg font-bold px-8 py-2 rounded hover:bg-gray-50 transition-colors">
                    キャンセル
                </button>
            </div>

        </form>
    </div>
  </div>
</body>
