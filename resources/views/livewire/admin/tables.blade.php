<div>
    <!-- Page Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-sm text-slate">Total {{ $tables->count() }} meja</p>
        </div>
        <button
            wire:click="openModal()"
            class="inline-flex items-center gap-2 px-4 py-2.5 bg-navy hover:bg-navy-800 text-white text-sm font-semibold rounded-lg transition-all"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Meja
        </button>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-success/10 border border-success/20 rounded-lg flex items-center gap-3">
            <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-sm text-success">{{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div class="mb-6 p-4 bg-error/10 border border-error/20 rounded-lg flex items-center gap-3">
            <svg class="w-5 h-5 text-error" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-sm text-error">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Tables Grid -->
    @if($tables->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach($tables as $table)
                <div class="bg-white rounded-xl border @if($table->status === 'occupied') border-warning bg-warning/5 @else border-slate-200 @endif p-4 text-center hover:border-navy/30 transition-all">
                    <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-slate" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <p class="font-bold text-navy text-lg">Meja {{ $table->number }}</p>
                    <p class="text-sm text-slate">{{ $table->capacity }} orang</p>
                    <span class="inline-flex mt-2 px-2.5 py-1 text-xs font-semibold rounded-full @if($table->status === 'available') bg-success/10 text-success @else bg-warning/10 text-warning @endif">
                        {{ $table->status === 'available' ? 'Tersedia' : 'Terisi' }}
                    </span>
                    <div class="flex items-center justify-center gap-1 mt-3">
                        <button wire:click="openModal({{ $table->id }})" class="p-1.5 hover:bg-slate-100 rounded transition-colors">
                            <svg class="w-4 h-4 text-slate" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </button>
                        <button wire:click="delete({{ $table->id }})" wire:confirm="Yakin hapus meja ini?" class="p-1.5 hover:bg-error/10 rounded transition-colors">
                            <svg class="w-4 h-4 text-error" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-xl border border-slate-200 p-12 text-center">
            <svg class="w-12 h-12 mx-auto mb-3 text-slate/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <p class="text-slate">Belum ada meja</p>
            <button wire:click="openModal()" class="mt-4 text-sm text-sage hover:underline">Tambah meja pertama</button>
        </div>
    @endif

    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4" wire:click="closeModal" wire:click.self="closeModal">
            <div class="fixed inset-0 bg-navy/50 backdrop-blur-sm"></div>
            <div class="relative bg-white rounded-xl shadow-lg w-full max-w-sm p-6" wire:click.stop>
                <h3 class="text-lg font-bold text-navy mb-6">
                    {{ $editingId ? 'Edit Meja' : 'Tambah Meja' }}
                </h3>

                <form wire:submit="save">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-navy mb-1.5">Nomor Meja</label>
                            <input type="text" wire:model="number" class="w-full h-11 px-4 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-2 focus:border-navy focus:ring-2 focus:ring-navy/10 @error('number') border-error @enderror" placeholder="01">
                            @error('number') <span class="text-xs text-error mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-navy mb-1.5">Kapasitas (orang)</label>
                            <input type="number" wire:model="capacity" min="1" max="20" class="w-full h-11 px-4 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-2 focus:border-navy focus:ring-2 focus:ring-navy/10 @error('capacity') border-error @enderror" placeholder="4">
                            @error('capacity') <span class="text-xs text-error mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-navy mb-1.5">Status</label>
                            <select wire:model="status" class="w-full h-11 px-4 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-2 focus:border-navy">
                                <option value="available">Tersedia</option>
                                <option value="occupied">Terisi</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 mt-6">
                        <button type="button" wire:click="closeModal" class="flex-1 h-11 border border-slate-200 text-slate font-medium rounded-lg hover:bg-slate-50 transition-all">
                            Batal
                        </button>
                        <button type="submit" wire:loading.attr="disabled" class="flex-1 h-11 bg-navy hover:bg-navy-800 text-white font-semibold rounded-lg transition-all disabled:bg-slate-300 disabled:cursor-not-allowed flex items-center justify-center gap-2">
                            <span wire:loading.remove wire:target="save">Simpan</span>
                            <span wire:loading wire:target="save">Menyimpan...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>