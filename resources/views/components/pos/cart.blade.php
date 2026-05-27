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
                                    class="w-9 h-9 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate hover:bg-slate-100 transition-all duration-150 hover:scale-105 active:scale-95 font-bold text-lg"
                                >
                                    -
                                </button>
                                <span class="w-12 text-center font-bold text-navy text-lg">{{ $item['qty'] }}</span>
                                <button
                                    wire:click="incrementQty({{ $id }})"
                                    class="w-9 h-9 bg-white border border-slate-200 rounded-lg flex items-center justify-center text-slate hover:bg-slate-100 transition-all duration-150 hover:scale-105 active:scale-95 font-bold text-lg"
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
