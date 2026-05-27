<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\UserActivityLog;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class UserActivityLogTest extends TestCase
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
        Livewire::test(UserActivityLog::class)
            ->assertStatus(200);
    }

    public function test_displays_activity_logs(): void
    {
        ActivityLog::create([
            'user_id' => $this->admin->id,
            'action' => 'created',
            'model_type' => 'App\Models\Category',
            'model_id' => 1,
            'description' => 'Test Create Category',
            'ip_address' => '127.0.0.1',
        ]);

        Livewire::test(UserActivityLog::class)
            ->assertSee('Test Create Category');
    }

    public function test_can_filter_by_search(): void
    {
        ActivityLog::create([
            'user_id' => $this->admin->id,
            'action' => 'created',
            'description' => 'Create Product',
        ]);

        ActivityLog::create([
            'user_id' => $this->admin->id,
            'action' => 'updated',
            'description' => 'Update Table',
        ]);

        Livewire::test(UserActivityLog::class)
            ->set('search', 'Product')
            ->assertSee('Create Product')
            ->assertDontSee('Update Table');
    }

    public function test_can_filter_by_action(): void
    {
        ActivityLog::create([
            'user_id' => $this->admin->id,
            'action' => 'created',
            'description' => 'Create Product',
        ]);

        ActivityLog::create([
            'user_id' => $this->admin->id,
            'action' => 'updated',
            'description' => 'Update Table',
        ]);

        Livewire::test(UserActivityLog::class)
            ->set('filterAction', 'updated')
            ->assertSee('Update Table')
            ->assertDontSee('Create Product');
    }
}
