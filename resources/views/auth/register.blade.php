<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Registrasi Akun BPS</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-[#F3E7DB]">

<div class="bg-white rounded-3xl shadow-2xl p-10 w-full max-w-md">
  <h2 class="text-2xl font-extrabold mb-2 text-center">Registrasi Akun BPS</h2>
  <p class="text-gray-500 text-center mb-6">Buat akun untuk akses dashboard</p>

  @if($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
      {{ $errors->first() }}
    </div>
  @endif

  <form method="POST" action="/register" class="space-y-5">
    @csrf

    <input
      type="text"
      name="name"
      class="w-full border p-4 rounded-xl"
      placeholder="Nama Lengkap"
      value="{{ old('name') }}"
      required
    >

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

    <input
      type="password"
      name="password_confirmation"
      class="w-full border p-4 rounded-xl"
      placeholder="Konfirmasi Password"
      required
    >

    <button
      type="submit"
      class="w-full bg-orange-500 text-white py-4 rounded-xl font-bold hover:bg-orange-600 transition"
    >
      Daftar
    </button>
  </form>

  <p class="text-center text-sm text-gray-500 mt-6">
    Sudah punya akun?
    <a href="/login" class="text-orange-600 font-semibold hover:underline">
      Login di sini
    </a>
  </p>
</div>

</body>
</html>
