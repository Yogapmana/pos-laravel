<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\Tables;
use App\Models\Order;
use App\Models\Table;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class TablesTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($this->admin);
    }

    public function test_renders_successfully(): void
    {
        Livewire::test(Tables::class)
            ->assertStatus(200);
    }

    public function test_can_create_table(): void
    {
        Livewire::test(Tables::class)
            ->call('openModal')
            ->assertSet('showModal', true)
            ->set('number', '11')
            ->set('capacity', 6)
            ->set('status', 'available')
            ->call('save');

        $this->assertDatabaseHas('tables', [
            'number' => '11',
            'capacity' => 6,
            'status' => 'available',
        ]);
    }

    public function test_can_edit_table(): void
    {
        $table = Table::create([
            'number' => '01',
            'capacity' => 4,
            'status' => 'available',
        ]);

        Livewire::test(Tables::class)
            ->call('openModal', $table->id)
            ->assertSet('editingId', $table->id)
            ->assertSet('number', '01')
            ->set('capacity', 8)
            ->call('save');

        $this->assertDatabaseHas('tables', [
            'id' => $table->id,
            'capacity' => 8,
        ]);
    }

    public function test_can_delete_table_without_orders(): void
    {
        $table = Table::create([
            'number' => '99',
            'capacity' => 2,
            'status' => 'available',
        ]);

        Livewire::test(Tables::class)
            ->call('delete', $table->id);

        $this->assertDatabaseMissing('tables', ['id' => $table->id]);
    }

    public function test_cannot_delete_table_with_orders(): void
    {
        $table = Table::create([
            'number' => '01',
            'capacity' => 4,
            'status' => 'available',
        ]);

        Order::create([
            'order_number' => 'ORD-001',
            'table_id' => $table->id,
            'total_price' => 22200,
            'status' => 'Paid',
        ]);

        Livewire::test(Tables::class)
            ->call('delete', $table->id);

        // Table should still exist
        $this->assertDatabaseHas('tables', ['id' => $table->id]);
    }

    public function test_validation_requires_unique_number(): void
    {
        Table::create([
            'number' => '01',
            'capacity' => 4,
            'status' => 'available',
        ]);

        Livewire::test(Tables::class)
            ->call('openModal')
            ->set('number', '01')
            ->set('capacity', 4)
            ->set('status', 'available')
            ->call('save')
            ->assertHasErrors(['number']);
    }

    public function test_validation_requires_valid_capacity(): void
    {
        Livewire::test(Tables::class)
            ->call('openModal')
            ->set('number', '50')
            ->set('capacity', 0)
            ->set('status', 'available')
            ->call('save')
            ->assertHasErrors(['capacity']);
    }

    public function test_close_modal_resets_form(): void
    {
        Livewire::test(Tables::class)
            ->call('openModal')
            ->set('number', '99')
            ->call('closeModal')
            ->assertSet('showModal', false)
            ->assertSet('number', '')
            ->assertSet('editingId', null);
    }
}
