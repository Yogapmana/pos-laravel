<div>
    <div class="h-screen flex flex-col">

        <!-- Header -->
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

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="mx-6 mt-4 p-4 bg-success/10 border border-success/20 rounded-lg flex items-center gap-3">
                <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-sm text-success font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="mx-6 mt-4 p-4 bg-error/10 border border-error/20 rounded-lg flex items-center gap-3">
                <svg class="w-5 h-5 text-error" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-sm text-error font-medium">{{ session('error') }}</span>
            </div>
        @endif

        <div class="flex flex-1 overflow-hidden">

            <!-- Left Panel - Tables & Products -->
            <div class="flex-1 flex flex-col overflow-hidden">

                <!-- Table Selection -->
                <div class="bg-slate-100 border-b border-slate-200 p-4">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-sm font-semibold text-navy">Pilih Meja</h3>
                        @if($selectedTableNumber)
                            <span class="px-3 py-1 bg-success text-white text-xs font-semibold rounded-full">
                                Meja {{ $selectedTableNumber }} Selected
                            </span>
                        @endif
                    </div>
                    <div class="flex gap-2 overflow-x-auto pb-2">
                        @forelse($tables as $table)
                            <button
                                wire:click="selectTable({{ $table->id }})"
                                @if($table->status === 'occupied' && $table->id !== $selectedTableId) disabled @endif
                                class="flex-shrink-0 px-4 py-2 rounded-xl text-sm font-semibold transition-all @if($table->id === $selectedTableId) bg-success text-white shadow-md @elseif($table->status === 'occupied') bg-slate-200 text-slate-400 cursor-not-allowed @else bg-slate-50 text-navy hover:bg-slate-100 border-2 border-slate-200 shadow-sm @endif"
                            >
                                <div class="text-base font-bold">{{ $table->number }}</div>
                                <div class="text-xs @if($table->id === $selectedTableId) text-white/80 @else text-slate-400 @endif">
                                    {{ $table->capacity }} orang
                                </div>
                                @if($table->status === 'occupied') <div class="text-[10px] text-warning mt-0.5">Terisi</div> @endif
                            </button>
                        @empty
                            <div class="text-center py-8 text-slate w-full">
                                <p>Belum ada meja. Tambahkan di halaman admin.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Category Filter -->
                <div class="bg-slate-100 border-b border-slate-200 px-4 py-3">
                    <div class="flex gap-2 flex-wrap">
                        <button
                            wire:click="$set('selectedCategoryId', '')"
                            class="px-4 py-2 rounded-full text-sm font-medium transition-all @if($selectedCategoryId === '') bg-navy text-white @else bg-slate-100 text-slate-700 hover:bg-slate-200 @endif"
                        >
                            Semua
                        </button>
                        @foreach($categories as $category)
                            <button
                                wire:click="$set('selectedCategoryId', {{ $category->id }})"
                                class="px-4 py-2 rounded-full text-sm font-medium transition-all @if($selectedCategoryId === $category->id) bg-navy text-white @else bg-slate-100 text-slate-700 hover:bg-slate-200 @endif"
                            >
                                {{ $category->name }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Search -->
                <div class="bg-slate-100 border-b border-slate-200 px-4 py-3">
                    <div class="relative">
                        <input
                            type="text"
                            wire:model.live.debounce.300ms="searchQuery"
                            placeholder="Cari menu..."
                            class="w-full h-10 pl-10 pr-4 bg-slate-50 border-2 border-slate-200 rounded-lg text-sm focus:outline-none focus:border-navy focus:ring-2 focus:ring-navy/10"
                        >
                        <svg class="w-4 h-4 text-slate absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="flex-1 overflow-y-auto p-4 bg-slate-100">
                    @if($products and count($products) > 0)
                        <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
                            @foreach($products as $product)
                                <div
                                    wire:click="addToCart({{ $product->id }})"
                                    wire:loading.class="opacity-60 pointer-events-none"
                                    wire:target="addToCart({{ $product->id }})"
                                    class="group bg-slate-50 rounded-xl border-2 border-slate-200 overflow-hidden cursor-pointer hover:shadow-lg hover:border-navy/50 transition-all duration-200 @if($product->stock <= 0) opacity-50 pointer-events-none @endif"
                                >
                                    <!-- Product Image -->
                                    <div class="relative aspect-[4/3] bg-slate-100 overflow-hidden">
                                        @if($product->image)
                                            <img
                                                src="{{ asset('storage/' . $product->image) }}"
                                                alt="{{ $product->name }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                            >
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                        <!-- Stock Badge -->
                                        @if($product->stock <= 5 && $product->stock > 0)
                                            <span class="absolute top-2 right-2 px-2 py-0.5 bg-warning text-white text-xs font-bold rounded-full shadow-sm">Sisa {{ $product->stock }}</span>
                                        @elseif($product->stock <= 0)
                                            <div class="absolute inset-0 bg-navy/40 flex items-center justify-center">
                                                <span class="px-3 py-1 bg-error text-white text-sm font-bold rounded-full">Habis</span>
                                            </div>
                                        @endif
                                        <!-- Category Badge -->
                                        <span class="absolute top-2 left-2 px-2 py-0.5 bg-white/90 backdrop-blur-sm text-slate-600 text-xs font-semibold rounded-full shadow-sm">
                                            {{ $product->category->name ?? '-' }}
                                        </span>
                                    </div>
                                    <!-- Product Info -->
                                    <div class="p-4">
                                        <h3 class="font-semibold text-navy text-base leading-tight line-clamp-1">{{ $product->name }}</h3>
                                        <div class="flex items-center justify-between mt-2">
                                            <p class="text-navy font-bold text-base">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                            @if($product->stock > 0)
                                                <div class="w-8 h-8 bg-navy rounded-lg flex items-center justify-center group-hover:bg-success transition-colors duration-200">
                                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        <div class="text-center py-16 text-slate">
                            <svg class="w-16 h-16 mx-auto mb-4 text-slate/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            <p class="text-lg font-medium">Tidak ada produk</p>
                            <p class="text-sm text-slate/60 mt-1">Tambahkan produk di halaman Admin</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right Panel - Cart -->
            <div class="w-[400px] bg-white border-l-2 border-slate-200 flex flex-col">

                <!-- Cart Header -->
                <div class="p-4 border-b border-slate-200 bg-slate-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-navy rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-base font-bold text-navy">Keranjang</h2>
                                @if($selectedTableNumber)
                                    <p class="text-xs text-slate">Meja {{ $selectedTableNumber }}</p>
                                @endif
                            </div>
                        </div>
                        @if(count($cart) > 0)
                            <button wire:click="clearCart" class="text-base text-error hover:text-error/80 flex items-center gap-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                <div class="bg-white rounded-xl p-3 border-2 border-slate-200">
                                    <div class="flex items-start gap-3 mb-3">
                                        <!-- Cart item thumbnail -->
                                        @if(isset($item['image']) && $item['image'])
                                            <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="w-12 h-12 rounded-lg object-cover flex-shrink-0 border border-slate-200">
                                        @else
                                            <div class="w-12 h-12 rounded-lg bg-slate-200 flex items-center justify-center flex-shrink-0">
                                                <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-semibold text-navy text-base leading-tight truncate">{{ $item['name'] }}</h4>
                                            <p class="text-sm text-slate">Rp {{ number_format($item['price'], 0, ',', '.') }} x {{ $item['qty'] }}</p>
                                            @if(isset($notes[$id]) && $notes[$id] !== '')
                                                <p class="text-sm text-sage italic mt-0.5">📝 {{ $notes[$id] }}</p>
                                            @endif
                                        </div>
                                        <button wire:click="removeFromCart({{ $id }})" class="p-2 hover:bg-error/10 rounded transition-colors flex-shrink-0">
                                            <svg class="w-5 h-5 text-error" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>

                                    <!-- Quantity Controls -->
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <button
                                                wire:click="decrementQty({{ $id }})"
                                                class="w-9 h-9 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate hover:bg-slate-100 transition-colors font-bold text-lg"
                                            >
                                                -
                                            </button>
                                            <span class="w-12 text-center font-bold text-navy text-lg">{{ $item['qty'] }}</span>
                                            <button
                                                wire:click="incrementQty({{ $id }})"
                                                class="w-9 h-9 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate hover:bg-slate-100 transition-colors font-bold text-lg"
                                            >
                                                +
                                            </button>
                                        </div>
                                        <span class="font-semibold text-navy text-base">Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}</span>
                                    </div>

                                    <!-- Note Input -->
                                    <div class="mt-2">
                                        <input
                                            type="text"
                                            wire:model.blur="notes.{{ $id }}"
                                            placeholder="Catatan (opsional)..."
                                            class="w-full h-7 px-2 bg-white border-2 border-slate-200 rounded-md text-xs text-slate-600 focus:outline-none focus:border-navy placeholder:text-slate-300"
                                        >
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 text-slate">
                            <svg class="w-12 h-12 mx-auto mb-3 text-slate/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <p class="text-sm font-medium">Keranjang Kosong</p>
                            <p class="text-xs text-slate/60 mt-1">Pilih meja dan tambahkan menu</p>
                        </div>
                    @endif
                </div>

                <!-- Billing & Pay Button -->
                <div class="border-t border-slate-200 p-4 bg-slate-100">
                    <!-- Billing Summary -->
                    <div class="space-y-2 mb-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-slate">Subtotal</span>
                            <span class="font-medium text-navy">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate">PPN (11%)</span>
                            <span class="font-medium text-navy">Rp {{ number_format($tax, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-base font-bold border-t border-slate-200 pt-2">
                            <span class="text-navy">Total</span>
                            <span class="text-navy">Rp {{ number_format($grandTotal, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Pay Button -->
                    @if(count($cart) > 0)
                        <button
                            wire:click="openPaymentModal"
                            class="w-full h-12 bg-success hover:bg-success/90 text-white font-bold rounded-xl transition-all text-base shadow-md hover:shadow-lg flex items-center justify-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                            Bayar Sekarang
                        </button>
                    @else
                        <button disabled class="w-full h-12 bg-slate-200 text-slate-400 font-bold rounded-xl text-base cursor-not-allowed flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                            Bayar Sekarang
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Modal -->
    @if($showPaymentModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4" x-data="{}">
            <div class="fixed inset-0 bg-navy/60 backdrop-blur-sm"></div>
            <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg p-6">
                <!-- Header -->
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-navy font-heading">Pembayaran</h3>
                        @if($selectedTableNumber)
                            <p class="text-sm text-slate">Meja {{ $selectedTableNumber }}</p>
                        @endif
                    </div>
                    <button wire:click="closePaymentModal" class="p-2 hover:bg-slate-100 rounded-lg transition-colors">
                        <svg class="w-6 h-6 text-slate" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Total Due -->
                <div class="bg-navy text-white rounded-xl p-6 mb-6">
                    <p class="text-sm text-white/70 mb-1">Total yang harus dibayar</p>
                    <p class="text-3xl font-bold font-heading">Rp {{ number_format($grandTotal, 0, ',', '.') }}</p>
                </div>

                <!-- Payment Method Selector -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-navy mb-3">Metode Pembayaran</label>
                    <div class="grid grid-cols-2 gap-3">
                        <button
                            wire:click="$set('paymentMethod', 'Tunai')"
                            class="px-4 py-4 rounded-xl border-2 text-sm font-semibold transition-all flex flex-col items-center gap-2 @if($paymentMethod === 'Tunai') border-navy bg-navy/5 text-navy @else border-slate-200 text-slate hover:border-navy/50 @endif"
                        >
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Tunai
                        </button>
                        <button
                            wire:click="$set('paymentMethod', 'Midtrans')"
                            class="px-4 py-4 rounded-xl border-2 text-sm font-semibold transition-all flex flex-col items-center gap-2 @if($paymentMethod === 'Midtrans') border-navy bg-navy/5 text-navy @else border-slate-200 text-slate hover:border-navy/50 @endif"
                        >
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                            Midtrans
                        </button>
                    </div>
                </div>

                <!-- Midtrans Error -->
                @if($midtransError)
                    <div class="mb-4 p-3 bg-error/10 border border-error/20 rounded-lg text-sm text-error">
                        {{ $midtransError }}
                    </div>
                @endif

                @if($paymentMethod === 'Tunai')
                    <!-- Cash Payment UI -->
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-navy mb-2">Jumlah Uang (Rp)</label>
                        <input
                            type="text"
                            wire:model.live="paymentAmount"
                            class="w-full h-14 px-4 border-2 border-slate-200 rounded-xl text-xl font-bold focus:outline-none focus:border-navy"
                            placeholder="0"
                        >
                    </div>

                    <!-- Change Display -->
                    @if($change > 0)
                        <div class="mb-4 p-4 bg-success/10 border-2 border-success/30 rounded-xl">
                            <p class="text-sm text-success font-medium">Kembalian</p>
                            <p class="text-2xl font-bold text-success">Rp {{ number_format($change, 0, ',', '.') }}</p>
                        </div>
                    @elseif($paymentAmount && (int) str_replace(['.', ','], '', $paymentAmount) < $grandTotal)
                        <div class="mb-4 p-4 bg-error/10 border-2 border-error/30 rounded-xl text-sm text-error">
                            <strong>Kurang:</strong> Rp {{ number_format($grandTotal - (int) str_replace(['.', ','], '', $paymentAmount), 0, ',', '.') }}
                        </div>
                    @endif

                    <!-- Quick Amount Buttons -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-navy mb-2">Quick Amount</label>
                        <div class="grid grid-cols-4 gap-2">
                            @foreach([50000, 100000, 150000, 200000] as $amount)
                                <button
                                    wire:click="setPaymentAmount({{ $amount }})"
                                    class="px-3 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-lg transition-all"
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
                            class="flex-1 h-14 border-2 border-slate-200 text-slate font-semibold rounded-xl hover:bg-slate-50 transition-all"
                        >
                            Batal
                        </button>
                        <button
                            wire:click="processPayment"
                            wire:loading.attr="disabled"
                            wire:target="processPayment"
                            @if(!$isValidPayment) disabled @endif
                            class="flex-1 h-14 bg-success hover:bg-success/90 text-white font-bold rounded-xl transition-all disabled:bg-slate-300 disabled:cursor-not-allowed flex items-center justify-center"
                        >
                            <span wire:loading.remove wire:target="processPayment">Bayar Tunai</span>
                            <span wire:loading wire:target="processPayment">Memproses...</span>
                        </button>
                    </div>
                @else
                    <!-- Midtrans Payment UI -->
                    <div class="bg-info/10 border-2 border-info/30 rounded-xl p-4 mb-6">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-info mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <p class="font-medium text-info">Pembayaran dengan Midtrans</p>
                                <p class="text-sm text-info/80 mt-1">Anda akan dialihkan ke halaman pembayaran Midtrans.</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <button
                            type="button"
                            wire:click="closePaymentModal"
                            class="flex-1 h-14 border-2 border-slate-200 text-slate font-semibold rounded-xl hover:bg-slate-50 transition-all"
                        >
                            Batal
                        </button>
                        <button
                            wire:click="processPayment"
                            wire:loading.attr="disabled"
                            wire:target="processPayment"
                            class="flex-1 h-14 bg-info hover:bg-info/90 text-white font-bold rounded-xl transition-all flex items-center justify-center disabled:opacity-70 disabled:cursor-not-allowed"
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
            <div class="fixed inset-0 bg-navy/60 backdrop-blur-sm"></div>
            <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md p-8 text-center">
                <div class="w-20 h-20 bg-success/10 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>

                <h3 class="text-2xl font-bold text-navy font-heading mb-2">Pembayaran Berhasil!</h3>
                <p class="text-slate mb-4">Order #{{ $lastOrderNumber }}</p>

                <div class="bg-slate-50 rounded-xl p-6 mb-6">
                    <p class="text-sm text-slate mb-1">Total Bayar</p>
                    <p class="text-3xl font-bold text-navy font-heading">Rp {{ number_format($lastOrderTotal, 0, ',', '.') }}</p>
                </div>

                <div class="flex flex-col gap-3">
                    <a
                        href="/receipt/{{ $lastOrderId }}/download"
                        class="w-full h-14 bg-navy hover:bg-navy-800 text-white font-bold rounded-xl transition-all flex items-center justify-center gap-2"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Download Struk
                    </a>
                    <button
                        wire:click="newTransaction"
                        class="w-full h-14 border-2 border-slate-200 text-slate font-semibold rounded-xl hover:bg-slate-50 transition-all"
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
            <div class="fixed inset-0 bg-navy/60 backdrop-blur-sm" wire:click="toggleOrderHistory"></div>
            <div class="relative ml-auto w-[450px] bg-white shadow-2xl flex flex-col h-full">
                <!-- Header -->
                <div class="p-5 border-b border-slate-200 bg-slate-50 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-navy">Riwayat Transaksi</h3>
                        <p class="text-sm text-slate">{{ auth()->user()->name }}</p>
                    </div>
                    <button wire:click="toggleOrderHistory" class="p-2 hover:bg-slate-100 rounded-lg transition-colors">
                        <svg class="w-5 h-5 text-slate" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- History List -->
                <div class="flex-1 overflow-y-auto p-4 space-y-3">
                    @forelse($orderHistory as $order)
                        <div class="bg-slate-50 rounded-xl p-4 border border-slate-200">
                            <div class="flex items-center justify-between mb-2">
                                <div>
                                    <p class="font-semibold text-navy">{{ $order->order_number }}</p>
                                    <p class="text-xs text-slate">Meja {{ $order->table?->number ?? '-' }} • {{ $order->created_at->format('d M Y, H:i') }}</p>
                                </div>
                                @if($order->status === 'Paid')
                                    <span class="px-2.5 py-1 bg-success/10 text-success text-xs font-semibold rounded-full">Paid</span>
                                @elseif($order->status === 'Pending')
                                    <span class="px-2.5 py-1 bg-warning/10 text-warning text-xs font-semibold rounded-full">Pending</span>
                                @elseif($order->status === 'Voided')
                                    <span class="px-2.5 py-1 bg-error/10 text-error text-xs font-semibold rounded-full">Voided</span>
                                @endif
                            </div>
                            <div class="flex items-center justify-between">
                                <p class="text-sm text-slate">{{ $order->items->count() }} item</p>
                                <p class="font-semibold text-navy">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                            </div>
                            <div class="flex gap-2 mt-3">
                                <button
                                    wire:click="openHistoryDetail({{ $order->id }})"
                                    class="flex-1 h-9 bg-navy/10 text-navy text-xs font-medium rounded-lg hover:bg-navy/20 transition-all"
                                >
                                    Detail
                                </button>
                                @if($order->status === 'Paid')
                                    <a
                                        href="/receipt/{{ $order->id }}/print"
                                        target="_blank"
                                        class="flex-1 h-9 bg-sage text-white text-xs font-medium rounded-lg hover:bg-sage/90 transition-all flex items-center justify-center gap-1"
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
                        <div class="text-center py-12 text-slate">
                            <svg class="w-16 h-16 mx-auto mb-4 text-slate/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <p class="text-base font-medium">Belum ada riwayat</p>
                            <p class="text-sm text-slate/60 mt-1">Transaksi akan muncul di sini</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    @endif

    <!-- History Detail Modal -->
    @if($showHistoryDetailModal && $selectedHistoryOrder)
        <div class="fixed inset-0 z-[60] flex items-center justify-center p-4">
            <div class="fixed inset-0 bg-navy/60 backdrop-blur-sm" wire:click="closeHistoryDetail"></div>
            <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-navy">Detail Order #{{ $selectedHistoryOrder->order_number }}</h3>
                    <button wire:click="closeHistoryDetail" class="p-2 hover:bg-slate-100 rounded-lg transition-colors">
                        <svg class="w-6 h-6 text-slate" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <p class="text-xs text-slate">Meja</p>
                        <p class="font-medium text-navy">{{ $selectedHistoryOrder->table?->number ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate">Waktu</p>
                        <p class="font-medium text-navy">{{ $selectedHistoryOrder->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate">Pembayaran</p>
                        <p class="font-medium text-navy">{{ $selectedHistoryOrder->payment_method }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate">Status</p>
                        <p class="font-medium text-navy">{{ $selectedHistoryOrder->status }}</p>
                    </div>
                </div>

                <div class="border-t border-slate-200 pt-4">
                    <p class="text-sm font-semibold text-navy mb-2">Item</p>
                    <div class="space-y-2 max-h-48 overflow-y-auto">
                        @foreach($selectedHistoryOrder->items as $item)
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-slate">{{ $item->product?->name ?? 'Produk dihapus' }} x {{ $item->qty }}</span>
                                <span class="font-medium text-navy">Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="border-t border-slate-200 mt-4 pt-4">
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-bold text-navy">Total</span>
                        <span class="text-lg font-bold text-navy">Rp {{ number_format($selectedHistoryOrder->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>

                @if($selectedHistoryOrder->status === 'Paid')
                    <div class="flex gap-3 mt-6">
                        <a
                            href="/receipt/{{ $selectedHistoryOrder->id }}/download"
                            class="flex-1 h-12 bg-navy hover:bg-navy-800 text-white font-semibold rounded-xl transition-all flex items-center justify-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Download Struk
                        </a>
                        <a
                            href="/receipt/{{ $selectedHistoryOrder->id }}/print"
                            target="_blank"
                            class="flex-1 h-12 bg-sage hover:bg-sage/90 text-white font-semibold rounded-xl transition-all flex items-center justify-center gap-2"
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