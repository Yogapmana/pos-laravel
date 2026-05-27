<div>
    <!-- Page Header -->
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-4">
            <!-- Search -->
            <div class="relative">
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Cari produk..."
                    class="h-11 pl-11 pr-4 bg-warm-white border-2 border-sand rounded-xl text-sm w-64 focus:outline-none focus:border-terracotta focus:ring-2 focus:ring-terracotta/10 transition-all"
                >
                <svg class="w-4 h-4 text-warm-gray absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>

            <!-- Category Filter -->
            <select
                wire:model.live="categoryFilter"
                class="h-11 px-4 bg-warm-white border-2 border-sand rounded-xl text-sm focus:outline-none focus:border-terracotta transition-all appearance-none cursor-pointer"
                style="background-image: url(&quot;data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%238B7E74' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e&quot;); background-position: right 0.75rem center; background-repeat: no-repeat; background-size: 1.5em 1.5em; padding-right: 2.5rem;"
            >
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Add Button -->
        <button
            wire:click="openModal()"
            class="inline-flex items-center gap-2 px-5 py-2.5 bg-terracotta hover:bg-terracotta-dark text-warm-white text-sm font-medium rounded-xl transition-all duration-200 shadow-md hover:shadow-lg btn-press"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Produk
        </button>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-olive/10 border border-olive/20 rounded-xl flex items-center gap-3 animate-fade-in">
            <svg class="w-5 h-5 text-olive flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-sm text-olive font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Products Table -->
    <div class="bg-warm-white rounded-2xl border-2 border-sand overflow-hidden shadow-card">
        <table class="w-full">
            <thead class="bg-linen border-b border-sand">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-dark-roast uppercase tracking-wide">Produk</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-dark-roast uppercase tracking-wide">Kategori</th>
                    <th class="px-6 py-4 text-right text-xs font-semibold text-dark-roast uppercase tracking-wide">Harga</th>
                    <th class="px-6 py-4 text-center text-xs font-semibold text-dark-roast uppercase tracking-wide">Stok</th>
                    <th class="px-6 py-4 text-center text-xs font-semibold text-dark-roast uppercase tracking-wide">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-sand">
                @forelse($products as $product)
                    <tr class="hover:bg-linen/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-11 h-11 rounded-xl object-cover border-2 border-sand">
                                @else
                                    <div class="w-11 h-11 rounded-xl bg-linen flex items-center justify-center">
                                        <svg class="w-5 h-5 text-stone" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                                <p class="font-medium text-dark-roast">{{ $product->name }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex px-3 py-1.5 bg-linen text-dark-roast text-xs font-medium rounded-full">
                                {{ $product->category->name ?? '-' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right font-semibold text-dark-roast">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($product->stock <= 5)
                                <span class="inline-flex px-3 py-1.5 bg-warning/15 text-warning text-xs font-semibold rounded-full">
                                    {{ $product->stock }}
                                </span>
                            @else
                                <span class="text-warm-gray text-sm">{{ $product->stock }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="inline-flex items-center gap-2">
                                <button wire:click="openModal({{ $product->id }})" class="p-2 hover:bg-linen rounded-xl transition-colors">
                                    <svg class="w-4 h-4 text-warm-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button wire:click="delete({{ $product->id }})" wire:confirm="Yakin hapus produk ini?" class="p-2 hover:bg-error/10 rounded-xl transition-colors">
                                    <svg class="w-4 h-4 text-error/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-warm-gray">
                            <svg class="w-12 h-12 mx-auto mb-3 text-stone/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            <p>Belum ada produk</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        @if($products->hasPages())
            <div class="px-6 py-4 border-t border-sand bg-linen">
                {{ $products->links() }}
            </div>
        @endif
    </div>

    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4" wire:click="closeModal" wire:click.self="closeModal">
            <div class="fixed inset-0 bg-dark-roast/40 modal-backdrop"></div>
            <div class="relative bg-warm-white rounded-2xl shadow-2xl w-full max-w-md p-6 max-h-[90vh] overflow-y-auto animate-scale-in" wire:click.stop>
                <h3 class="text-lg font-semibold text-dark-roast mb-6 tracking-tight">
                    {{ $editingId ? 'Edit Produk' : 'Tambah Produk' }}
                </h3>

                <form wire:submit="save" enctype="multipart/form-data">
                    <div class="space-y-4">
                        <!-- Image Upload -->
                        <div>
                            <label class="block text-sm font-medium text-dark-roast mb-1.5">Gambar Produk</label>
                            <div class="flex items-center gap-4">
                                <!-- Preview -->
                                <div class="w-20 h-20 rounded-xl border-2 border-dashed border-sand flex items-center justify-center overflow-hidden bg-linen flex-shrink-0">
                                    @if($image)
                                        <img src="{{ $image->temporaryUrl() }}" class="w-full h-full object-cover rounded-xl">
                                    @elseif($existingImage)
                                        <img src="{{ asset('storage/' . $existingImage) }}" class="w-full h-full object-cover rounded-xl">
                                    @else
                                        <svg class="w-8 h-8 text-stone" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <label class="cursor-pointer inline-flex items-center gap-2 px-3 py-2 bg-linen hover:bg-sand text-dark-roast text-xs font-medium rounded-lg transition-all duration-200 relative z-50">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                        </svg>
                                        Upload Gambar
                                        <input type="file" wire:model="image" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                    </label>
                                    @if($image || $existingImage)
                                        <button type="button" wire:click="removeImage" class="ml-2 text-xs text-error hover:text-error/80">Hapus</button>
                                    @endif
                                    <p class="text-xs text-warm-gray mt-1">JPG, PNG. Max 2MB.</p>
                                    @error('image') <span class="text-xs text-error mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <!-- Loading indicator for image upload -->
                            <div wire:loading wire:target="image" class="mt-2 text-xs text-info flex items-center gap-1">
                                <svg class="animate-spin w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                </svg>
                                Mengupload gambar...
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-dark-roast mb-1.5">Nama Produk</label>
                            <input type="text" wire:model="name" class="w-full h-11 px-4 bg-warm-white border-2 border-sand rounded-xl text-sm focus:outline-none focus:border-terracotta focus:ring-2 focus:ring-terracotta/10 transition-all @error('name') border-error @enderror" placeholder="Masukkan nama produk">
                            @error('name') <span class="text-xs text-error mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-dark-roast mb-1.5">Kategori</label>
                            <select wire:model="category_id" class="w-full h-11 px-4 bg-warm-white border-2 border-sand rounded-xl text-sm focus:outline-none focus:border-terracotta transition-all @error('category_id') border-error @enderror appearance-none cursor-pointer" style="background-image: url(&quot;data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%238B7E74' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e&quot;); background-position: right 0.75rem center; background-repeat: no-repeat; background-size: 1.5em 1.5em; padding-right: 2.5rem;">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <span class="text-xs text-error mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-dark-roast mb-1.5">Harga</label>
                                <input type="number" wire:model="price" class="w-full h-11 px-4 bg-warm-white border-2 border-sand rounded-xl text-sm focus:outline-none focus:border-terracotta focus:ring-2 focus:ring-terracotta/10 transition-all @error('price') border-error @enderror" placeholder="0">
                                @error('price') <span class="text-xs text-error mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-dark-roast mb-1.5">Stok</label>
                                <input type="number" wire:model="stock" class="w-full h-11 px-4 bg-warm-white border-2 border-sand rounded-xl text-sm focus:outline-none focus:border-terracotta focus:ring-2 focus:ring-terracotta/10 transition-all @error('stock') border-error @enderror" placeholder="0">
                                @error('stock') <span class="text-xs text-error mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 mt-6">
                        <button type="button" wire:click="closeModal" class="flex-1 h-11 border-2 border-sand text-warm-gray font-medium rounded-xl hover:bg-linen transition-all duration-200">
                            Batal
                        </button>
                        <button type="submit" wire:loading.attr="disabled" class="flex-1 h-11 bg-terracotta hover:bg-terracotta-dark text-warm-white font-semibold rounded-xl transition-all duration-200 disabled:bg-sand disabled:text-warm-gray flex items-center justify-center gap-2 btn-press">
                            <span wire:loading.remove wire:target="save">Simpan</span>
                            <span wire:loading wire:target="save">Menyimpan...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>