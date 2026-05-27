<div>
    <div class="h-screen flex flex-col">

        <!-- Header -->
        @include('components.pos.header')

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="mx-6 mt-4 p-4 bg-success/10 border border-success/20 rounded-lg flex items-center gap-3">
                <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-sm text-success font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="mx-6 mt-4 p-4 bg-error/10 border border-error/20 rounded-lg flex items-center gap-3">
                <svg class="w-5 h-5 text-error" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-sm text-error font-medium">{{ session('error') }}</span>
            </div>
        @endif

        <div class="flex flex-1 overflow-hidden">

            <!-- Left Panel - Tables & Products -->
            <div class="flex-1 flex flex-col overflow-hidden">
                <!-- Table Selection -->
                @include('components.pos.table-selection')

                <!-- Product Grid (includes Category Filter and Search) -->
                @include('components.pos.product-grid')
            </div>

            <!-- Right Panel - Cart -->
            @include('components.pos.cart')
        </div>
    </div>

    <!-- Modals and Overlays -->
    @include('components.pos.payment-modal')
    @include('components.pos.success-modal')
    @include('components.pos.order-history')
</div>