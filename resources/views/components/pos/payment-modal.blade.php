@if($showPaymentModal)
    <div
        x-data="{}"
        x-show="$wire.showPaymentModal"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center p-4"
    >
        <div class="fixed inset-0 bg-navy/60 backdrop-blur-sm"></div>
        <div
            x-show="$wire.showPaymentModal"
            x-transition:enter="transition ease-out duration-250"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg p-6"
        >
            <!-- Header -->
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-xl font-bold text-navy font-heading">Pembayaran</h3>
                    @if($selectedTableNumber)
                        <p class="text-sm text-slate">Meja {{ $selectedTableNumber }}</p>
                    @endif
                </div>
                <button wire:click="closePaymentModal" class="p-2 hover:bg-slate-100 rounded-lg transition-all">
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
                        class="px-4 py-4 rounded-xl border-2 text-sm font-semibold transition-all flex flex-col items-center gap-2 @if($paymentMethod === 'Tunai') border-navy bg-navy/5 text-navy @else border-slate-200 text-slate hover:border-navy/50 hover:bg-navy/5 @endif"
                    >
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Tunai
                    </button>
                    <button
                        wire:click="$set('paymentMethod', 'Midtrans')"
                        class="px-4 py-4 rounded-xl border-2 text-sm font-semibold transition-all flex flex-col items-center gap-2 @if($paymentMethod === 'Midtrans') border-navy bg-navy/5 text-navy @else border-slate-200 text-slate hover:border-navy/50 hover:bg-navy/5 @endif"
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
                        class="w-full h-14 px-4 border-2 border-slate-200 rounded-xl text-xl font-bold focus:outline-none focus:border-navy transition-all"
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
                                class="px-3 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-lg transition-all hover:scale-105 active:scale-95"
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
                        class="flex-1 h-14 bg-success hover:bg-success/90 text-white font-bold rounded-xl transition-all disabled:bg-slate-300 disabled:cursor-not-allowed flex items-center justify-center gap-2"
                    >
                        <span wire:loading.remove wire:target="processPayment">Bayar Tunai</span>
                        <span wire:loading wire:target="processPayment" class="flex items-center gap-2">
                            <span class="spinner"></span>
                            Memproses...
                        </span>
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
                        class="flex-1 h-14 bg-info hover:bg-info/90 text-white font-bold rounded-xl transition-all flex items-center justify-center disabled:opacity-70 disabled:cursor-not-allowed gap-2"
                    >
                        <span wire:loading.remove wire:target="processPayment">Bayar Midtrans</span>
                        <span wire:loading wire:target="processPayment" class="flex items-center gap-2">
                            <span class="spinner"></span>
                            Memproses...
                        </span>
                    </button>
                </div>
            @endif
        </div>
    </div>
@endif
