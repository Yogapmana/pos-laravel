<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

/**
 * Users Component - User CRUD management for admin
 *
 * Handles create, read, update, delete operations for user accounts
 * (admin and kasir roles)
 *
 * @author Dapur Bunda Bahagia
 * @version 1.0
 */
class Users extends Component
{
    /** @var string */
    public $name = '';

    /** @var string */
    public $email = '';

    /** @var string */
    public $password = '';

    /** @var string */
    public $role = 'kasir';

    /** @var int|null */
    public $editingId = null;

    /** @var bool */
    public $showModal = false;

    /**
     * Get validation rules
     *
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email' . ($this->editingId ? ',' . $this->editingId : ''),
            'role' => 'required|in:admin,kasir',
        ];

        if (!$this->editingId || $this->password) {
            $rules['password'] = 'required|min:6';
        }

        return $rules;
    }

    /**
     * Render the users view
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $users = User::orderBy('name')->get();

        return view('livewire.admin.users', compact('users'))
            ->layout('layouts.admin', [
                'title' => 'Pengguna - Dapur Bunda Bahagia',
                'headerTitle' => 'Kelola Pengguna',
                'headerSubtitle' => 'Kelola akun admin dan kasir',
            ]);
    }

    /**
     * Open the create/edit modal
     *
     * @param int|null $id
     * @return void
     */
    public function openModal($id = null)
    {
        if ($id) {
            $user = User::find($id);
            $this->editingId = $id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->role = $user->role;
            $this->password = '';
        } else {
            $this->reset(['editingId', 'name', 'email', 'role', 'password']);
        }
        $this->showModal = true;
    }

    /**
     * Close the modal and reset form
     *
     * @return void
     */
    public function closeModal()
    {
        $this->reset(['showModal', 'editingId', 'name', 'email', 'role', 'password']);
    }

    /**
     * Save user (create or update)
     *
     * @return void
     */
    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
        ];

        if ($this->password) {
            $data['password'] = Hash::make($this->password);
        }

        User::updateOrCreate(
            ['id' => $this->editingId],
            $data
        );

        session()->flash('success', $this->editingId ? 'Pengguna berhasil diperbarui.' : 'Pengguna berhasil ditambahkan.');
        $this->closeModal();
    }

    /**
     * Delete a user (cannot delete self)
     *
     * @param int $id
     * @return void
     */
    public function delete($id)
    {
        if ($id === auth()->id()) {
            session()->flash('error', 'Anda tidak dapat menghapus akun sendiri.');
            return;
        }
        User::find($id)->delete();
        session()->flash('success', 'Pengguna berhasil dihapus.');
    }

    /**
     * Reset user password to default ('password')
     *
     * @param int $id
     * @return void
     */
    public function resetPassword($id)
    {
        $user = User::find($id);

        if (!$user) {
            session()->flash('error', 'Pengguna tidak ditemukan.');
            return;
        }

        if ($id === auth()->id()) {
            session()->flash('error', 'Anda tidak dapat mereset password sendiri.');
            return;
        }

        $user->update(['password' => Hash::make('password')]);
        session()->flash('success', 'Password pengguna ' . $user->name . ' berhasil direset ke "password".');
    }
}