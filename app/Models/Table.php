<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\LogsActivity;

/**
 * Table Model - Represents restaurant tables
 *
 * @property int $id
 * @property int $number Table number (unique identifier)
 * @property int $capacity Number of people the table can accommodate
 * @property string $status Table status: 'available' or 'occupied'
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Table extends Model
{
    use LogsActivity;
    /** @var string[] */
    protected $fillable = [
        'number',
        'capacity',
        'status',
    ];

    /** Table is available for seating */
    public const STATUS_AVAILABLE = 'available';

    /** Table is currently occupied */
    public const STATUS_OCCUPIED = 'occupied';

    /**
     * Get all orders for this table
     *
     * @return HasMany<Order>
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Check if table is available
     *
     * @return bool
     */
    public function isAvailable(): bool
    {
        return $this->status === self::STATUS_AVAILABLE;
    }

    /**
     * Check if table is occupied
     *
     * @return bool
     */
    public function isOccupied(): bool
    {
        return $this->status === self::STATUS_OCCUPIED;
    }

    /**
     * Mark table as occupied
     *
     * @return void
     */
    public function markAsOccupied(): void
    {
        $this->update(['status' => self::STATUS_OCCUPIED]);
    }

    /**
     * Mark table as available
     *
     * @return void
     */
    public function markAsAvailable(): void
    {
        $this->update(['status' => self::STATUS_AVAILABLE]);
    }
}