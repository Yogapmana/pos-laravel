<?php

namespace Tests\Unit;

use App\Models\Table;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TableTest extends TestCase
{
    use RefreshDatabase;

    public function test_is_available_when_status_is_available(): void
    {
        $table = Table::create([
            'number' => 1,
            'capacity' => 4,
            'status' => 'available',
        ]);

        $this->assertTrue($table->isAvailable());
        $this->assertFalse($table->isOccupied());
    }

    public function test_is_occupied_when_status_is_occupied(): void
    {
        $table = Table::create([
            'number' => 1,
            'capacity' => 4,
            'status' => 'occupied',
        ]);

        $this->assertTrue($table->isOccupied());
        $this->assertFalse($table->isAvailable());
    }

    public function test_mark_as_occupied_changes_status(): void
    {
        $table = Table::create([
            'number' => 1,
            'capacity' => 4,
            'status' => 'available',
        ]);

        $table->markAsOccupied();

        $this->assertEquals('occupied', $table->fresh()->status);
    }

    public function test_mark_as_available_changes_status(): void
    {
        $table = Table::create([
            'number' => 1,
            'capacity' => 4,
            'status' => 'occupied',
        ]);

        $table->markAsAvailable();

        $this->assertEquals('available', $table->fresh()->status);
    }

    public function test_can_create_table_with_number_and_capacity(): void
    {
        $table = Table::create([
            'number' => 5,
            'capacity' => 6,
            'status' => 'available',
        ]);

        $this->assertEquals(5, $table->number);
        $this->assertEquals(6, $table->capacity);
        $this->assertEquals('available', $table->status);
    }
}
