@extends('layouts/start_html')

@include('layouts/components/navbar')
<h1 class=" text-3xl font-bold font-inter text-customblue text-center mt-20">Profil Saya</h1>
<section class=" w-full rounded-[12px] mb-20 mt-8 flex justify-center items-center">
<div class="bg-customblue p-[3%] flex items-center justify-center w-full shadow-xl rounded-[12px] max-w-md ">
  <div class="max-w-md w-full">
    <!-- Foto Profil -->
    <div class="flex justify-center mb-6">
      <img src="https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg" alt="Foto Profil" class="w-32 h-32 rounded-full border-4 border-indigo-500">
    </div>

    <!-- Form Input Nama -->
    <div class="mb-6">
      <label for="name" class="block text-white font-semibold mb-2">Nama Lengkap</label>
      <input type="text" id="name" name="name" placeholder="Masukkan Nama Anda" class="w-full px-4 py-2 border-2 border-blue-400 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
    </div>

    <!-- Deskripsi -->
    <div class="mb-6">
      <label for="description" class="block text-white font-semibold mb-2">Deskripsi</label>
      <textarea id="description" name="description" rows="4" placeholder="Masukkan deskripsi singkat tentang diri Anda" class="w-full px-4 py-2 border-2 border-blue-400 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
    </div>

    <!-- Informasi Kontak -->
    <div class="text-white space-y-4">
      <div class="flex items-center space-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12c0 4.418-3.582 8-8 8s-8-3.582-8-8 3.582-8 8-8 8 3.582 8 8z"></path>
        </svg>
        <span>Email: example@mail.com</span>
      </div>
      <div class="flex items-center space-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12c0 4.418-3.582 8-8 8s-8-3.582-8-8 3.582-8 8-8 8 3.582 8 8z"></path>
        </svg>
        <span>Telp: (123) 456-7890</span>
      </div>
    </div>

    <!-- Tombol Submit -->
    <div class="mt-6 flex flex-col gap-2">
    <button class="w-full py-2 bg-red-500 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400">Logout</button>
      <button class="w-full py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">Simpan Profil</button>
    </div>
  </div>
</div>
</section>

@include('layouts/components/footer')

@extends('layouts/end_html')