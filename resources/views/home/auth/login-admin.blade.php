@extends('layouts/start_html')

<div class="bg-customblue w-full h-screen overflow-hidden">
<!-- @if (session('success'))
    <div class="w-full flex justify-center items-center my-4">
        <div class="bg-green-500 px-3 py-1 rounded-md w-fit text-white font-inter font-bold">
            {{ session('success') }}
        </div>
    </div>
@endif -->
<section class="p-[10%] pt-20">
<h1 class="text-3xl font-bold font-inter text-white text-center">Login Admin</h1>
<div class="flex w-full justify-center items-center">
    <img class="w-8" src="{{asset('BrandLogo.jpg')}}" alt="">
    <h1 class="text-xl font-bold font-inter text-white text-center">Keluh Kampus</h1>
</div>
    <form action="{{route('admin-login')}}" method="post" class="w-full mt-8 max-w-md mx-auto bg-customgray p-6 rounded-lg shadow">
        @csrf
        <div class="mb-4">
            <label for="email_login" class="block text-customblue font-bold mb-2">Email</label>
            <input type="email" id="email_login" name="email" value="{{ old('email') }}" class="w-full p-3 rounded bg-white border border-gray-300 focus:outline-none focus:ring-2 focus:ring-customblue">
            @error('email')
                <div class="text-red-500 text-sm font-inter font-bold mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="password_login" class="block text-customblue font-bold mb-2">Password</label>
            <input type="password" id="password_login" name="password" class="w-full p-3 rounded bg-white border border-gray-300 focus:outline-none focus:ring-2 focus:ring-customblue">
            @error('password')
                <div class="text-red-500 text-sm font-inter font-bold mt-1">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="w-full bg-customblue text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition">Login</button>
    </form>
</section>
</div>
@extends('layouts/end_html')
