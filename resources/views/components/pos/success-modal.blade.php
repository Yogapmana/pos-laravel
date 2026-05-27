@if($showSuccessModal)
    <div
        x-show="$wire.showSuccessModal"
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
            x-show="$wire.showSuccessModal"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md p-8 text-center"
        >
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
