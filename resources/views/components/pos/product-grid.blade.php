<!-- Category Filter -->
<div class="bg-slate-100 border-b border-slate-200 px-4 py-3">
    <div class="flex gap-2 flex-wrap">
        <button
            wire:click="$set('selectedCategoryId', '')"
            class="px-4 py-2 rounded-full text-sm font-medium transition-all @if($selectedCategoryId === '') bg-navy text-white @else bg-slate-100 text-slate-700 hover:bg-slate-200 @endif"
        >
            Semua
        </button>
        @foreach($categories as $category)
            <button
                wire:click="$set('selectedCategoryId', {{ $category->id }})"
                class="px-4 py-2 rounded-full text-sm font-medium transition-all @if($selectedCategoryId === $category->id) bg-navy text-white @else bg-slate-100 text-slate-700 hover:bg-slate-200 @endif"
            >
                {{ $category->name }}
            </button>
        @endforeach
    </div>
</div>

<!-- Search -->
<div class="bg-slate-100 border-b border-slate-200 px-4 py-3">
    <div class="relative">
        <input
            type="text"
            wire:model.live.debounce.300ms="searchQuery"
            placeholder="Cari menu..."
            class="w-full h-10 pl-10 pr-4 bg-slate-50 border-2 border-slate-200 rounded-lg text-sm focus:outline-none focus:border-navy focus:ring-2 focus:ring-navy/10"
        >
        <svg class="w-4 h-4 text-slate absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
    </div>
</div>

<!-- Products Grid -->
<div class="flex-1 overflow-y-auto p-4 bg-slate-100">
    @if($products and count($products) > 0)
        <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
            @foreach($products as $product)
                <div
                    wire:click="addToCart({{ $product->id }})"
                    wire:loading.class="opacity-60 pointer-events-none"
                    wire:target="addToCart({{ $product->id }})"
                    x-data="{ added: false }"
                    x-on:add-to-cart-{{ $product->id }}.window="added = true; setTimeout(() => added = false, 200)"
                    :class="added ? 'animate-pulse-once' : ''"
                    class="group bg-slate-50 rounded-xl border-2 border-slate-200 overflow-hidden cursor-pointer hover:shadow-lg hover:border-navy/50 transition-all duration-200 @if($product->stock <= 0) opacity-50 pointer-events-none @endif"
                >
                    <!-- Product Image -->
                    <div class="relative aspect-[4/3] bg-slate-100 overflow-hidden">
                        @if($product->image)
                            <img
                                src="{{ asset('storage/' . $product->image) }}"
                                alt="{{ $product->name }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                            >
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                        <!-- Stock Badge -->
                        @if($product->stock <= 5 && $product->stock > 0)
                            <span class="absolute top-2 right-2 px-2 py-0.5 bg-warning text-white text-xs font-bold rounded-full shadow-sm">Sisa {{ $product->stock }}</span>
                        @elseif($product->stock <= 0)
                            <div class="absolute inset-0 bg-navy/40 flex items-center justify-center">
                                <span class="px-3 py-1 bg-error text-white text-sm font-bold rounded-full">Habis</span>
                            </div>
                        @endif
                        <!-- Category Badge -->
                        <span class="absolute top-2 left-2 px-2 py-0.5 bg-white/90 backdrop-blur-sm text-slate-600 text-xs font-semibold rounded-full shadow-sm">
                            {{ $product->category->name ?? '-' }}
                        </span>
                    </div>
                    <!-- Product Info -->
                    <div class="p-4">
                        <h3 class="font-semibold text-navy text-base leading-tight line-clamp-1">{{ $product->name }}</h3>
                        <div class="flex items-center justify-between mt-2">
                            <p class="text-navy font-bold text-base">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            @if($product->stock > 0)
                                <div class="w-8 h-8 bg-navy rounded-lg flex items-center justify-center group-hover:bg-success transition-colors duration-200">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-16 text-slate">
            <svg class="w-16 h-16 mx-auto mb-4 text-slate/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
            <p class="text-lg font-medium">Tidak ada produk</p>
            <p class="text-sm text-slate/60 mt-1">Tambahkan produk di halaman Admin</p>
        </div>
    @endif
</div>
