<flux:sidebar sticky collapsible="mobile" class="bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.header>
        <flux:sidebar.brand
            href="{{ route('home') }}"
            logo="https://fluxui.dev/img/demo/logo.png"
            logo:dark="https://fluxui.dev/img/demo/dark-mode-logo.png"
            name="健康管理アプリ"
        />

        <flux:sidebar.collapse class="lg:hidden" />
    </flux:sidebar.header>

    <flux:sidebar.search placeholder="Search..." />

    <flux:sidebar.nav>
        <flux:sidebar.item icon="home" href="{{ route('home') }}" :current="request()->routeIs('home')" >Home</flux:sidebar.item>
    </flux:sidebar.nav>

    <flux:sidebar.spacer />
    
    <flux:sidebar.nav>
        <flux:sidebar.item icon="cog-6-tooth" href="{{ route('dashboard') }}" :current="request()->routeIs('dashboard')">Settings</flux:sidebar.item>
    </flux:sidebar.nav>
    <flux:sidebar.nav>
       <form method="POST" action="{{ route('logout') }}">
        @csrf
        <flux:sidebar.item icon="arrow-right-start-on-rectangle" type="submit">Logout</flux:sidebar.item>
      </form>
    </flux:sidebar.nav>

</flux:sidebar>
