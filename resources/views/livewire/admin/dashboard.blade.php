<div>
    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- Today's Sales -->
        <div class="bg-warm-white rounded-2xl border-2 border-sand p-6 shadow-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-warm-gray">Penjualan Hari Ini</p>
                    <p class="text-2xl font-bold text-dark-roast mt-1">Rp {{ number_format($todaySales, 0, ',', '.') }}</p>
                </div>
                <div class="w-12 h-12 bg-olive/10 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-olive" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Today's Orders -->
        <div class="bg-warm-white rounded-2xl border-2 border-sand p-6 shadow-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-warm-gray">Jumlah Order</p>
                    <p class="text-2xl font-bold text-dark-roast mt-1">{{ $todayOrders }} <span class="text-sm font-normal text-warm-gray">order</span></p>
                </div>
                <div class="w-12 h-12 bg-info/10 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-info" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Low Stock Alert -->
        <div class="bg-warm-white rounded-2xl border-2 border-sand p-6 shadow-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-warm-gray">Stok Rendah</p>
                    <p class="text-2xl font-bold text-dark-roast mt-1">{{ $lowStockProducts->count() }} <span class="text-sm font-normal text-warm-gray">produk</span></p>
                </div>
                <div class="w-12 h-12 bg-warning/10 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Weekly Sales Chart -->
    <div class="bg-warm-white rounded-2xl border-2 border-sand p-6 mb-6 shadow-card">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-dark-roast">Penjualan 7 Hari Terakhir</h3>
        </div>
        <div class="h-64 flex items-end justify-between gap-2">
            @foreach($weeklyLabels as $i => $label)
                @php
                    $value = $weeklySales[$i] ?? 0;
                    $max = max($weeklySales) ?: 1;
                    $height = $max > 0 ? ($value / $max * 100) : 0;
                @endphp
                <div class="flex-1 flex flex-col items-center gap-2">
                    <div class="w-full bg-linen rounded-t-lg relative" style="height: 160px; min-height: 4px;">
                        <div class="absolute bottom-0 w-full bg-terracotta rounded-t-lg transition-all hover:bg-terracotta-dark" style="height: {{ $height }}%"></div>
                    </div>
                    <span class="text-xs text-warm-gray font-medium">{{ $label }}</span>
                    <span class="text-xs text-dark-roast font-semibold">Rp {{ number_format($value, 0, ',', '.') }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Low Stock Products -->
        <div class="bg-warm-white rounded-2xl border-2 border-sand p-6 shadow-card">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-dark-roast">Produk Stok Rendah</h3>
                <div class="flex items-center gap-2">
                    <label class="text-xs text-warm-gray">Batas Stok:</label>
                    <input type="number" wire:model.live.debounce.300ms="stockThreshold" class="w-16 h-8 px-2 bg-linen border-2 border-sand rounded-lg text-sm text-center focus:outline-none focus:border-terracotta transition-all" min="0">
                </div>
            </div>
            @if($lowStockProducts->count() > 0)
                <div class="space-y-3">
                    @foreach($lowStockProducts as $product)
                        <div class="flex items-center justify-between p-3 bg-linen rounded-xl">
                            <div>
                                <p class="font-medium text-dark-roast">{{ $product->name }}</p>
                                <p class="text-sm text-warm-gray">{{ $product->category->name ?? '-' }}</p>
                            </div>
                            <span class="px-3 py-1 bg-warning/15 text-warning text-xs font-semibold rounded-full">
                                {{ $product->stock }} left
                            </span>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 text-warm-gray">
                    <svg class="w-12 h-12 mx-auto mb-3 text-olive" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p>Semua produk stoknya aman</p>
                </div>
            @endif
        </div>

        <!-- Recent Orders -->
        <div class="bg-warm-white rounded-2xl border-2 border-sand p-6 shadow-card">
            <h3 class="text-lg font-semibold text-dark-roast mb-4">Order Terbaru</h3>
            @if($recentOrders->count() > 0)
                <div class="space-y-3">
                    @foreach($recentOrders as $order)
                        <div class="flex items-center justify-between p-3 bg-linen rounded-xl">
                            <div>
                                <p class="font-medium text-dark-roast">{{ $order->order_number ?? '#' . $order->id }}</p>
                                <p class="text-sm text-warm-gray">Meja {{ $order->table->number ?? '-' }} • {{ $order->cashier->name ?? '-' }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-dark-roast">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                <span class="text-xs text-warm-gray">{{ $order->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 text-warm-gray">
                    <svg class="w-12 h-12 mx-auto mb-3 text-stone/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                    <p>Belum ada order hari ini</p>
                </div>
            @endif
        </div>
    </div>
</div>