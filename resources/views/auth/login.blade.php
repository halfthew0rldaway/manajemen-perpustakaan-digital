<!DOCTYPE html>
<html lang="id" class="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Perpustakaan Digital</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Source+Serif+4:wght@400;600;700&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --bg-primary: #F8FAFC;
            --bg-card: #FFFFFF;
            --border-color: #E2E8F0;
            --text-primary: #1E293B;
            --text-secondary: #475569;
            --text-muted: #64748B;
            --accent: #3B8E91;
            --accent-hover: #317A7D;
            --accent-subtle: rgba(59, 142, 145, 0.08);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #F8FAFC 0%, #E2E8F0 100%);
            color: var(--text-primary);
            min-height: 100vh;
        }

        .heading {
            font-family: 'Source Serif 4', Georgia, serif;
        }

        .login-container {
            max-width: 480px;
            margin: 0 auto;
        }

        .login-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.875rem 1.5rem;
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            color: white;
            background-color: var(--accent);
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.2s ease;
            cursor: pointer;
            position: relative;
            transform: translateY(0);
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            right: 0;
            height: 3px;
            background-color: var(--accent-hover);
            border-radius: 0 0 0.5rem 0.5rem;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background-color: var(--accent-hover);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.15), 0 4px 6px -2px rgba(0, 0, 0, 0.1);
        }

        .btn-primary:hover::before {
            height: 4px;
            bottom: -4px;
        }

        .btn-primary:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px -1px rgba(0, 0, 0, 0.1);
        }

        .btn-primary:active::before {
            height: 2px;
            bottom: -2px;
        }

        .form-input {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid var(--border-color);
            border-radius: 0.5rem;
            background-color: var(--bg-card);
            color: var(--text-primary);
            font-family: 'Inter', sans-serif;
            font-size: 0.9375rem;
            transition: all 0.2s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px var(--accent-subtle);
        }

        .form-input::placeholder {
            color: var(--text-muted);
        }

        .logo-container {
            width: 64px;
            height: 64px;
            background-color: var(--accent);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            box-shadow: 0 4px 6px -1px rgba(59, 142, 145, 0.3);
        }

        .info-box {
            background-color: var(--accent-subtle);
            border: 1px solid var(--border-color);
            border-left: 3px solid var(--accent);
            border-radius: 0.5rem;
            padding: 1rem;
        }
    </style>
</head>

<body class="flex items-center justify-center p-4">
    <div class="login-container w-full">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="logo-container">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <h1 class="heading text-3xl font-bold mb-2" style="color: var(--text-primary);">Perpustakaan Digital</h1>
            <p class="text-base" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">Sistem
                Manajemen Perpustakaan</p>
        </div>

        <!-- Login Card -->
        <div class="login-card p-8">
            <div class="mb-8">
                <h2 class="heading text-2xl font-semibold mb-2" style="color: var(--text-primary);">Selamat Datang</h2>
                <p class="text-sm" style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">Silakan masuk
                    dengan akun Anda</p>
            </div>

            <!-- Flash Messages -->
            @if(session('success'))
                <div class="mb-6 p-4 rounded-lg"
                    style="background-color: var(--accent-subtle); border-left: 3px solid var(--accent);">
                    <p class="text-sm font-medium" style="color: var(--accent); font-family: 'Inter', sans-serif;">
                        {{ session('success') }}</p>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 rounded-lg"
                    style="background-color: rgba(220, 38, 38, 0.08); border-left: 3px solid #DC2626;">
                    <p class="text-sm font-medium" style="color: #DC2626; font-family: 'Inter', sans-serif;">
                        {{ $errors->first() }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold mb-2"
                        style="color: var(--text-primary); font-family: 'Inter', sans-serif;">
                        Alamat Email
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                        class="form-input @error('email') border-red-500 @enderror" placeholder="nama@email.com">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold mb-2"
                        style="color: var(--text-primary); font-family: 'Inter', sans-serif;">
                        Kata Sandi
                    </label>
                    <input type="password" name="password" id="password" required
                        class="form-input @error('password') border-red-500 @enderror"
                        placeholder="Masukkan kata sandi">
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="h-4 w-4 rounded"
                        style="color: var(--accent); border-color: var(--border-color);">
                    <label for="remember" class="ml-2 text-sm font-medium"
                        style="color: var(--text-primary); font-family: 'Inter', sans-serif;">
                        Ingat saya
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-primary w-full">
                    <span>Masuk ke Sistem</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </form>

            <!-- Demo Credentials -->
            <div class="mt-6 info-box">
                <p class="text-xs font-semibold mb-2"
                    style="color: var(--text-primary); font-family: 'Inter', sans-serif;">
                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Akun Demo
                </p>
                <div class="text-xs space-y-1.5"
                    style="color: var(--text-secondary); font-family: 'Inter', sans-serif;">
                    <div class="flex items-center justify-between p-2 rounded" style="background-color: white;">
                        <span class="font-medium">Admin:</span>
                        <code class="text-xs px-2 py-1 rounded"
                            style="background-color: var(--accent-subtle); color: var(--accent);">admin@perpustakaan.test</code>
                    </div>
                    <div class="flex items-center justify-between p-2 rounded" style="background-color: white;">
                        <span class="font-medium">Petugas:</span>
                        <code class="text-xs px-2 py-1 rounded"
                            style="background-color: var(--accent-subtle); color: var(--accent);">petugas1@perpustakaan.test</code>
                    </div>
                    <p class="text-center pt-2" style="color: var(--text-muted);">Password: <strong>password</strong>
                    </p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="text-sm" style="color: var(--text-muted); font-family: 'Inter', sans-serif;">
                &copy; {{ date('Y') }} Perpustakaan Digital. UAS Pemrograman Web Lanjut.
            </p>
        </div>
    </div>
</body>

</html>