<nav x-data="{ open: false }" class="border-b border-slate-200 bg-white/95 backdrop-blur dark:border-slate-800 dark:bg-slate-950/90">
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-8">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                <x-application-logo class="h-10 w-auto" />
                <div class="hidden sm:block">
                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-slate-400">Müşteri Paneli</p>
                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Bilyam</p>
                </div>
            </a>
            <div class="hidden items-center gap-6 text-sm font-medium text-slate-600 sm:flex dark:text-slate-300">
                <a href="{{ route('dashboard') }}" class="transition hover:text-bilya-blue {{ request()->routeIs('dashboard') ? 'text-bilya-blue' : '' }}">Panel</a>
                <a href="{{ route('account.quotes.index') }}" class="transition hover:text-bilya-blue {{ request()->routeIs('account.quotes.*') ? 'text-bilya-blue' : '' }}">Tekliflerim</a>
                <a href="{{ route('account.profile.edit') }}" class="transition hover:text-bilya-blue {{ request()->routeIs('account.profile.*') ? 'text-bilya-blue' : '' }}">Profil</a>
                @if(auth()->user()?->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="transition hover:text-bilya-blue">Admin</a>
                @endif
            </div>
        </div>

        <div class="hidden items-center gap-3 sm:flex">
            <div class="rounded-full bg-slate-100 px-4 py-2 text-sm text-slate-600 dark:bg-slate-900 dark:text-slate-300">{{ Auth::user()->name }}</div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-bilya-blue hover:text-bilya-blue dark:border-slate-700 dark:text-slate-200">Cikis Yap</button>
            </form>
        </div>

        <button @click="open = !open" class="rounded-full border border-slate-300 p-2 text-slate-600 sm:hidden dark:border-slate-700 dark:text-slate-200">
            <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <div x-show="open" class="border-t border-slate-200 px-4 py-4 sm:hidden dark:border-slate-800">
        <div class="space-y-3 text-sm text-slate-700 dark:text-slate-200">
            <a href="{{ route('dashboard') }}" class="block">Panel</a>
            <a href="{{ route('account.quotes.index') }}" class="block">Tekliflerim</a>
            <a href="{{ route('account.profile.edit') }}" class="block">Profil</a>
            @if(auth()->user()?->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="block">Admin</a>
            @endif
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block text-left">Cikis Yap</button>
            </form>
        </div>
    </div>
</nav>
