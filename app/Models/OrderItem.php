<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * OrderItem Model - Represents individual items within an order
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $price Price at time of order
 * @property int $qty Quantity ordered
 * @property string|null $note Special instructions (e.g., "tidak pedas")
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class OrderItem extends Model
{
    /** @var string[] */
    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'qty',
        'note',
    ];

    /** @var string[] */
    protected $casts = [
        'price' => 'integer',
        'qty' => 'integer',
    ];

    /**
     * Get the product for this order item
     *
     * @return BelongsTo<Product, OrderItem>
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the order this item belongs to
     *
     * @return BelongsTo<Order, OrderItem>
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Calculate total price for this item (price x quantity)
     *
     * @return int
     */
    public function getSubtotal(): int
    {
        return $this->price * $this->qty;
    }

    /**
     * Check if this item has special notes
     *
     * @return bool
     */
    public function hasNote(): bool
    {
        return !empty($this->note);
    }
}