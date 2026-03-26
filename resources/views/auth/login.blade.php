<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login Internal BPS</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-[#F3E7DB]">

<div class="bg-white rounded-3xl shadow-2xl p-10 w-full max-w-md">
  <h2 class="text-2xl font-extrabold mb-2 text-center">Login Internal BPS</h2>
  <p class="text-gray-500 text-center mb-6">Akses Dashboard Sensus Ekonomi 2026</p>

  @if($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
      {{ $errors->first() }}
    </div>
  @endif

  <form method="POST" action="/login" class="space-y-5">
    @csrf

    <input
      type="email"
      name="email"
      class="w-full border p-4 rounded-xl"
      placeholder="Email"
      value="{{ old('email') }}"
      required
    >

    <input
      type="password"
      name="password"
      class="w-full border p-4 rounded-xl"
      placeholder="Password"
      required
    >

    <button
      type="submit"
      class="w-full bg-orange-500 text-white py-4 rounded-xl font-bold hover:bg-orange-600 transition"
    >
      Masuk
    </button>
  </form>

  <p class="text-center text-sm text-gray-500 mt-6">
    Belum punya akun?
    <a href="/register" class="text-orange-600 font-semibold hover:underline">
      Daftar di sini
    </a>
  </p>
</div>

</body>
</html>
