<div class="h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-dark-roast text-warm-white px-6 py-4 flex items-center justify-between shadow-lg">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 bg-terracotta rounded-xl flex items-center justify-center shadow-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
            <div>
                <h1 class="text-lg font-semibold">Dapur Bunda</h1>
                <p class="text-xs text-warm-white/50">Point of Sale</p>
            </div>
        </div>
        <div class="flex items-center gap-4">
            <div class="text-right">
                <p class="text-sm font-medium">{{ auth()->user()->name ?? 'Kasir' }}</p>
                <p class="text-xs text-warm-white/50 capitalize">{{ auth()->user()->role ?? 'kasir' }}</p>
            </div>
            <button
                wire:click="toggleOrderHistory"
                class="p-2.5 hover:bg-white/10 rounded-xl transition-all"
                title="Riwayat Transaksi"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </button>
            <div class="flex items-center gap-2 pl-2 border-l border-white/10">
                @if(auth()->user()->role === 'admin')
                    <a href="/admin/dashboard" class="p-2.5 hover:bg-white/10 rounded-xl transition-all" title="Admin Panel">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                    </a>
                @endif
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="p-2.5 hover:bg-error/20 text-error/80 hover:text-error rounded-xl transition-all" title="Logout">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="mx-6 mt-4 p-4 bg-olive/10 border border-olive/20 rounded-xl flex items-center gap-3 animate-fade-in">
            <svg class="w-5 h-5 text-olive flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-sm text-olive font-medium">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="mx-6 mt-4 p-4 bg-error/10 border border-error/20 rounded-xl flex items-center gap-3 animate-fade-in">
            <svg class="w-5 h-5 text-error flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-sm text-error font-medium">{{ session('error') }}</span>
        </div>
    @endif

    <div class="flex flex-1 overflow-hidden">

        <!-- Left Panel - Tables & Products -->
        <div class="flex-1 flex flex-col overflow-hidden">

            <!-- Table Selection -->
            <div class="bg-linen border-b border-sand px-5 py-4">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-sm font-semibold text-dark-roast tracking-tight">Pilih Meja</h3>
                    @if($selectedTableNumber)
                        <span class="px-3 py-1 bg-olive text-warm-white text-xs font-semibold rounded-full shadow-sm">
                            Meja {{ $selectedTableNumber }} Selected
                        </span>
                    @endif
                </div>
                <div class="flex gap-2.5 overflow-x-auto pb-2">
                    @forelse($tables as $table)
                        <button
                            wire:click="selectTable({{ $table->id }})"
                            @if($table->status === 'occupied' && $table->id !== $selectedTableId) disabled @endif
                            class="flex-shrink-0 px-5 py-3 rounded-xl text-sm font-semibold transition-all duration-200 @if($table->id === $selectedTableId) bg-olive text-warm-white shadow-md transform scale-105 @elseif($table->status === 'occupied') bg-sand text-warm-gray cursor-not-allowed @else bg-warm-white text-dark-roast hover:bg-stone/30 border border-sand shadow-sm hover:shadow-md @endif"
                        >
                            <div class="text-base font-bold">{{ $table->number }}</div>
                            <div class="text-xs @if($table->id === $selectedTableId) text-warm-white/80 @else text-warm-gray @endif">
                                {{ $table->capacity }} org
                            </div>
                            @if($table->status === 'occupied') <div class="text-[10px] text-warning mt-0.5">Terisi</div> @endif
                        </button>
                    @empty
                        <div class="text-center py-8 text-warm-gray w-full">
                            <p>Belum ada meja. Tambahkan di halaman admin.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Category Filter -->
            <div class="bg-linen border-b border-sand px-5 py-3">
                <div class="flex gap-2 flex-wrap">
                    <button
                        wire:click="$set('selectedCategoryId', '')"
                        class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 @if($selectedCategoryId === '') bg-dark-roast text-warm-white shadow-md @else bg-warm-white text-dark-roast hover:bg-stone/30 border border-sand @endif"
                    >
                        Semua
                    </button>
                    @foreach($categories as $category)
                        <button
                            wire:click="$set('selectedCategoryId', {{ $category->id }})"
                            class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 @if($selectedCategoryId === $category->id) bg-dark-roast text-warm-white shadow-md @else bg-warm-white text-dark-roast hover:bg-stone/30 border border-sand @endif"
                        >
                            {{ $category->name }}
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- Search -->
            <div class="bg-linen border-b border-sand px-5 py-3">
                <div class="relative">
                    <input
                        type="text"
                        wire:model.live.debounce.300ms="searchQuery"
                        placeholder="Cari menu..."
                        class="w-full h-11 pl-11 pr-4 bg-warm-white border-2 border-sand rounded-xl text-sm focus:outline-none focus:border-terracotta focus:ring-2 focus:ring-terracotta/10 transition-all"
                    >
                    <svg class="w-4 h-4 text-warm-gray absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="flex-1 overflow-y-auto p-5 bg-cream">
                @if($products and count($products) > 0)
                    <div class="grid grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3">
                        @foreach($products as $product)
                            <div
                                wire:click="addToCart({{ $product->id }})"
                                wire:loading.class="opacity-60 pointer-events-none"
                                wire:target="addToCart({{ $product->id }})"
                                class="group bg-warm-white rounded-2xl border-2 border-sand overflow-hidden cursor-pointer hover:shadow-xl hover:border-terracotta/40 transition-all duration-300 @if($product->stock <= 0) opacity-50 pointer-events-none @endif animate-fade-in"
                            >
                                <!-- Product Image -->
                                <div class="relative aspect-[3/2] bg-linen overflow-hidden">
                                    @if($product->image)
                                        <img
                                            src="{{ asset('storage/' . $product->image) }}"
                                            alt="{{ $product->name }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                        >
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <svg class="w-12 h-12 text-stone" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <!-- Stock Badge -->
                                    @if($product->stock <= 5 && $product->stock > 0)
                                        <span class="absolute top-1.5 right-1.5 px-2 py-0.5 bg-warning text-dark-roast text-[10px] font-bold rounded-full shadow-sm">Sisa {{ $product->stock }}</span>
                                    @elseif($product->stock <= 0)
                                        <div class="absolute inset-0 bg-dark-roast/50 flex items-center justify-center">
                                            <span class="px-2 py-1 bg-error text-warm-white text-xs font-bold rounded-full">Habis</span>
                                        </div>
                                    @endif
                                    <!-- Category Badge -->
                                    <span class="absolute top-1.5 left-1.5 px-2 py-0.5 bg-warm-white/95 backdrop-blur-sm text-dark-roast text-[10px] font-semibold rounded-full shadow-sm">
                                        {{ $product->category->name ?? '-' }}
                                    </span>
                                </div>
                                <!-- Product Info -->
                                <div class="p-2.5">
                                    <h3 class="font-semibold text-dark-roast text-sm leading-tight line-clamp-1">{{ $product->name }}</h3>
                                    <div class="flex items-center justify-between mt-1.5">
                                        <p class="text-dark-roast font-bold text-sm">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                        @if($product->stock > 0)
                                            <div class="w-7 h-7 bg-terracotta rounded-lg flex items-center justify-center group-hover:bg-olive transition-colors duration-300 shadow-sm group-hover:shadow-md">
                                                <svg class="w-4 h-4 text-warm-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-16 text-warm-gray">
                        <svg class="w-16 h-16 mx-auto mb-4 text-stone" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        <p class="text-lg font-medium">Tidak ada produk</p>
                        <p class="text-sm text-warm-gray/70 mt-1">Tambahkan produk di halaman Admin</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right Panel - Cart -->
        <div class="w-[400px] bg-warm-white border-l-2 border-sand flex flex-col shadow-soft">

            <!-- Cart Header -->
            <div class="p-5 border-b border-sand bg-linen">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 bg-terracotta rounded-xl flex items-center justify-center shadow-md">
                            <svg class="w-5 h-5 text-warm-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-base font-semibold text-dark-roast">Keranjang</h2>
                            @if($selectedTableNumber)
                                <p class="text-xs text-warm-gray">Meja {{ $selectedTableNumber }}</p>
                            @endif
                        </div>
                    </div>
                    @if(count($cart) > 0)
                        <button wire:click="clearCart" class="text-sm text-error/70 hover:text-error flex items-center gap-1.5 transition-colors font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Clear
                        </button>
                    @endif
                </div>
            </div>

            <!-- Cart Items -->
            <div class="flex-1 overflow-y-auto p-4">
                @if(count($cart) > 0)
                    <div class="space-y-3">
                        @foreach($cart as $id => $item)
                            <div class="bg-warm-white rounded-2xl p-4 border-2 border-sand animate-scale-in">
                                <div class="flex items-start gap-3 mb-3">
                                    <!-- Cart item thumbnail -->
                                    @if(isset($item['image']) && $item['image'])
                                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-14 h-14 rounded-xl object-cover flex-shrink-0 border border-sand">
                                    @else
                                        <div class="w-14 h-14 rounded-xl bg-linen flex items-center justify-center flex-shrink-0">
                                            <svg class="w-6 h-6 text-stone" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-semibold text-dark-roast text-sm leading-tight truncate">{{ $item['name'] }}</h4>
                                        <p class="text-sm text-warm-gray mt-0.5">Rp {{ number_format($item['price'], 0, ',', '.') }} x {{ $item['qty'] }}</p>
                                        @if(isset($notes[$id]) && $notes[$id] !== '')
                                            <p class="text-xs text-olive mt-1 italic">📝 {{ $notes[$id] }}</p>
                                        @endif
                                    </div>
                                    <button wire:click="removeFromCart({{ $id }})" class="p-2 hover:bg-error/10 rounded-xl transition-colors flex-shrink-0">
                                        <svg class="w-4 h-4 text-error/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>

                                <!-- Quantity Controls -->
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2 bg-linen rounded-xl p-1">
                                        <button
                                            wire:click="decrementQty({{ $id }})"
                                            class="w-8 h-8 bg-warm-white rounded-lg flex items-center justify-center text-dark-roast hover:bg-terracotta hover:text-warm-white transition-all duration-200 font-bold text-sm shadow-sm"
                                        >
                                            −
                                        </button>
                                        <span class="w-10 text-center font-bold text-dark-roast text-sm">{{ $item['qty'] }}</span>
                                        <button
                                            wire:click="incrementQty({{ $id }})"
                                            class="w-8 h-8 bg-warm-white rounded-lg flex items-center justify-center text-dark-roast hover:bg-terracotta hover:text-warm-white transition-all duration-200 font-bold text-sm shadow-sm"
                                        >
                                            +
                                        </button>
                                    </div>
                                    <span class="font-semibold text-dark-roast text-sm">Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</span>
                                </div>

                                <!-- Note Input -->
                                <div class="mt-3">
                                    <input
                                        type="text"
                                        wire:model.blur="notes.{{ $id }}"
                                        placeholder="Catatan (opsional)..."
                                        class="w-full h-9 px-3 bg-linen border-2 border-sand rounded-xl text-xs text-dark-roast focus:outline-none focus:border-terracotta placeholder:text-warm-gray/50 transition-all"
                                    >
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 text-warm-gray">
                        <svg class="w-14 h-14 mx-auto mb-3 text-stone/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <p class="text-sm font-medium">Keranjang Kosong</p>
                        <p class="text-xs text-warm-gray/70 mt-1">Pilih meja dan tambahkan menu</p>
                    </div>
                @endif
            </div>

            <!-- Billing & Pay Button -->
            <div class="border-t border-sand p-5 bg-linen">
                <!-- Billing Summary -->
                <div class="space-y-2.5 mb-4">
                    <div class="flex justify-between text-sm">
                        <span class="text-warm-gray">Subtotal</span>
                        <span class="font-medium text-dark-roast">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-warm-gray">PPN (11%)</span>
                        <span class="font-medium text-dark-roast">Rp {{ number_format($tax, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-base font-semibold border-t border-sand pt-2.5">
                        <span class="text-dark-roast">Total</span>
                        <span class="text-dark-roast">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Pay Button -->
                @if(count($cart) > 0)
                    <button
                        wire:click="openPaymentModal"
                        class="w-full h-12 bg-olive hover:bg-olive-dark text-warm-white font-semibold rounded-xl transition-all duration-200 text-sm shadow-md hover:shadow-lg flex items-center justify-center gap-2 btn-press"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                        Bayar Sekarang
                    </button>
                @else
                    <button disabled class="w-full h-12 bg-sand text-warm-gray font-semibold rounded-xl text-sm cursor-not-allowed flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                        Bayar Sekarang
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Payment Modal -->
    @if($showPaymentModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4" x-data="{}">
            <div class="fixed inset-0 bg-dark-roast/40 modal-backdrop"></div>
            <div class="relative bg-warm-white rounded-2xl shadow-2xl w-full max-w-lg p-6 animate-scale-in">

                <!-- Header -->
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-semibold text-dark-roast tracking-tight">Pembayaran</h3>
                        @if($selectedTableNumber)
                            <p class="text-sm text-warm-gray mt-0.5">Meja {{ $selectedTableNumber }}</p>
                        @endif
                    </div>
                    <button wire:click="closePaymentModal" class="p-2 hover:bg-linen rounded-xl transition-colors">
                        <svg class="w-5 h-5 text-warm-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Total Due -->
                <div class="bg-dark-roast text-warm-white rounded-2xl p-6 mb-6">
                    <p class="text-sm text-warm-white/60 mb-1">Total yang harus dibayar</p>
                    <p class="text-3xl font-semibold tracking-tight">Rp {{ number_format($grandTotal, 0, ',', '.') }}</p>
                </div>

                <!-- Payment Method Selector -->
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-dark-roast mb-3">Metode Pembayaran</label>
                    <div class="grid grid-cols-2 gap-3">
                        <button
                            wire:click="$set('paymentMethod', 'Tunai')"
                            class="px-4 py-5 rounded-xl border-2 text-sm font-medium transition-all duration-200 flex flex-col items-center gap-2 @if($paymentMethod === 'Tunai') border-terracotta bg-terracotta/5 text-terracotta @else border-sand text-warm-gray hover:border-stone @endif"
                        >
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Tunai
                        </button>
                        <button
                            wire:click="$set('paymentMethod', 'Midtrans')"
                            class="px-4 py-5 rounded-xl border-2 text-sm font-medium transition-all duration-200 flex flex-col items-center gap-2 @if($paymentMethod === 'Midtrans') border-terracotta bg-terracotta/5 text-terracotta @else border-sand text-warm-gray hover:border-stone @endif"
                        >
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                            Midtrans
                        </button>
                    </div>
                </div>

                <!-- Midtrans Error -->
                @if($midtransError)
                    <div class="mb-4 p-3 bg-error/10 border border-error/20 rounded-xl text-sm text-error">
                        {{ $midtransError }}
                    </div>
                @endif

                @if($paymentMethod === 'Tunai')
                    <!-- Cash Payment UI -->
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-dark-roast mb-2">Jumlah Uang (Rp)</label>
                        <input
                            type="text"
                            wire:model.live="paymentAmount"
                            class="w-full h-14 px-4 border-2 border-sand rounded-xl text-xl font-semibold focus:outline-none focus:border-terracotta transition-all"
                            placeholder="0"
                        >
                    </div>

                    <!-- Change Display -->
                    @if($change > 0)
                        <div class="mb-4 p-4 bg-olive/10 border-2 border-olive/20 rounded-xl">
                            <p class="text-sm text-olive font-medium">Kembalian</p>
                            <p class="text-2xl font-semibold text-olive">Rp {{ number_format($change, 0, ',', '.') }}</p>
                        </div>
                    @elseif($paymentAmount && (int) str_replace(['.', ','], '', $paymentAmount) < $grandTotal)
                        <div class="mb-4 p-4 bg-error/10 border-2 border-error/20 rounded-xl text-sm text-error">
                            <strong>Kurang:</strong> Rp {{ number_format($grandTotal - (int) str_replace(['.', ','], '', $paymentAmount), 0, ',', '.') }}
                        </div>
                    @endif

                    <!-- Quick Amount Buttons -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-dark-roast mb-2">Quick Amount</label>
                        <div class="grid grid-cols-4 gap-2">
                            @foreach([50000, 100000, 150000, 200000] as $amount)
                                <button
                                    wire:click="setPaymentAmount({{ $amount }})"
                                    class="px-3 py-3 bg-linen hover:bg-sand text-dark-roast text-sm font-medium rounded-xl transition-all duration-200"
                                >
                                    {{ number_format($amount, 0, '', '.') }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <button
                            type="button"
                            wire:click="closePaymentModal"
                            class="flex-1 h-14 border-2 border-sand text-warm-gray font-medium rounded-xl hover:bg-linen transition-all duration-200"
                        >
                            Batal
                        </button>
                        <button
                            wire:click="processPayment"
                            wire:loading.attr="disabled"
                            wire:target="processPayment"
                            @if(!$isValidPayment) disabled @endif
                            class="flex-1 h-14 bg-olive hover:bg-olive-dark text-warm-white font-semibold rounded-xl transition-all duration-200 disabled:bg-sand disabled:text-warm-gray flex items-center justify-center btn-press"
                        >
                            <span wire:loading.remove wire:target="processPayment">Bayar Tunai</span>
                            <span wire:loading wire:target="processPayment">Memproses...</span>
                        </button>
                    </div>
                @else
                    <!-- Midtrans Payment UI -->
                    <div class="bg-info/10 border-2 border-info/20 rounded-xl p-4 mb-6">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-info mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <p class="font-medium text-dark-roast">Pembayaran dengan Midtrans</p>
                                <p class="text-sm text-warm-gray mt-1">Anda akan dialihkan ke halaman pembayaran Midtrans.</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <button
                            type="button"
                            wire:click="closePaymentModal"
                            class="flex-1 h-14 border-2 border-sand text-warm-gray font-medium rounded-xl hover:bg-linen transition-all duration-200"
                        >
                            Batal
                        </button>
                        <button
                            wire:click="processPayment"
                            wire:loading.attr="disabled"
                            wire:target="processPayment"
                            class="flex-1 h-14 bg-terracotta hover:bg-terracotta-dark text-warm-white font-semibold rounded-xl transition-all duration-200 flex items-center justify-center btn-press"
                        >
                            <span wire:loading.remove wire:target="processPayment">Bayar Midtrans</span>
                            <span wire:loading wire:target="processPayment">Memproses...</span>
                        </button>
                    </div>
                @endif
            </div>
        </div>
    @endif

    <!-- Success Modal -->
    @if($showSuccessModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="fixed inset-0 bg-dark-roast/40 modal-backdrop"></div>
            <div class="relative bg-warm-white rounded-2xl shadow-2xl w-full max-w-md p-8 text-center animate-scale-in">
                <div class="w-20 h-20 bg-olive/10 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-olive" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>

                <h3 class="text-2xl font-semibold text-dark-roast mb-2">Pembayaran Berhasil!</h3>
                <p class="text-warm-gray mb-4">Order #{{ $lastOrderNumber }}</p>

                <div class="bg-linen rounded-2xl p-6 mb-6">
                    <p class="text-sm text-warm-gray mb-1">Total Bayar</p>
                    <p class="text-3xl font-semibold text-dark-roast">Rp {{ number_format($lastOrderTotal, 0, ',', '.') }}</p>
                </div>

                <div class="flex flex-col gap-3">
                    <a
                        href="/receipt/{{ $lastOrderId }}/download"
                        class="w-full h-12 bg-dark-roast hover:bg-dark-roast/90 text-warm-white font-medium rounded-xl transition-all duration-200 flex items-center justify-center gap-2 shadow-md hover:shadow-lg btn-press"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Download Struk
                    </a>
                    <button
                        wire:click="newTransaction"
                        class="w-full h-12 border-2 border-sand text-warm-gray font-medium rounded-xl hover:bg-linen transition-all duration-200"
                    >
                        Transaksi Baru
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Order History Panel -->
    @if($showOrderHistory)
        <div class="fixed inset-0 z-50 flex">
            <div class="fixed inset-0 bg-dark-roast/40 modal-backdrop" wire:click="toggleOrderHistory"></div>
            <div class="relative ml-auto w-[450px] bg-warm-white shadow-2xl flex flex-col h-full animate-slide-in">
                <!-- Header -->
                <div class="p-5 border-b border-sand bg-linen flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-dark-roast">Riwayat Transaksi</h3>
                        <p class="text-sm text-warm-gray">{{ auth()->user()->name }}</p>
                    </div>
                    <button wire:click="toggleOrderHistory" class="p-2 hover:bg-sand rounded-xl transition-colors">
                        <svg class="w-5 h-5 text-warm-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- History List -->
                <div class="flex-1 overflow-y-auto p-4 space-y-3">
                    @forelse($orderHistory as $order)
                        <div class="bg-warm-white rounded-2xl p-4 border-2 border-sand">
                            <div class="flex items-center justify-between mb-2">
                                <div>
                                    <p class="font-semibold text-dark-roast text-sm">{{ $order->order_number }}</p>
                                    <p class="text-xs text-warm-gray mt-0.5">Meja {{ $order->table?->number ?? '-' }} • {{ $order->created_at->format('d M Y, H:i') }}</p>
                                </div>
                                @if($order->status === 'Paid')
                                    <span class="px-2.5 py-1 bg-olive/10 text-olive text-xs font-semibold rounded-full">Paid</span>
                                @elseif($order->status === 'Pending')
                                    <span class="px-2.5 py-1 bg-warning/10 text-warning text-xs font-semibold rounded-full">Pending</span>
                                @elseif($order->status === 'Voided')
                                    <span class="px-2.5 py-1 bg-error/10 text-error text-xs font-semibold rounded-full">Voided</span>
                                @endif
                            </div>
                            <div class="flex items-center justify-between">
                                <p class="text-sm text-warm-gray">{{ $order->items->count() }} item</p>
                                <p class="font-semibold text-dark-roast text-sm">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                            </div>
                            <div class="flex gap-2 mt-3">
                                <button
                                    wire:click="openHistoryDetail({{ $order->id }})"
                                    class="flex-1 h-9 bg-linen text-dark-roast text-xs font-medium rounded-xl hover:bg-sand transition-all duration-200"
                                >
                                    Detail
                                </button>
                                @if($order->status === 'Paid')
                                    <a
                                        href="/receipt/{{ $order->id }}/print"
                                        target="_blank"
                                        class="flex-1 h-9 bg-terracotta text-warm-white text-xs font-medium rounded-xl hover:bg-terracotta-dark transition-all duration-200 flex items-center justify-center gap-1 shadow-sm"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                        </svg>
                                        Cetak
                                    </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12 text-warm-gray">
                            <svg class="w-16 h-16 mx-auto mb-4 text-stone/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <p class="text-base font-medium">Belum ada riwayat</p>
                            <p class="text-sm text-warm-gray/70 mt-1">Transaksi akan muncul di sini</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    @endif

    <!-- History Detail Modal -->
    @if($showHistoryDetailModal && $selectedHistoryOrder)
        <div class="fixed inset-0 z-[60] flex items-center justify-center p-4">
            <div class="fixed inset-0 bg-dark-roast/40 modal-backdrop" wire:click="closeHistoryDetail"></div>
            <div class="relative bg-warm-white rounded-2xl shadow-2xl w-full max-w-lg p-6 animate-scale-in">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold text-dark-roast">Detail Order #{{ $selectedHistoryOrder->order_number }}</h3>
                    <button wire:click="closeHistoryDetail" class="p-2 hover:bg-linen rounded-xl transition-colors">
                        <svg class="w-5 h-5 text-warm-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <p class="text-xs text-warm-gray">Meja</p>
                        <p class="font-medium text-dark-roast text-sm">{{ $selectedHistoryOrder->table?->number ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-warm-gray">Waktu</p>
                        <p class="font-medium text-dark-roast text-sm">{{ $selectedHistoryOrder->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-warm-gray">Pembayaran</p>
                        <p class="font-medium text-dark-roast text-sm">{{ $selectedHistoryOrder->payment_method }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-warm-gray">Status</p>
                        <p class="font-medium text-dark-roast text-sm">{{ $selectedHistoryOrder->status }}</p>
                    </div>
                </div>

                <div class="border-t border-sand pt-4">
                    <p class="text-sm font-semibold text-dark-roast mb-2">Item</p>
                    <div class="space-y-2 max-h-48 overflow-y-auto">
                        @foreach($selectedHistoryOrder->items as $item)
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-warm-gray">{{ $item->product?->name ?? 'Produk dihapus' }} x {{ $item->qty }}</span>
                                <span class="font-medium text-dark-roast">Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="border-t border-sand mt-4 pt-4">
                    <div class="flex items-center justify-between">
                        <span class="text-base font-semibold text-dark-roast">Total</span>
                        <span class="text-base font-semibold text-dark-roast">Rp {{ number_format($selectedHistoryOrder->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>

                @if($selectedHistoryOrder->status === 'Paid')
                    <div class="flex gap-3 mt-6">
                        <a
                            href="/receipt/{{ $selectedHistoryOrder->id }}/download"
                            class="flex-1 h-12 bg-dark-roast hover:bg-dark-roast/90 text-warm-white font-medium rounded-xl transition-all duration-200 flex items-center justify-center gap-2 shadow-md btn-press"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Download Struk
                        </a>
                        <a
                            href="/receipt/{{ $selectedHistoryOrder->id }}/print"
                            target="_blank"
                            class="flex-1 h-12 bg-terracotta hover:bg-terracotta-dark text-warm-white font-medium rounded-xl transition-all duration-200 flex items-center justify-center gap-2 shadow-md btn-press"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                            </svg>
                            Cetak Struk
                        </a>
                    </div>
                @endif
            </div>
        </div>
    @endif

</div>