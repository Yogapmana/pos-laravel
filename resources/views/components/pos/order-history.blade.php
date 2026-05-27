<!-- Order History Panel -->
@if($showOrderHistory)
    <div class="fixed inset-0 z-50 flex">
        <div
            x-show="$wire.showOrderHistory"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-navy/60 backdrop-blur-sm"
            wire:click="toggleOrderHistory"
        ></div>
        <div
            x-show="$wire.showOrderHistory"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
            class="relative ml-auto w-[450px] bg-white shadow-2xl flex flex-col h-full"
        >
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
    <div
        x-show="$wire.showHistoryDetailModal"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[60] flex items-center justify-center p-4"
    >
        <div class="fixed inset-0 bg-navy/60 backdrop-blur-sm" wire:click="closeHistoryDetail"></div>
        <div
            x-show="$wire.showHistoryDetailModal"
            x-transition:enter="transition ease-out duration-250"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg p-6"
        >
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
