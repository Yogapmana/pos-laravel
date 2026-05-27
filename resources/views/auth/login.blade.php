<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dapur Bunda Bahagia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: '#0F172A',
                        slate: '#64748B',
                        sage: '#059669',
                        success: '#22C55E',
                        warning: '#EAB308',
                        error: '#EF4444',
                        info: '#0EA5E9',
                    },
                    fontFamily: {
                        heading: ['Plus Jakarta Sans', 'sans-serif'],
                        body: ['DM Sans', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-md">
        <!-- Logo & Title -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-navy rounded-xl mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-navy">Dapur Bunda Bahagia</h1>
            <p class="text-slate mt-2">Sistem Informasi Restoran</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-8">
            <h2 class="text-xl font-semibold text-navy mb-6">Masuk ke Akun Anda</h2>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-error flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-sm text-error">{{ $errors->first() }}</p>
                    </div>
                </div>
            @endif

            <form method="POST" action="/login" class="space-y-5">
                @csrf

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-navy mb-1.5">Alamat Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        class="w-full h-11 px-4 border border-slate-200 rounded-lg text-body bg-white placeholder-slate-400
                               hover:border-navy focus:outline-none focus:border-2 focus:border-navy focus:ring-2 focus:ring-navy/10
                               @error('email') border-error ring-2 ring-error/10 @enderror"
                        placeholder="admin@dapur.com"
                    >
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-navy mb-1.5">Kata Sandi</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        class="w-full h-11 px-4 border border-slate-200 rounded-lg text-body bg-white placeholder-slate-400
                               hover:border-navy focus:outline-none focus:border-2 focus:border-navy focus:ring-2 focus:ring-navy/10
                               @error('password') border-error ring-2 ring-error/10 @enderror"
                        placeholder="••••••••"
                    >
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input
                        type="checkbox"
                        id="remember"
                        name="remember"
                        class="w-4 h-4 rounded border-slate-300 text-navy focus:ring-navy/20"
                    >
                    <label for="remember" class="ml-3 text-sm text-slate">Ingat saya</label>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full h-11 bg-navy hover:bg-navy-800 text-white font-semibold rounded-lg transition-all duration-200 shadow-sm hover:shadow-md flex items-center justify-center gap-2"
                >
                    <span>Masuk</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </button>
            </form>
        </div>

        <!-- Footer -->
        <p class="text-center text-slate text-sm mt-6">
            &copy; 2026 Dapur Bunda Bahagia. All rights reserved.
        </p>
    </div>

</body>
</html>