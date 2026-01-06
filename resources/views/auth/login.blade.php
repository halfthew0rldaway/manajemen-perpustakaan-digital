<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Perpustakaan Digital</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
    <link rel="stylesheet" href="/css/login-animations.css">
</head>

<body class="bg-purple-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo & Title -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-sky-300 rounded-full mb-4 shadow-lg logo-float">
                <span class="text-3xl">📚</span>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Perpustakaan Digital</h1>
            <p class="text-gray-600">Sistem Manajemen Perpustakaan</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-purple-200 login-card">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Masuk ke Akun</h2>

            <!-- Flash Messages -->
            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-300 p-4 mb-6 rounded-lg">
                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-300 p-4 mb-6 rounded-lg">
                    <p class="text-sm text-red-700">{{ $errors->first() }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-3 border-2 border-purple-200 rounded-lg focus:ring-2 focus:ring-sky-300/50 focus:border-sky-300 transition-all duration-200 bg-white @error('email') border-red-300 @enderror"
                        placeholder="admin@perpustakaan.test">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Password
                    </label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-3 border-2 border-purple-200 rounded-lg focus:ring-2 focus:ring-sky-300/50 focus:border-sky-300 transition-all duration-200 bg-white @error('password') border-red-300 @enderror"
                        placeholder="••••••••">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember"
                        class="h-4 w-4 text-sky-400 focus:ring-sky-300 border-purple-300 rounded">
                    <label for="remember" class="ml-2 block text-sm text-gray-700">
                        Ingat saya
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-sky-400 text-white py-3 px-4 rounded-lg font-bold shadow-xl hover:shadow-2xl focus:outline-none focus:ring-4 focus:ring-sky-300 transition-all duration-200 transform hover:scale-[1.02] hover:-translate-y-1 active:scale-[0.98] active:translate-y-0"
                    style="border-bottom: 5px solid #0284c7;">
                    Masuk
                </button>
            </form>

            <!-- Demo Credentials -->
            <div class="mt-6 p-4 bg-purple-50 rounded-lg border border-purple-200">
                <p class="text-xs font-semibold text-gray-700 mb-2">Demo Credentials:</p>
                <div class="text-xs text-gray-600 space-y-1">
                    <p><strong>Admin:</strong> admin@perpustakaan.test / password</p>
                    <p><strong>Petugas:</strong> petugas1@perpustakaan.test / password</p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <p class="text-center text-sm text-gray-600 mt-6">
            UAS Pemrograman Web Lanjut &copy; {{ date('Y') }}
        </p>
    </div>
</body>

</html>