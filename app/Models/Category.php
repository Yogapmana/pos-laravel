<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\LogsActivity;

/**
 * Category Model - Represents product categories
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Category extends Model
{
    use LogsActivity;
    /** @var string[] */
    protected $fillable = [
        'name',
    ];

    /**
     * Get all products in this category
     *
     * @return HasMany<Product>
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get count of active products (not out of stock)
     *
     * @return int
     */
    public function getActiveProductsCount(): int
    {
        return $this->products()->where('stock', '>', 0)->count();
    }
}