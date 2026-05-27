<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Table;
use App\Models\Transaction;
use App\Services\MidtransService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

/**
 * Pos Component - Point of Sale functionality for kasir
 *
 * Handles table selection, cart operations, billing calculation,
 * and payment processing (cash and Midtrans)
 *
 * @author Dapur Bunda Bahagia
 * @version 1.0
 */
class Pos extends Component
{
    // ========== Table Selection ==========

    /** @var int|null */
    public $selectedTableId = null;

    /** @var int|null */
    public $selectedTableNumber = null;

    /** @var Collection<int, Table> */
    public $tables = [];

    // ========== Product Filtering ==========

    /** @var int|string */
    public $selectedCategoryId = '';

    /** @var string */
    public $searchQuery = '';

    /** @var Collection<int, Category> */
    public $categories = [];

    // ========== Cart ==========

    /** @var array<int, array{name: string, price: int, qty: int}> */
    public $cart = [];

    /** @var array<int, string> */
    public $notes = [];

    // ========== Billing ==========

    /** @var int */
    public $subtotal = 0;

    /** @var int */
    public $tax = 0;

    /** @var int */
    public $grandTotal = 0;

    // ========== Payment Modal ==========

    /** @var bool */
    public $showPaymentModal = false;

    /** @var string */
    public $paymentAmount = '';

    /** @var int */
    public $change = 0;

    /** @var string */
    public $paymentMethod = 'Tunai';

    /** @var bool */
    public $isValidPayment = false;

    // ========== Success Modal ==========

    /** @var bool */
    public $showSuccessModal = false;

    /** @var int|null */
    public $lastOrderId = null;

    /** @var string|null */
    public $lastOrderNumber = null;

    /** @var int */
    public $lastOrderTotal = 0;

    // ========== Midtrans ==========

    /** @var string|null */
    public $midtransRedirectUrl = null;

    /** @var string|null */
    public $midtransError = null;

    // ========== Order History ==========

    /** @var bool */
    public $showOrderHistory = false;

    /** @var Collection<int, Order> */
    public $orderHistory = [];

    /** @var Order|null */
    public $selectedHistoryOrder = null;

    /** @var bool */
    public $showHistoryDetailModal = false;

    /**
     * Initialize component - load tables and categories
     *
     * @return void
     */
    public function mount()
    {
        $this->loadTables();
        $this->loadCategories();

        // Handle return from Midtrans payment
        if (request()->query('status') === 'success' && request()->query('db_order_id')) {
            $order = Order::find(request()->query('db_order_id'));
            if ($order) {
                // Update order and transaction status if still pending
                if ($order->status === 'Pending') {
                    DB::transaction(function () use ($order) {
                        $order->update(['status' => 'Paid']);

                        // Update related transaction
                        $transaction = Transaction::where('order_id', $order->id)->first();
                        if ($transaction && $transaction->status === 'pending') {
                            $transaction->update([
                                'status' => 'completed',
                                'amount_received' => $order->total_price,
                            ]);
                        }

                        // Decrement stock
                        foreach ($order->items as $item) {
                            Product::find($item->product_id)?->decrement('stock', $item->qty);
                        }

                        // Free up the table
                        if ($order->table_id) {
                            Table::find($order->table_id)?->update(['status' => 'available']);
                        }
                    });
                }

                $this->showSuccessModal = true;
                $this->lastOrderId = $order->id;
                $this->lastOrderNumber = $order->order_number;
                $this->lastOrderTotal = $order->total_price;

                // Hapus query parameters dari URL agar refresh tidak memicu modal sukses lagi
                $this->js("window.history.replaceState(null, '', window.location.pathname);");
            }
        }
    }

    /**
     * Load available tables from database
     *
     * @return void
     */
    public function loadTables(): void
    {
        $this->tables = Table::orderBy('number')->get();
    }

    /**
     * Load product categories from database
     *
     * @return void
     */
    public function loadCategories(): void
    {
        $this->categories = Category::orderBy('name')->get();
    }

    /**
     * Select or deselect a table
     *
     * @param int $tableId
     * @return void
     */
    public function selectTable(int $tableId): void
    {
        // Toggle off if clicking the same table
        if ($this->selectedTableId === $tableId) {
            $this->selectedTableId = null;
            $this->selectedTableNumber = null;
            return;
        }

        $table = Table::find($tableId);

        if ($table && $table->status === 'available') {
            $this->selectedTableId = $tableId;
            $this->selectedTableNumber = $table->number;
        }
    }

    /**
     * Add a product to the cart
     *
     * @param int $productId
     * @return void
     */
    public function addToCart(int $productId): void
    {
        $product = Product::find($productId);

        if (!$product) return;

        if ($product->stock <= 0) {
            session()->flash('error', 'Stok produk habis!');
            return;
        }

        if (isset($this->cart[$productId])) {
            if ($product->stock > $this->cart[$productId]['qty']) {
                $this->cart[$productId]['qty'] += 1;
            }
        } else {
            $this->cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'qty' => 1,
                'image' => $product->image,
            ];
            $this->notes[$productId] = '';
        }

        $this->calculateTotal();
    }

    /**
     * Increment quantity of a cart item
     *
     * @param int $productId
     * @return void
     */
    public function incrementQty(int $productId): void
    {
        if (isset($this->cart[$productId])) {
            $product = Product::find($productId);
            if ($product && $product->stock > $this->cart[$productId]['qty']) {
                $this->cart[$productId]['qty'] += 1;
                $this->calculateTotal();
            }
        }
    }

    /**
     * Decrement quantity or remove item from cart
     *
     * @param int $productId
     * @return void
     */
    public function decrementQty(int $productId): void
    {
        if (isset($this->cart[$productId])) {
            if ($this->cart[$productId]['qty'] > 1) {
                $this->cart[$productId]['qty'] -= 1;
            } else {
                unset($this->cart[$productId]);
                unset($this->notes[$productId]);
            }
            $this->calculateTotal();
        }
    }

    /**
     * Remove item completely from cart
     *
     * @param int $productId
     * @return void
     */
    public function removeFromCart(int $productId): void
    {
        unset($this->cart[$productId]);
        unset($this->notes[$productId]);
        $this->calculateTotal();
    }

    /**
     * Update note for a cart item
     *
     * @param int $productId
     * @param string $note
     * @return void
     */
    public function updateNote(int $productId, string $note): void
    {
        $this->notes[$productId] = $note;
    }

    /**
     * Calculate subtotal, tax (11% PPN), and grand total
     *
     * @return void
     */
    public function calculateTotal(): void
    {
        $this->subtotal = 0;

        foreach ($this->cart as $item) {
            $this->subtotal += $item['price'] * $item['qty'];
        }

        $this->tax = (int) round($this->subtotal * 0.11);
        $this->grandTotal = $this->subtotal + $this->tax;
    }

    /**
     * Open the payment modal
     *
     * @return void
     */
    public function openPaymentModal(): void
    {
        if (empty($this->cart)) return;

        $this->showPaymentModal = true;
        $this->paymentAmount = '';
        $this->change = 0;
        $this->paymentMethod = 'Tunai';
        $this->isValidPayment = false;
        $this->midtransError = null;
    }

    /**
     * Close the payment modal
     *
     * @return void
     */
    public function closePaymentModal(): void
    {
        $this->showPaymentModal = false;
        $this->paymentAmount = '';
        $this->change = 0;
        $this->midtransError = null;
    }

    /**
     * Calculate change based on payment amount
     *
     * @return void
     */
    public function calculateChange(): void
    {
        $amount = (int) str_replace(['.', ','], '', (string) $this->paymentAmount);
        $this->change = ($amount >= $this->grandTotal) ? ($amount - $this->grandTotal) : 0;
        $this->isValidPayment = ($amount >= $this->grandTotal);
    }

    /**
     * Hook for when paymentAmount is updated
     *
     * @return void
     */
    public function updatedPaymentAmount(): void
    {
        $this->calculateChange();
    }

    /**
     * Set payment amount from quick amount buttons
     *
     * @param int|string $amount
     * @return void
     */
    public function setPaymentAmount(int|string $amount): void
    {
        $this->paymentAmount = $amount;
        $this->calculateChange();
    }

    /**
     * Process payment based on selected method
     *
     * @return mixed
     */
    public function processPayment(): mixed
    {
        if ($this->paymentMethod === 'Midtrans') {
            return $this->processMidtransPayment();
        }

        return $this->processCashPayment();
    }

    /**
     * Process cash payment
     *
     * @return void
     */
    protected function processCashPayment(): void
    {
        $amount = (int) str_replace(['.', ','], '', $this->paymentAmount);

        if ($amount < $this->grandTotal) {
            session()->flash('error', 'Jumlah pembayaran kurang dari total!');
            return;
        }

        $orderId = null;
        $orderNumber = null;

        DB::transaction(function () use ($amount, &$orderId, &$orderNumber) {
            // Mark table as occupied during checkout
            if ($this->selectedTableId) {
                Table::find($this->selectedTableId)?->update(['status' => 'occupied']);
            }

            $orderNumber = 'ORD-' . date('Ymd') . '-' . str_pad(Order::count() + 1, 4, '0', STR_PAD_LEFT);

            $order = Order::create([
                'order_number' => $orderNumber,
                'table_id' => $this->selectedTableId,
                'cashier_id' => Auth::id(),
                'total_price' => $this->grandTotal,
                'payment_method' => 'Tunai',
                'status' => 'Paid',
            ]);

            $orderId = $order->id;

            foreach ($this->cart as $productId => $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'price' => $item['price'],
                    'qty' => $item['qty'],
                    'note' => $this->notes[$productId] ?? null,
                ]);

                $product = Product::find($productId);
                $product->decrement('stock', $item['qty']);
            }

            Transaction::create([
                'order_id' => $order->id,
                'payment_method' => 'Tunai',
                'amount_received' => $amount,
                'change' => $amount - $this->grandTotal,
                'subtotal' => $this->subtotal,
                'tax' => $this->tax,
                'total' => $this->grandTotal,
                'status' => 'completed',
            ]);

            // Keep table occupied after payment
            // Table will be freed when next customer sits down
        });

        $this->loadTables();

        $this->lastOrderId = $orderId;
        $this->lastOrderNumber = $orderNumber;
        $this->lastOrderTotal = $this->grandTotal;

        $this->resetCart();
        $this->showSuccessModal = true;
    }

    /**
     * Process Midtrans non-cash payment
     *
     * @return mixed
     */
    protected function processMidtransPayment(): mixed
    {
        $midtransService = new MidtransService();

        if (!$midtransService->isConfigured()) {
            $this->midtransError = 'Midtrans belum dikonfigurasi. Hubungi administrator.';
            return null;
        }

        // Create pending order first
        $orderNumber = 'ORD-' . date('Ymd') . '-' . str_pad(Order::count() + 1, 4, '0', STR_PAD_LEFT);

        $order = Order::create([
            'order_number' => $orderNumber,
            'table_id' => $this->selectedTableId,
            'cashier_id' => Auth::id(),
            'total_price' => $this->grandTotal,
            'payment_method' => 'Midtrans',
            'status' => 'Pending',
        ]);

        // Create order items
        foreach ($this->cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'price' => $item['price'],
                'qty' => $item['qty'],
                'note' => $this->notes[$productId] ?? null,
            ]);
        }

        // Create pending transaction
        $transaction = Transaction::create([
            'order_id' => $order->id,
            'payment_method' => 'Midtrans',
            'amount_received' => 0,
            'change' => 0,
            'subtotal' => $this->subtotal,
            'tax' => $this->tax,
            'total' => $this->grandTotal,
            'status' => 'pending',
        ]);

        // Get Midtrans redirect URL
        $midtransData = $midtransService->createTransaction($order);

        if ($midtransData && isset($midtransData['redirect_url'])) {
            // Free up the table for now
            if ($this->selectedTableId) {
                Table::find($this->selectedTableId)?->update(['status' => 'available']);
            }

            $this->resetCart();

            // Redirect to Midtrans
            return redirect()->to($midtransData['redirect_url']);
        }

        // If Midtrans fails, delete the pending order and show error
        $order->delete();
        $transaction->delete();

        $this->midtransError = 'Gagal menghubungkan ke Midtrans. Silakan coba lagi atau gunakan pembayaran Tunai.';
    }

    /**
     * Close the success modal
     *
     * @return void
     */
    public function closeSuccessModal(): void
    {
        $this->showSuccessModal = false;
        $this->lastOrderId = null;
        $this->lastOrderNumber = null;
        $this->lastOrderTotal = 0;
    }

    /**
     * Start a new transaction
     *
     * @return void
     */
    public function newTransaction(): void
    {
        $this->closeSuccessModal();
    }

    /**
     * Reset cart to initial state
     *
     * @return void
     */
    protected function resetCart(): void
    {
        $this->cart = [];
        $this->notes = [];
        $this->selectedTableId = null;
        $this->selectedTableNumber = null;
        $this->subtotal = 0;
        $this->tax = 0;
        $this->grandTotal = 0;
        $this->showPaymentModal = false;
        $this->loadTables();
    }

    /**
     * Get filtered products based on category and search
     *
     * @return Collection<int, Product>
     */
    public function getProductsProperty()
    {
        return Product::with('category')
            ->when($this->selectedCategoryId, fn($q) => $q->where('category_id', $this->selectedCategoryId))
            ->when($this->searchQuery, fn($q) => $q->where('name', 'like', '%' . $this->searchQuery . '%'))
            ->orderBy('name')
            ->get();
    }

    /**
     * Clear cart and free the table
     *
     * @return void
     */
    public function clearCart(): void
    {
        if ($this->selectedTableId) {
            Table::find($this->selectedTableId)?->update(['status' => 'available']);
        }
        $this->resetCart();
    }

    /**
     * Render the POS view
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.pos', [
            'products' => $this->products,
        ])->layout('layouts.pos');
    }

    // ========== Order History Methods ==========

    /**
     * Load order history for current user
     *
     * @return void
     */
    public function loadOrderHistory(): void
    {
        $this->orderHistory = Order::with(['table', 'items.product'])
            ->where('cashier_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get();
    }

    /**
     * Toggle order history panel
     *
     * @return void
     */
    public function toggleOrderHistory(): void
    {
        if ($this->showOrderHistory) {
            $this->showOrderHistory = false;
        } else {
            $this->loadOrderHistory();
            $this->showOrderHistory = true;
        }
    }

    /**
     * Open history detail modal
     *
     * @param int $orderId
     * @return void
     */
    public function openHistoryDetail(int $orderId): void
    {
        $this->selectedHistoryOrder = Order::with(['table', 'cashier', 'items.product'])->find($orderId);
        $this->showHistoryDetailModal = true;
    }

    /**
     * Close history detail modal
     *
     * @return void
     */
    public function closeHistoryDetail(): void
    {
        $this->showHistoryDetailModal = false;
        $this->selectedHistoryOrder = null;
    }
}