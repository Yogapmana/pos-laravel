<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\Users;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class UsersTest extends TestCase
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
        Livewire::test(Users::class)
            ->assertStatus(200);
    }

    public function test_can_create_user(): void
    {
        Livewire::test(Users::class)
            ->call('openModal')
            ->assertSet('showModal', true)
            ->set('name', 'Budi Kasir')
            ->set('email', 'budi@example.com')
            ->set('role', 'kasir')
            ->set('password', 'password123')
            ->call('save');

        $this->assertDatabaseHas('users', [
            'name' => 'Budi Kasir',
            'email' => 'budi@example.com',
            'role' => 'kasir',
        ]);
    }

    public function test_can_edit_user(): void
    {
        $user = User::factory()->create(['role' => 'kasir']);

        Livewire::test(Users::class)
            ->call('openModal', $user->id)
            ->assertSet('editingId', $user->id)
            ->set('name', 'Budi Kasir Updated')
            ->call('save');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Budi Kasir Updated',
        ]);
    }

    public function test_can_delete_user(): void
    {
        $user = User::factory()->create(['role' => 'kasir']);

        Livewire::test(Users::class)
            ->call('delete', $user->id);

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_cannot_delete_self(): void
    {
        Livewire::test(Users::class)
            ->call('delete', $this->admin->id);

        // Admin should still exist
        $this->assertDatabaseHas('users', ['id' => $this->admin->id]);
    }

    public function test_can_reset_password(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('oldpassword'),
        ]);

        Livewire::test(Users::class)
            ->call('resetPassword', $user->id);

        $this->assertTrue(Hash::check('password', $user->fresh()->password));
    }

    public function test_cannot_reset_own_password(): void
    {
        $oldPasswordHash = $this->admin->password;

        Livewire::test(Users::class)
            ->call('resetPassword', $this->admin->id);

        // Password should not have changed
        $this->assertEquals($oldPasswordHash, $this->admin->fresh()->password);
    }

    public function test_validation_requires_unique_email(): void
    {
        $existingUser = User::factory()->create(['email' => 'test@example.com']);

        Livewire::test(Users::class)
            ->call('openModal')
            ->set('name', 'Test')
            ->set('email', 'test@example.com')
            ->set('role', 'kasir')
            ->set('password', 'password123')
            ->call('save')
            ->assertHasErrors(['email']);
    }

    public function test_validation_requires_password_on_create(): void
    {
        Livewire::test(Users::class)
            ->call('openModal')
            ->set('name', 'Test')
            ->set('email', 'test@example.com')
            ->set('role', 'kasir')
            ->call('save')
            ->assertHasErrors(['password']);
    }
}
