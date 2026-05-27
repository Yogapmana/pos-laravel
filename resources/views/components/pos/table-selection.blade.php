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
                class="flex-shrink-0 px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-200 hover:scale-105 active:scale-95 @if($table->id === $selectedTableId) bg-success text-white shadow-md @elseif($table->status === 'occupied') bg-slate-200 text-slate-400 cursor-not-allowed @else bg-slate-50 text-navy hover:bg-slate-100 border-2 border-slate-200 shadow-sm @endif"
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
