<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Dapur Bunda Bahagia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-cream min-h-screen flex items-center justify-center p-6 text-dark-roast">

    <div class="w-full max-w-md animate-fade-in">
        <!-- Logo & Title -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-espresso rounded-2xl mb-4 shadow-soft">
                <svg class="w-8 h-8 text-cream" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-dark-roast">Daftar Akun Baru</h1>
            <p class="text-warm-gray mt-2 font-sans">Sistem Informasi Restoran</p>
        </div>

        <!-- Register Card -->
        <div class="bg-warm-white rounded-[var(--radius-xl)] shadow-medium p-8 border border-sand glass">
            <h2 class="text-xl font-semibold text-espresso mb-6 font-sans">Buat Akun Anda</h2>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-error/10 border border-error/20 rounded-[var(--radius-md)]">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-error flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-sm text-error font-medium">{{ $errors->first() }}</p>
                    </div>
                </div>
            @endif

            <form method="POST" action="/register" class="space-y-5">
                @csrf

                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-espresso mb-1.5">Nama Lengkap</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        autofocus
                        class="w-full h-12 px-4 border border-sand rounded-[var(--radius-md)] bg-white placeholder-stone text-dark-roast
                               transition-colors hover:border-terracotta-light focus:outline-none focus:border-terracotta focus:ring-2 focus:ring-terracotta/20
                               @error('name') border-error focus:border-error focus:ring-error/20 @enderror"
                        placeholder="Budi Santoso"
                    >
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-espresso mb-1.5">Alamat Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        class="w-full h-12 px-4 border border-sand rounded-[var(--radius-md)] bg-white placeholder-stone text-dark-roast
                               transition-colors hover:border-terracotta-light focus:outline-none focus:border-terracotta focus:ring-2 focus:ring-terracotta/20
                               @error('email') border-error focus:border-error focus:ring-error/20 @enderror"
                        placeholder="budi@dapur.com"
                    >
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-espresso mb-1.5">Kata Sandi</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        class="w-full h-12 px-4 border border-sand rounded-[var(--radius-md)] bg-white placeholder-stone text-dark-roast
                               transition-colors hover:border-terracotta-light focus:outline-none focus:border-terracotta focus:ring-2 focus:ring-terracotta/20
                               @error('password') border-error focus:border-error focus:ring-error/20 @enderror"
                        placeholder="••••••••"
                    >
                </div>

                <!-- Password Confirmation Field -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-espresso mb-1.5">Konfirmasi Kata Sandi</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        required
                        class="w-full h-12 px-4 border border-sand rounded-[var(--radius-md)] bg-white placeholder-stone text-dark-roast
                               transition-colors hover:border-terracotta-light focus:outline-none focus:border-terracotta focus:ring-2 focus:ring-terracotta/20"
                        placeholder="••••••••"
                    >
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full h-12 bg-terracotta hover:bg-terracotta-dark text-white font-semibold rounded-[var(--radius-lg)] transition-all duration-200 shadow-sm hover:shadow-md flex items-center justify-center gap-2 btn-press mt-2"
                >
                    <span>Daftar Akun</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </button>

                <p class="text-center text-sm text-warm-gray mt-4">
                    Sudah memiliki akun? 
                    <a href="{{ route('login') }}" class="text-terracotta hover:text-terracotta-dark font-medium underline decoration-terracotta/30 hover:decoration-terracotta underline-offset-4 transition-all">
                        Masuk di sini
                    </a>
                </p>
            </form>
        </div>

        <!-- Footer -->
        <p class="text-center text-warm-gray text-sm mt-8 font-medium">
            &copy; {{ date('Y') }} Dapur Bunda Bahagia. All rights reserved.
        </p>
    </div>

</body>
</html>
