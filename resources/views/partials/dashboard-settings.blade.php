<div id="settings">
  <flux:separator variant="subtle" class="my-8" />
  <div class="flex flex-col lg:flex-row gap-4 lg:gap-6">
    <div class="w-80">
        <flux:heading size="lg">設定</flux:heading>
        <flux:subheading>各項目を入力し、「保存」をクリックして更新します。</flux:subheading>
    </div>

    <div class="flex-1 space-y-6">
        <form method="POST" action="{{ route('dashboard.update') }}" class="flex-1 space-y-6">
                @csrf

            <div class="flex flex-col gap-2">
             <p class="text-lg font-bold text-gray-700">ユーザー設定</p>
               <p class="text-sm text-gray-700">ユーザーのメールアドレス:</p>
               {{-- email address --}}
               <div class="flex items-center gap-2 mb-4">
                   <label class="w-28 text-right text-sm text-gray-700 shrink-0">新たなメールアドレス:</label>
                   <input type="text" name="email"
                    class="flex-1 border border-gray-300 rounded px-3 py-1.5 text-sm focus:outline-none focus:border-blue-400" />
               </div>
               @error('email')
                  <p class="text-red-500 text-xs ml-32 -mt-3 mb-2">{{ $message }}</p>
               @enderror

              {{-- password --}}
              <p class="text-sm text-gray-700">ユーザーのパスワード:</p>
               {{-- update password --}}
               <div class="flex items-center gap-2 mb-4">
                   <label class="w-28 text-right text-sm text-gray-700 shrink-0">ユーザーのパスワード:</label>
                   <input type="password" name="password"
                    class="flex-1 border border-gray-300 rounded px-3 py-1.5 text-sm focus:outline-none focus:border-blue-400" />
               </div>
              @error('password')
                 <p class="text-red-500 text-xs ml-32 -mt-3 mb-2">{{ $message }}</p>
              @enderror

              {{-- update password --}}
               <div class="flex items-center gap-2 mb-4">
                   <label class="w-28 text-right text-sm text-gray-700 shrink-0">パスワードの更新:</label>
                   <input type="password" name="passwordConfirm"
                    class="flex-1 border border-gray-300 rounded px-3 py-1.5 text-sm focus:outline-none focus:border-blue-400" />
               </div>
               @error('passwordConfirm')
                   <p class="text-red-500 text-xs ml-32 -mt-3 mb-2">{{ $message }}</p>
               @enderror

            </div>

            <div class="flex flex-col gap-2">
              <p class="text-lg font-bold text-gray-700">仕事(勉強)時間 設定</p>
              <flux:select
                name="countdown_minutes"
                label="仕事(勉強)時間"
                description="仕事(勉強)時間を選択してください。値は分単位で保存されます。"
                placeholder="仕事(勉強)時間を選択してください。"
              >
                @foreach(config('workcountdown.options') as $minutes => $label)
                   <flux:select.option
                       value="{{ $minutes }}"
                       {{ auth()->user()->countdown_minutes == $minutes ? 'selected' : '' }}
                    >
                    {{ $label }}
                    </flux:select.option>
                    @endforeach
                </flux:select>
            </div>

            <flux:button name="save_settings" type="submit" variant="primary">保存</flux:button>

        </form>
    
    </div>
  </div>
</div>
