<div>
    <!-- Page Header -->
    <div class="bg-warm-white rounded-2xl border-2 border-sand p-6 mb-6 shadow-card">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h3 class="text-lg font-semibold text-dark-roast">Filter Laporan</h3>
                <p class="text-sm text-warm-gray mt-1">Pilih periode untuk melihat laporan penjualan</p>
            </div>
            <div class="flex items-center gap-3">
                <div>
                    <label class="block text-xs font-medium text-warm-gray mb-1">Dari Tanggal</label>
                    <input type="date" wire:model.live="startDate" class="h-11 px-4 bg-linen border-2 border-sand rounded-xl text-sm focus:outline-none focus:border-terracotta transition-all">
                </div>
                <div>
                    <label class="block text-xs font-medium text-warm-gray mb-1">Sampai Tanggal</label>
                    <input type="date" wire:model.live="endDate" class="h-11 px-4 bg-linen border-2 border-sand rounded-xl text-sm focus:outline-none focus:border-terracotta transition-all">
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Summary -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-warm-white rounded-2xl border-2 border-sand p-6 shadow-card">
            <p class="text-sm font-medium text-warm-gray">Total Penjualan</p>
            <p class="text-2xl font-bold text-dark-roast mt-1">Rp {{ number_format($totalSales, 0, ',', '.') }}</p>
        </div>
        <div class="bg-warm-white rounded-2xl border-2 border-sand p-6 shadow-card">
            <p class="text-sm font-medium text-warm-gray">Jumlah Order</p>
            <p class="text-2xl font-bold text-dark-roast mt-1">{{ $totalOrders }}</p>
        </div>
        <div class="bg-warm-white rounded-2xl border-2 border-sand p-6 shadow-card">
            <p class="text-sm font-medium text-warm-gray">Rata-rata Order</p>
            <p class="text-2xl font-bold text-dark-roast mt-1">Rp {{ number_format($averageOrder, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Chart -->
    <div class="bg-warm-white rounded-2xl border-2 border-sand p-6 mb-6 shadow-card">
        <h3 class="font-semibold text-dark-roast mb-4">Grafik Penjualan</h3>
        <div class="h-72">
            <canvas id="salesChart"></canvas>
        </div>
    </div>

    <!-- Best Selling Products -->
    @if($bestSellingProducts->count() > 0)
    <div class="bg-warm-white rounded-2xl border-2 border-sand p-6 mb-6 shadow-card">
        <h3 class="font-semibold text-dark-roast mb-4">Produk Terlaris</h3>
        <div class="space-y-3">
            @foreach($bestSellingProducts as $index => $product)
                <div class="flex items-center justify-between p-4 bg-linen rounded-xl">
                    <div class="flex items-center gap-3">
                        <span class="w-8 h-8 bg-terracotta text-white text-sm font-bold rounded-full flex items-center justify-center">{{ $index + 1 }}</span>
                        <div>
                            <p class="font-medium text-dark-roast">{{ $product['name'] }}</p>
                            <p class="text-sm text-warm-gray">{{ $product['total_qty'] }} terjual</p>
                        </div>
                    </div>
                    <p class="font-semibold text-dark-roast">Rp {{ number_format($product['total_revenue'], 0, ',', '.') }}</p>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Daily Sales Table -->
    <div class="bg-warm-white rounded-2xl border-2 border-sand overflow-hidden shadow-card">
        <div class="px-6 py-4 border-b-2 border-sand flex items-center justify-between">
            <h3 class="font-semibold text-dark-roast">Detail Penjualan Harian</h3>
            <div class="flex gap-2">
                <a
                    href="{{ route('admin.reports.export.excel', ['start' => $startDate, 'end' => $endDate]) }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-olive hover:bg-olive-dark text-warm-white text-sm font-medium rounded-xl transition-all duration-200 shadow-sm hover:shadow-md btn-press"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Export Excel
                </a>
                <a
                    href="{{ route('admin.reports.export.pdf', ['start' => $startDate, 'end' => $endDate]) }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-terracotta hover:bg-terracotta-dark text-warm-white text-sm font-medium rounded-xl transition-all duration-200 shadow-sm hover:shadow-md btn-press"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Export PDF
                </a>
            </div>
        </div>

        <table class="w-full">
            <thead class="bg-linen border-b-2 border-sand">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-dark-roast uppercase tracking-wide">Tanggal</th>
                    <th class="px-6 py-4 text-right text-xs font-semibold text-dark-roast uppercase tracking-wide">Jumlah Order</th>
                    <th class="px-6 py-4 text-right text-xs font-semibold text-dark-roast uppercase tracking-wide">Total Penjualan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-sand">
                @forelse($dailySales as $sale)
                    <tr class="hover:bg-linen/50 transition-colors">
                        <td class="px-6 py-4 text-sm text-dark-roast">{{ \Carbon\Carbon::parse($sale->date)->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-right text-sm text-warm-gray">{{ $sale->orders }}</td>
                        <td class="px-6 py-4 text-right font-semibold text-dark-roast">Rp {{ number_format($sale->sales, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center text-warm-gray">
                            <svg class="w-12 h-12 mx-auto mb-3 text-stone/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <p>Tidak ada data penjualan pada periode ini</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('livewire:init', () => {
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesData = @json($chartData ?? ['labels' => [], 'values' => []]);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: salesData.labels,
                datasets: [{
                    label: 'Penjualan',
                    data: salesData.values,
                    backgroundColor: '#C4674A',
                    borderRadius: 8,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        },
                        grid: {
                            color: '#E8E0D5'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    });
</script>
@endpush