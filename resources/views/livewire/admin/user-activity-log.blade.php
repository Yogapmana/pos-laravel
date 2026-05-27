<div>
    <!-- Page Header -->
    <div class="bg-white rounded-xl border border-slate-200 p-6 mb-6">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div>
                <h3 class="text-lg font-bold text-navy">Filter Log</h3>
                <p class="text-sm text-slate mt-1">Cari aktivitas pengguna</p>
            </div>
            <div class="flex items-center gap-3">
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Cari aktivitas..."
                    class="h-10 px-4 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-2 focus:border-navy"
                >
                <select
                    wire:model.live="filterAction"
                    class="h-10 px-3 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-2 focus:border-navy"
                >
                    <option value="">Semua Aksi</option>
                    <option value="created">Created</option>
                    <option value="updated">Updated</option>
                    <option value="deleted">Deleted</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Activity Log Table -->
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate uppercase tracking-wide">Waktu</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate uppercase tracking-wide">Pengguna</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate uppercase tracking-wide">Aksi</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate uppercase tracking-wide">Deskripsi</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate uppercase tracking-wide">IP Address</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($logs as $log)
                    <tr class="hover:bg-slate-50/50">
                        <td class="px-6 py-4 text-sm text-slate">{{ $log->created_at->format('d M Y, H:i') }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-navy rounded-full flex items-center justify-center text-white text-xs font-bold">
                                    {{ strtoupper(substr($log->user?->name ?? 'U', 0, 1)) }}
                                </div>
                                <span class="text-sm font-medium text-navy">{{ $log->user?->name ?? 'Unknown' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full {{ $this->getActionColor($log->action) }}">
                                {{ ucfirst($log->action) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-navy">{{ $log->description }}</td>
                        <td class="px-6 py-4 text-sm text-slate">{{ $log->ip_address ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate">
                            <svg class="w-12 h-12 mx-auto mb-3 text-slate/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <p>Belum ada aktivitas</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>