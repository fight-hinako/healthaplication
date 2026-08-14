<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>アカウント作成</title>
  @vite(['resources/css/app.css'])
</head>
<body class="w-full h-full pt-40 flex">
  <div class="border-2 rounded-md w-2/3 mx-auto p-6 border-black bg-white">
        <form method="POST" action="{{ route('createaccount.submit') }}">
            @csrf

            {{-- メールアドレス --}}
            <div class="flex items-center gap-2 mb-4">
                <label class="w-28 text-right text-sm text-gray-700 shrink-0">メールアドレス：</label>
                <input type="text" name="email"
                    class="flex-1 border border-gray-300 rounded px-3 py-1.5 text-sm focus:outline-none focus:border-blue-400" />
            </div>
            @error('email')
                <p class="text-red-500 text-xs ml-32 -mt-3 mb-2">{{ $message }}</p>
            @enderror

            {{-- パスワード --}}
            <div class="flex items-center gap-2 mb-4">
                <label class="w-28 text-right text-sm text-gray-700 shrink-0">パスワード：</label>
                <input type="password" name="password"
                    class="flex-1 border border-gray-300 rounded px-3 py-1.5 text-sm focus:outline-none focus:border-blue-400" />
            </div>
            @error('password')
                <p class="text-red-500 text-xs ml-32 -mt-3 mb-2">{{ $message }}</p>
            @enderror

            {{-- パスワード確認 --}}
            <div class="flex items-center gap-2 mb-4">
                <label class="w-28 text-right text-sm text-gray-700 shrink-0">パスワード確認：</label>
                <input type="password" name="password_confirmation"
                    class="flex-1 border border-gray-300 rounded px-3 py-1.5 text-sm focus:outline-none focus:border-blue-400" />
            </div>
            @error('password_confirmation')
                <p class="text-red-500 text-xs ml-32 -mt-3 mb-2">{{ $message }}</p>
            @enderror

            {{-- ボタン --}}
            <div class="gap-4 mt-8 margin-auto">
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white rounded-md px-8 py-2 mx-10 transition-colors cursor-pointer" type="submit">
                    アカウント作成
                </button>
                @if(session('success'))
                      <div class="text-green-600">
                            {{ session('success') }}
                      </div>
                @endif
                <button type="button"
                    onclick="location.href='{{ route('login') }}'"
                    class="border border-gray-400 rounded-md text-gray-600 text-sm font-medium px-8 py-2 rounded hover:bg-gray-50 transition-colors">
                    キャンセル
                </button>
            </div>

        </form>
    </div>
  </div>
</body>
