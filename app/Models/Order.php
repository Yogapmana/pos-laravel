<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Traits\LogsActivity;

/**
 * Order Model - Represents a customer order
 *
 * @property int $id
 * @property string $order_number Unique order identifier
 * @property int|null $table_id
 * @property int|null $cashier_id
 * @property int $total_price Total price including tax
 * @property string $payment_method Payment method: 'Tunai' or 'Midtrans'
 * @property string $status Order status: 'Pending' or 'Paid'
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Order extends Model
{
    use LogsActivity;
    /** @var string[] */
    protected $fillable = [
        'order_number',
        'table_id',
        'cashier_id',
        'total_price',
        'payment_method',
        'status',
    ];

    /** @var string[] */
    protected $casts = [
        'total_price' => 'integer',
    ];

    /** Order is awaiting payment */
    public const STATUS_PENDING = 'Pending';

    /** Order has been paid */
    public const STATUS_PAID = 'Paid';

    /** Order has been voided/cancelled */
    public const STATUS_VOIDED = 'Voided';

    /** Cash payment method */
    public const PAYMENT_TUNAI = 'Tunai';

    /** Midtrans non-cash payment method */
    public const PAYMENT_MIDTRANS = 'Midtrans';

    /**
     * Get the table this order is placed at
     *
     * @return BelongsTo<Table, Order>
     */
    public function table(): BelongsTo
    {
        return $this->belongsTo(Table::class);
    }

    /**
     * Get the cashier who processed this order
     *
     * @return BelongsTo<User, Order>
     */
    public function cashier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cashier_id');
    }

    /**
     * Get all items in this order
     *
     * @return HasMany<OrderItem>
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the transaction record for this order
     *
     * @return HasOne<Transaction>
     */
    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class);
    }

    /**
     * Check if order is pending payment
     *
     * @return bool
     */
    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    /**
     * Check if order has been paid
     *
     * @return bool
     */
    public function isPaid(): bool
    {
        return $this->status === self::STATUS_PAID;
    }

    /**
     * Mark order as paid
     *
     * @return void
     */
    public function markAsPaid(): void
    {
        $this->update(['status' => self::STATUS_PAID]);
    }

    /**
     * Check if order is voided
     *
     * @return bool
     */
    public function isVoided(): bool
    {
        return $this->status === self::STATUS_VOIDED;
    }

    /**
     * Void/cancel the order and restore stock
     *
     * @return bool
     */
    public function void(): bool
    {
        if ($this->status === self::STATUS_VOIDED) {
            return false;
        }

        // Restore stock for each item
        foreach ($this->items as $item) {
            $product = $item->product;
            if ($product) {
                $product->increment('stock', $item->qty);
            }
        }

        // Update order status
        $this->update(['status' => self::STATUS_VOIDED]);

        // Update transaction if exists
        if ($this->transaction) {
            $this->transaction->update(['status' => 'voided']);
        }

        // Free the table if it was occupied
        if ($this->table_id) {
            Table::find($this->table_id)?->markAsAvailable();
        }

        return true;
    }

    /**
     * Calculate subtotal (price before tax) from order items
     *
     * @return int
     */
    public function calculateSubtotal(): int
    {
        return $this->items->sum(fn($item) => $item->price * $item->qty);
    }

    /**
     * Calculate tax amount (11% PPN)
     *
     * @return int
     */
    public function calculateTax(): int
    {
        return (int) round($this->calculateSubtotal() * 0.11);
    }
}