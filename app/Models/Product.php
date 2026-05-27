<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\LogsActivity;

/**
 * Product Model - Represents restaurant menu items
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property int $price
 * @property int $stock
 * @property string|null $image
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Product extends Model
{
    use LogsActivity;
    /** @var string[] */
    protected $fillable = [
        'category_id',
        'name',
        'price',
        'stock',
        'image',
    ];

    /** @var string[] */
    protected $casts = [
        'price' => 'integer',
        'stock' => 'integer',
    ];

    /**
     * Get the category this product belongs to
     *
     * @return BelongsTo<Category, Product>
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Check if product is out of stock
     *
     * @return bool
     */
    public function isOutOfStock(): bool
    {
        return $this->stock <= 0;
    }

    /**
     * Check if stock is running low (5 or fewer)
     *
     * @return bool
     */
    public function isLowStock(): bool
    {
        return $this->stock > 0 && $this->stock <= 5;
    }

    /**
     * Decrement stock by given quantity
     *
     * @param int $quantity
     * @return bool
     */
    public function decrementStock(int $quantity): bool
    {
        if ($this->stock < $quantity) {
            return false;
        }

        $this->decrement('stock', $quantity);
        return true;
    }
}