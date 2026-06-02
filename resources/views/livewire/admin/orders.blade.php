<div>
    <!-- Page Header -->
    <div class="bg-white rounded-xl border border-slate-200 p-6 mb-6">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h3 class="text-lg font-bold text-navy">Filter Order</h3>
                <p class="text-sm text-slate mt-1">Cari dan kelola order</p>
            </div>
            <div class="flex items-center gap-3">
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Cari order number..."
                    class="h-10 px-4 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-2 focus:border-navy"
                >
                <input
                    type="date"
                    wire:model.live="filterDate"
                    class="h-10 px-3 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-2 focus:border-navy text-slate-600"
                >
                <select
                    wire:model.live="statusFilter"
                    class="h-10 px-3 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-2 focus:border-navy"
                >
                    <option value="">Semua Status</option>
                    <option value="Paid">Paid</option>
                    <option value="Pending">Pending</option>
                    <option value="Voided">Voided</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate uppercase tracking-wide">Order #</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate uppercase tracking-wide">Meja</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate uppercase tracking-wide">Kasir</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-slate uppercase tracking-wide">Total</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-slate uppercase tracking-wide">Status</th>
                    <th class="px-6 py-3 text-center text-xs font-semibold text-slate uppercase tracking-wide">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($orders as $order)
                    <tr class="hover:bg-slate-50/50">
                        <td class="px-6 py-4 text-sm font-medium text-navy">{{ $order->order_number }}</td>
                        <td class="px-6 py-4 text-sm text-slate">{{ $order->table?->number ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-slate">{{ $order->cashier?->name ?? '-' }}</td>
                        <td class="px-6 py-4 text-right text-sm font-medium text-navy">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-center">
                            @if($order->status === 'Paid')
                                <span class="px-3 py-1 bg-success/10 text-success text-xs font-semibold rounded-full">Paid</span>
                            @elseif($order->status === 'Pending')
                                <span class="px-3 py-1 bg-warning/10 text-warning text-xs font-semibold rounded-full">Pending</span>
                            @elseif($order->status === 'Voided')
                                <span class="px-3 py-1 bg-error/10 text-error text-xs font-semibold rounded-full">Voided</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <button
                                wire:click="openDetail({{ $order->id }})"
                                class="px-3 py-1.5 bg-navy/10 text-navy text-xs font-medium rounded-lg hover:bg-navy/20 transition-all"
                            >
                                Detail
                            </button>
                            @if($order->status === 'Paid')
                                <button
                                    wire:click="voidOrder({{ $order->id }})"
                                    wire:confirm="Yakin ingin membatalkan order {{ $order->order_number }}? Stok akan dikembalikan."
                                    class="px-3 py-1.5 bg-error/10 text-error text-xs font-medium rounded-lg hover:bg-error/20 transition-all ml-1"
                                >
                                    Void
                                </button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate">
                            <svg class="w-12 h-12 mx-auto mb-3 text-slate/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <p>Tidak ada order</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        @if($orders->hasPages())
            <div class="px-6 py-4 border-t border-slate-200 bg-white">
                {{ $orders->links() }}
            </div>
        @endif
    </div>

    <!-- Order Detail Modal -->
    @if($showDetailModal && $selectedOrder)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="fixed inset-0 bg-navy/60 backdrop-blur-sm" wire:click="closeDetail"></div>
            <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-navy">Detail Order #{{ $selectedOrder->order_number }}</h3>
                    <button wire:click="closeDetail" class="p-2 hover:bg-slate-100 rounded-lg transition-colors">
                        <svg class="w-6 h-6 text-slate" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Order Info -->
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <p class="text-xs text-slate">Meja</p>
                        <p class="font-medium text-navy">{{ $selectedOrder->table?->number ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate">Kasir</p>
                        <p class="font-medium text-navy">{{ $selectedOrder->cashier?->name ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate">Pembayaran</p>
                        <p class="font-medium text-navy">{{ $selectedOrder->payment_method }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate">Status</p>
                        <p class="font-medium text-navy">{{ $selectedOrder->status }}</p>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="border-t border-slate-200 pt-4">
                    <p class="text-sm font-semibold text-navy mb-2">Item</p>
                    <div class="space-y-2 max-h-48 overflow-y-auto">
                        @foreach($selectedOrder->items as $item)
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-slate">{{ $item->product?->name ?? 'Produk dihapus' }} x {{ $item->qty }}</span>
                                <span class="font-medium text-navy">Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Total -->
                <div class="border-t border-slate-200 mt-4 pt-4">
                    <div class="flex items-center justify-between">
                        <span class="text-lg font-bold text-navy">Total</span>
                        <span class="text-lg font-bold text-navy">Rp {{ number_format($selectedOrder->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Actions -->
                @if($selectedOrder->status === 'Paid')
                    <div class="flex gap-3 mt-6">
                        <a
                            href="/receipt/{{ $selectedOrder->id }}/download"
                            class="flex-1 h-12 bg-navy hover:bg-navy-800 text-white font-semibold rounded-xl transition-all flex items-center justify-center gap-2"
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Download Struk
                        </a>
                        <button
                            wire:click="voidOrder({{ $selectedOrder->id }})"
                            wire:confirm="Yakin ingin membatalkan order ini? Stok akan dikembalikan."
                            class="flex-1 h-12 bg-error hover:bg-error/90 text-white font-semibold rounded-xl transition-all"
                        >
                            Void / Batalkan
                        </button>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>