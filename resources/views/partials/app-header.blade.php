<flux:tab.group>
   @csrf
   <form method="POST" action="{{ route('logout') }}" class="w-full">
     <flux:tabs>
        <flux:tab name="home" icon="home" href="{{ route('home') }}" :current="request()->routeIs('home')">Home</flux:tab>
        <flux:tab name="setting"icon="cog-6-tooth" href="{{ route('dashboard') }}" :current="request()->routeIs('dashboard')">Setting</flux:tab>
        <button name="logout" type="submit" class="flex items-center gap-2 text-sm text-gray-500 opacity-75 hover:text-gray-700">
          <flux:icon name="arrow-right-start-on-rectangle" class="w-4 h-4 flex justify-center text-gray-500ver opacity-75 hover:text-gray-700" />
          Logout
         </button>
     </flux.tabs>
    </form>
</flux:tab.group>