<div>
    <!-- Page Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-sm text-slate">Total {{ $users->count() }} pengguna</p>
        </div>
        <button
            wire:click="openModal()"
            class="inline-flex items-center gap-2 px-4 py-2.5 bg-navy hover:bg-navy-800 text-white text-sm font-semibold rounded-lg transition-all"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Pengguna
        </button>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-success/10 border border-success/20 rounded-lg flex items-center gap-3">
            <svg class="w-5 h-5 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-sm text-success">{{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div class="mb-6 p-4 bg-error/10 border border-error/20 rounded-lg flex items-center gap-3">
            <svg class="w-5 h-5 text-error" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-sm text-error">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Users Table -->
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate uppercase tracking-wide">Pengguna</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate uppercase tracking-wide">Email</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate uppercase tracking-wide">Role</th>
                    <th class="px-6 py-4 text-center text-xs font-semibold text-slate uppercase tracking-wide">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($users as $user)
                    <tr class="hover:bg-slate-50/50">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-navy rounded-full flex items-center justify-center text-white font-bold text-sm">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <p class="font-medium text-navy">{{ $user->name }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-slate text-sm">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex px-2.5 py-1 text-xs font-semibold rounded-full {{ $user->role === 'admin' ? 'bg-sage/10 text-sage' : 'bg-slate-100 text-slate' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="inline-flex items-center gap-1">
                                <button wire:click="openModal({{ $user->id }})" class="p-2 hover:bg-slate-100 rounded-lg transition-colors">
                                    <svg class="w-4 h-4 text-slate" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button wire:click="resetPassword({{ $user->id }})" wire:confirm="Yakin reset password pengguna ini ke 'password'?" class="p-2 hover:bg-warning/10 rounded-lg transition-colors">
                                    <svg class="w-4 h-4 text-warning" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                    </svg>
                                </button>
                                <button wire:click="delete({{ $user->id }})" wire:confirm="Yakin hapus pengguna ini?" class="p-2 hover:bg-error/10 rounded-lg transition-colors">
                                    <svg class="w-4 h-4 text-error" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4" wire:click="closeModal" wire:click.self="closeModal">
            <div class="fixed inset-0 bg-navy/50 backdrop-blur-sm"></div>
            <div class="relative bg-white rounded-xl shadow-lg w-full max-w-md p-6" wire:click.stop>
                <h3 class="text-lg font-bold text-navy mb-6">
                    {{ $editingId ? 'Edit Pengguna' : 'Tambah Pengguna' }}
                </h3>

                <form wire:submit="save">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-navy mb-1.5">Nama Lengkap</label>
                            <input type="text" wire:model="name" class="w-full h-11 px-4 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-2 focus:border-navy focus:ring-2 focus:ring-navy/10 @error('name') border-error @enderror" placeholder="Masukkan nama">
                            @error('name') <span class="text-xs text-error mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-navy mb-1.5">Email</label>
                            <input type="email" wire:model="email" class="w-full h-11 px-4 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-2 focus:border-navy focus:ring-2 focus:ring-navy/10 @error('email') border-error @enderror" placeholder="email@contoh.com">
                            @error('email') <span class="text-xs text-error mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-navy mb-1.5">Role</label>
                            <select wire:model="role" class="w-full h-11 px-4 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-2 focus:border-navy">
                                <option value="kasir">Kasir</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-navy mb-1.5">
                                {{ $editingId ? 'Password Baru (kosongkan jika tidak diubah)' : 'Password' }}
                            </label>
                            <input type="password" wire:model="password" class="w-full h-11 px-4 border border-slate-200 rounded-lg text-sm focus:outline-none focus:border-2 focus:border-navy focus:ring-2 focus:ring-navy/10 @error('password') border-error @enderror" placeholder="{{ $editingId ? 'Kosongkan jika tidak diubah' : 'Minimal 6 karakter' }}">
                            @error('password') <span class="text-xs text-error mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex items-center gap-3 mt-6">
                        <button type="button" wire:click="closeModal" class="flex-1 h-11 border border-slate-200 text-slate font-medium rounded-lg hover:bg-slate-50 transition-all">
                            Batal
                        </button>
                        <button type="submit" wire:loading.attr="disabled" class="flex-1 h-11 bg-navy hover:bg-navy-800 text-white font-semibold rounded-lg transition-all disabled:bg-slate-300 disabled:cursor-not-allowed flex items-center justify-center gap-2">
                            <span wire:loading.remove wire:target="save">Simpan</span>
                            <span wire:loading wire:target="save">Menyimpan...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>