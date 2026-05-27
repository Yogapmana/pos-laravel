<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Transaction Model - Represents a payment transaction
 *
 * @property int $id
 * @property int $order_id
 * @property string $payment_method Payment method: 'Tunai' or 'Midtrans'
 * @property int $amount_received Total amount received from customer
 * @property int $change Change amount to return to customer
 * @property int $subtotal Subtotal before tax
 * @property int $tax Tax amount (PPN 11%)
 * @property int $total Total amount (subtotal + tax)
 * @property string|null $midtrans_order_id Midtrans order ID for non-cash payments
 * @property string|null $midtrans_payment_type Payment type from Midtrans (gopay, ovo, etc)
 * @property string $status Transaction status: 'pending', 'completed', 'failed'
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Transaction extends Model
{
    /** @var string[] */
    protected $fillable = [
        'order_id',
        'payment_method',
        'amount_received',
        'change',
        'subtotal',
        'tax',
        'total',
        'midtrans_order_id',
        'midtrans_payment_type',
        'status',
    ];

    /** @var string[] */
    protected $casts = [
        'amount_received' => 'integer',
        'change' => 'integer',
        'subtotal' => 'integer',
        'tax' => 'integer',
        'total' => 'integer',
    ];

    /** Transaction awaiting payment confirmation */
    public const STATUS_PENDING = 'pending';

    /** Transaction completed successfully */
    public const STATUS_COMPLETED = 'completed';

    /** Transaction failed or cancelled */
    public const STATUS_FAILED = 'failed';

    /** Transaction voided/cancelled */
    public const STATUS_VOIDED = 'voided';

    /**
     * Get the order this transaction belongs to
     *
     * @return BelongsTo<Order, Transaction>
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Check if transaction is pending
     *
     * @return bool
     */
    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    /**
     * Check if transaction is completed
     *
     * @return bool
     */
    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    /**
     * Mark transaction as completed
     *
     * @return void
     */
    public function markAsCompleted(): void
    {
        $this->update(['status' => self::STATUS_COMPLETED]);
    }

    /**
     * Check if this is a cash transaction
     *
     * @return bool
     */
    public function isCashPayment(): bool
    {
        return $this->payment_method === 'Tunai';
    }

    /**
     * Check if this is a Midtrans non-cash transaction
     *
     * @return bool
     */
    public function isMidtransPayment(): bool
    {
        return $this->payment_method === 'Midtrans';
    }
}