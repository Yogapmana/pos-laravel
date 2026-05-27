<header class="bg-navy text-white px-6 py-4 flex items-center justify-between shadow-lg">
    <div class="flex items-center gap-4">
        <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
        </div>
        <div>
            <h1 class="text-lg font-bold font-heading">Dapur Bunda</h1>
            <p class="text-xs text-white/60">Point of Sale</p>
        </div>
    </div>
    <div class="flex items-center gap-6">
        <div class="text-right">
            <p class="text-sm font-medium">{{ auth()->user()->name ?? 'Kasir' }}</p>
            <p class="text-xs text-white/60 capitalize">{{ auth()->user()->role ?? 'kasir' }}</p>
        </div>
        <button
            wire:click="toggleOrderHistory"
            class="p-2 hover:bg-white/10 rounded-lg transition-colors relative"
            title="Riwayat Transaksi"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </button>
        <div class="flex items-center gap-2">
            @if(auth()->user()->role === 'admin')
                <a href="/admin/dashboard" class="p-2 hover:bg-white/10 rounded-lg transition-colors" title="Admin Panel">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                </a>
            @endif
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="p-2 hover:bg-white/10 rounded-lg transition-colors text-error" title="Logout">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</header>
