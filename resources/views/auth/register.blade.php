<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-image: url("{{ asset('landingpage/assets/img/hero-bg-light.webp') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>
</head>
<body class="h-screen flex items-center justify-center relative">

    <!-- Overlay Gelap -->
    <div class="absolute inset-0 bg-black bg-opacity-60"></div>

    <!-- Kotak Registrasi dengan Blur Pekat -->
    <div class="relative w-full max-w-md bg-white bg-opacity-30 backdrop-blur-lg p-8 rounded-xl shadow-xl">
        <h2 class="text-2xl font-bold text-center text-white mb-6">Registrasi</h2>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 mb-4 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <!-- Input Nama -->
            <div class="mb-4">
                <label for="name" class="block text-white">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white bg-opacity-50 text-gray-900">
            </div>

            <!-- Input Email -->
            <div class="mb-4">
                <label for="email" class="block text-white">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white bg-opacity-50 text-gray-900">
            </div>

            <!-- Input Nomor Handphone -->
            <div class="mb-4">
                <label for="phone" class="block text-white">Nomor Handphone</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white bg-opacity-50 text-gray-900">
            </div>

            <!-- Input Password -->
            <div class="mb-4">
                <label for="password" class="block text-white">Password</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white bg-opacity-50 text-gray-900">
            </div>

            <!-- Konfirmasi Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-white">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white bg-opacity-50 text-gray-900">
            </div>

            <!-- Tombol Registrasi -->
            <div class="mb-4">
                <button type="submit"
                    class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition shadow-md">
                    Daftar
                </button>
            </div>

            <p class="text-center text-sm text-white">
                Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-300 hover:underline">Login</a>
            </p>
        </form>
    </div>
</body>
</html>
