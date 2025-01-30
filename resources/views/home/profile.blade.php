@extends('layouts/start_html')

@include('layouts/components/navbar')
@if (session('success'))
    <div class="w-full flex justify-center items-center my-4">
        <div class="bg-green-500 px-5 py-2 rounded-md w-1/2 text-white font-inter font-bold flex justify-center items-center">
            {{ session('success') }}
        </div>
    </div>
@endif
@error('any')
        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
@enderror

<h1 class=" text-3xl font-bold font-inter text-customblue text-center mt-20">Profil Akun Saya</h1>
<section class="w-full rounded-[12px] mb-20 mt-8 flex justify-center items-center">
<form action="/profile" method="post" class="bg-customblue p-[3%] flex items-center justify-center w-4/5 md:w-full shadow-xl rounded-[12px] max-w-md ">
  @csrf
  <div class="max-w-md w-full">
    <!-- Foto Profil -->
    <div class="flex justify-center mb-6">
      <img src="https://cdn-icons-png.flaticon.com/512/9815/9815472.png" alt="Foto Profil" class="w-32 h-32 rounded-full"> <!--border-4 border-indigo-500 -->
    </div>

    <!-- Form Input Nama -->
    <div class="mb-6">
      <label for="name" class="block text-white font-semibold mb-2">Nama Lengkap</label>
      <input type="text" required id="name" name="name" placeholder="Masukkan Nama Anda" value="{{$profile->name}}" class="w-full px-4 py-2 border-2 border-blue-400 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 font-inter">
      @error('name')
        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
      @enderror
    </div>

    <!-- Deskripsi -->
    <div class="mb-6">
      <label for="email" class="block text-white font-semibold mb-2">Email</label>
      <input type="text" required id="email" name="email" placeholder="Masukkan Email Anda" value="{{$profile->email}}" class="w-full px-4 py-2 border-2 border-blue-400 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 font-inter">
      @error('email')
        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-6">
      <label for="password" class="block text-white font-semibold mb-2">Password</label>
      <input type="text" id="password" name="password" placeholder="Masukkan Password Baru" class="w-full px-4 py-2 border-2 border-blue-400 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 font-inter">
      @error('password')
        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-6">
      <label for="" class="block text-white font-semibold mb-2">Nim</label>
      <input type="text" disabled value="{{$copr->nim}}" class="w-full px-4 py-2 border-2 border-blue-400 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-white font-bold font-inter">
    </div>

    <div class="mb-6">
      <label for="" class="block text-white font-semibold mb-2">Alamat</label>
      <input type="text" disabled value="{{$copr->address}}" class="w-full px-4 py-2 border-2 border-blue-400 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-white font-bold font-inter">
    </div>

    <div class="mb-6">
      <label for="" class="block text-white font-semibold mb-2">Nomor Telepon</label>
      <input type="text" disabled value="{{$copr->phone_number}}" class="w-full px-4 py-2 border-2 border-blue-400 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-white font-bold font-inter">
    </div>

    <div class="mb-6">
      <label for="" class="block text-white font-semibold mb-2">Tanggal Lahir</label>
      <input type="date" disabled value="{{$copr->dob}}" class="w-full px-4 py-2 border-2 border-blue-400 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-white font-bold font-inter">
    </div>

    <div class="mb-6">
      <label for="" class="block text-white font-semibold mb-2">Program Studi</label>
      <input type="text" disabled value="{{$copr->study_program->name}}" class="w-full px-4 py-2 border-2 border-blue-400 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-white font-bold font-inter">
    </div>

    <div class="mb-6">
      <label for="" class="block text-white font-semibold mb-2">Fakultas</label>
      <input type="text" disabled value="{{$copr->faculty->name}}" class="w-full px-4 py-2 border-2 border-blue-400 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-white font-bold font-inter">
    </div>

    <!-- Informasi Kontak -->
    <!-- <div class="text-white space-y-4">
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
    </div> -->

    <!-- Tombol Submit -->
    <div class="mt-6 flex flex-col gap-2">
      <a href="logout" class="w-full py-2 bg-red-500 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-400 text-center font-inter font-bold"><button>Logout</button></a>
      <button type="submit" class="w-full py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 font-inter font-bold">Simpan Profil</button>
    </div>
  </div>
</form>
</section>

@include('layouts/components/footer')

@extends('layouts/end_html')