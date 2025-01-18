@extends('layouts/start_html')
@if(session('success'))
<div id="successMessage" class=" z-[1000] w-full flex justify-center items-center my-4">
        <div class="bg-green-500 px-5 py-2 rounded-md text-white font-inter font-bold flex justify-between items-center">
            <span>{{session('success')}}</span>
            <button onclick="closeMessage()" class="ml-4 text-white text-lg font-bold">
                &times; <!-- Simbol 'x' -->
            </button>
        </div>
</div>
@endif

<section class="my-top">
    <h1 class=" text-3xl font-bold font-inter text-customblue text-center mt-20">Pengaduan Mahasiswa</h1>
    <div class="flex justify-center items-center">
        <p class="w-1/2 font-inter font-normal text-center text-customblue opacity-50">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
    </div>
</section>

@include('layouts/components/navbar')

<section class="my-search bg-customgray bg-opacity-40 mt-20 px-4 sm:px-6 md:px-[10%] flex justify-center items-center flex-col">
    <form action="{{route('search_complaint_by_id')}}" method="post" class="form-input flex flex-col gap-4 w-full mt-24 my-20">
        @csrf
        <!-- Teks di atas -->
        <p class="text-customblue font-inter font-bold mb-2 text-center sm:text-left">
            Sudah Pernah Melakukan Pengaduan? Cek Disini
        </p>

        <!-- Input dan Button dalam satu baris -->
        <div class="flex flex-col sm:flex-row w-full gap-4">
            <!-- Input Field -->
            <input type="number" maxlength="17" required name="keyword" placeholder="Contoh : 20250116015433001 (Kode Unik 17 Digit)"
                class="px-5 py-3 rounded-[12px] w-full sm:w-[75%] bg-customgray2 border-[3px] border-customblue border-opacity-50 font-inter font-bold text-customblue">
            <!-- Button -->
            <button type="submit"
                class="text-white font-inter font-bold bg-customblue px-6 py-3 w-full sm:w-[24%] rounded-[12px] border-[3px] border-customblue">
                Cari Aduan
            </button>
        </div>
        @if (session('error_search'))
            <p id="error-search-message" class="flex justify-between items-center text-left font-inter font-bold bg-red-500 text-white px-3 py-1 rounded-lg">
                <span>{{session('error_search')}}</span> 
                <!-- <button onclick="closeErrorSearchMessage()" class="ml-4 text-white text-lg font-bold">
                    &times; 
                </button> -->
            </p>
        @endif

        <!-- Teks di bawah input dan button -->
        <p class="text-customblue font-inter mt-4 text-center sm:text-left flex justify-center">
            <span class="font-medium">Ingin melakukan pengaduan?</span>
            <a href="#" class="font-bold">Login Sekarang</a>
        </p>
    </form>
</section>

<section class="my-top-aduan flex flex-col items-center justify-center pb-12">
    <h1 class="text-3xl font-bold font-inter text-customblue text-center mt-20">Pengaduan Dengan Dukungan Teratas</h1>

    <!-- Grid Section for Cards -->
    <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-8 px-[10%]">
        <!-- Card 1 -->
         @if ($top_complaints->isNotEmpty())
         @foreach ($top_complaints as $complaint)
            <a href="/detail/{{$complaint->id}}" class="bg-white overflow-hidden rounded-[16px] shadow-lg min-w-[356px] w-full">
                @php
                    $firstAttachment = $complaint->attachments->first(); // Ambil attachment pertama, atau null jika kosong
                @endphp
                @if($firstAttachment)
                <img class="w-full h-[180px] object-cover" 
                    src="{{$firstAttachment->file_type == 'pdf' ? 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSXHQMBA2g77jAGv-GHfYOMYae4yuAwYcsAzg&s' : $firstAttachment->path_file}}" 
                    alt="gambar">
                @else
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQppJKxBxJI-9UWLe2VVmzuBd24zsq4_ihxZw&s" alt="Card Image" class="w-full h-[180px] object-cover">
                @endif
                <div class="flex flex-col p-5 justify-between">
                    <div class="flex justify-between items-center">
                        <h2 class="font-inter text-md font-bold text-customblue">{{$complaint->id}}</h2>
                        <div class="font-inter text-white text-sm font-bold bg-green-500 px-[3%] flex justify-center items-center rounded-[4px]">
                            <p>{{ $complaint->logs()->latest()->first()->name ?? 'belum ada logs' }}</p>
                        </div>
                    </div>
                    <h2 class="font-inter text-sm font-semibold text-customblue text-opacity-70">{{ \Carbon\Carbon::parse($complaint->created_at)->translatedFormat('d F Y') }}</h2>
                    <p class="text-sm text-gray-600">{{ \Str::limit($complaint->description, 100)}}</p>
                    <div class="font-inter text-sm font-bold flex items-center justify-end">
                        <p type="submit" class="flex justify-start items-center text-[16px] text-green-400"><ion-icon name="bookmark"></ion-icon></p>
                        <p class="text-customblue">{{$complaint->supports->count()}} dukungan</p>
                    </div>
                </div>
            </a>
        @endforeach

        @else
            @include('layouts/components/empty-complaint')
        @endif
<!--         
        <div class="bg-white overflow-hidden rounded-[16px] shadow-lg" style="width: 100%; max-width: 356px;">
            <img src="https://via.placeholder.com/356x295" alt="Card Image" class="w-full h-[180px] object-cover">
            <div class="flex flex-col p-5">
                <div class="flex justify-between items-center">
                    <h2 class="font-inter text-md font-bold text-customblue">XJAHSHAGSJ</h2>
                    <div class="font-inter text-white text-sm font-bold bg-green-500 px-[3%] flex justify-center items-center rounded-[4px]">
                        <p>Terverifikasi</p>
                    </div>
                </div>
                <h2 class="font-inter text-sm font-semibold text-customblue text-opacity-70">Senin, 6 Januari 2025</h2>
                <p class="text-sm text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <form class="font-inter text-sm font-bold flex items-center">
                    <button type="submit" class="flex justify-start items-center text-[16px] text-gray-400"><ion-icon name="bookmark"></ion-icon></button>
                    <p class="text-customblue">6 Dukungan</p>
                </form>
            </div>
        </div>
        
        <div class="bg-white overflow-hidden rounded-[16px] shadow-lg" style="width: 100%; max-width: 356px;">
            <img src="https://via.placeholder.com/356x295" alt="Card Image" class="w-full h-[180px] object-cover">
            <div class="flex flex-col p-5">
                <div class="flex justify-between items-center">
                    <h2 class="font-inter text-md font-bold text-customblue">XJAHSHAGSJ</h2>
                    <div class="font-inter text-white text-sm font-bold bg-green-500 px-[3%] flex justify-center items-center rounded-[4px]">
                        <p>Terverifikasi</p>
                    </div>
                </div>
                <h2 class="font-inter text-sm font-semibold text-customblue text-opacity-70">Senin, 6 Januari 2025</h2>
                <p class="text-sm text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <form class="font-inter text-sm font-bold flex items-center">
                    <button type="submit" class="flex justify-start items-center text-[16px] text-gray-400"><ion-icon name="bookmark"></ion-icon></button>
                    <p class="text-customblue">6 Dukungan</p>
                </form>
            </div>
        </div>
        
        <div class="bg-white overflow-hidden rounded-[16px] shadow-lg" style="width: 100%; max-width: 356px;">
            <img src="https://via.placeholder.com/356x295" alt="Card Image" class="w-full h-[180px] object-cover">
            <div class="flex flex-col p-5">
                <div class="flex justify-between items-center">
                    <h2 class="font-inter text-md font-bold text-customblue">XJAHSHAGSJ</h2>
                    <div class="font-inter text-white text-sm font-bold bg-green-500 px-[3%] flex justify-center items-center rounded-[4px]">
                        <p>Terverifikasi</p>
                    </div>
                </div>
                <h2 class="font-inter text-sm font-semibold text-customblue text-opacity-70">Senin, 6 Januari 2025</h2>
                <p class="text-sm text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <form class="font-inter text-sm font-bold flex items-center">
                    <button type="submit" class="flex justify-start items-center text-[16px] text-gray-400"><ion-icon name="bookmark"></ion-icon></button>
                    <p class="text-customblue">6 Dukungan</p>
                </form>
            </div>
        </div>

        
        <div class="bg-white overflow-hidden rounded-[16px] shadow-lg" style="width: 100%; max-width: 356px;">
            <img src="https://via.placeholder.com/356x295" alt="Card Image" class="w-full h-[180px] object-cover">
            <div class="flex flex-col p-5">
                <div class="flex justify-between items-center">
                    <h2 class="font-inter text-md font-bold text-customblue">XJAHSHAGSJ</h2>
                    <div class="font-inter text-white text-sm font-bold bg-green-500 px-[3%] flex justify-center items-center rounded-[4px]">
                        <p>Terverifikasi</p>
                    </div>
                </div>
                <h2 class="font-inter text-sm font-semibold text-customblue text-opacity-70">Senin, 6 Januari 2025</h2>
                <p class="text-sm text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <form class="font-inter text-sm font-bold flex items-center">
                    <button type="submit" class="flex justify-start items-center text-[16px] text-gray-400"><ion-icon name="bookmark"></ion-icon></button>
                    <p class="text-customblue">6 Dukungan</p>
                </form>
            </div>
        </div>

        
        <div class="bg-white overflow-hidden rounded-[16px] shadow-lg" style="width: 100%; max-width: 356px;">
            <img src="https://via.placeholder.com/356x295" alt="Card Image" class="w-full h-[180px] object-cover">
            <div class="flex flex-col p-5">
                <div class="flex justify-between items-center">
                    <h2 class="font-inter text-md font-bold text-customblue">XJAHSHAGSJ</h2>
                    <div class="font-inter text-white text-sm font-bold bg-green-500 px-[3%] flex justify-center items-center rounded-[4px]">
                        <p>Terverifikasi</p>
                    </div>
                </div>
                <h2 class="font-inter text-sm font-semibold text-customblue text-opacity-70">Senin, 6 Januari 2025</h2>
                <p class="text-sm text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <form class="font-inter text-sm font-bold flex items-center">
                    <button type="submit" class="flex justify-start items-center text-[16px] text-gray-400"><ion-icon name="bookmark"></ion-icon></button>
                    <p class="text-customblue">6 Dukungan</p>
                </form>
            </div>
        </div> -->
    </div>
</section>

<section class="my-langkah bg-customgray bg-opacity-40 pb-20 pt-8 mt-20 px-[10%] justify-center items-center flex-col lg:block md:block hidden">
    <h1 class="text-3xl font-bold font-inter text-customblue text-center mt-20 mb-8">Langkah Langkah Melakukan Pengaduan</h1>
    <div class="bg-customblue rounded-[20px] w-full mt-4 mb-8 p-[5%] flex flex-wrap justify-around items-center">
        <!-- content 1 -->
        <div class="flex flex-col justify-center items-center">
            <div class="rounded-full w-[50px] h-[50px] bg-orange-500 flex justify-center items-center text-white mb-[5%]">
                <ion-icon class="text-[28px]" name="person"></ion-icon>
            </div>
            <p class="text-white font-inter font-bold text-sm">Login / Registrasi</p>
        </div>

        <div class="flex justify-center items-center">
            <ion-icon name="remove" class="text-[20px] text-orange-500"></ion-icon>
            <ion-icon name="remove" class="text-[20px] text-orange-500"></ion-icon>
            <ion-icon name="arrow-forward" class="text-[20px] text-orange-500"></ion-icon>
        </div>

        <div class="flex flex-col justify-center items-center">
            <div class="rounded-full w-[50px] h-[50px] bg-orange-500 flex justify-center items-center text-white mb-[5%]">
                <ion-icon class="text-[28px]" name="document"></ion-icon>
            </div>
            <p class="text-white font-inter font-bold text-sm ">Isi Formulir</p>
        </div>

        <div class="flex justify-center items-center">
            <ion-icon name="remove" class="text-[20px] text-orange-500"></ion-icon>
            <ion-icon name="remove" class="text-[20px] text-orange-500"></ion-icon>
            <ion-icon name="arrow-forward" class="text-[20px] text-orange-500"></ion-icon>
        </div>

        <div class="flex flex-col justify-center items-center">
            <div class="rounded-full w-[50px] h-[50px] bg-orange-500 flex justify-center items-center text-white mb-[5%]">
                <ion-icon class="text-[28px]" name="lock"></ion-icon>
            </div>
            <p class="text-white font-inter font-bold text-sm ">Pahami Kebijakan</p>
        </div>

        <div class="flex justify-center items-center">
            <ion-icon name="remove" class="text-[20px]  text-orange-500"></ion-icon>
            <ion-icon name="remove" class="text-[20px]  text-orange-500"></ion-icon>
            <ion-icon name="arrow-forward" class="text-[20px]  text-orange-500"></ion-icon>
        </div>

        <div class="flex flex-col justify-center items-center">
            <div class="rounded-full w-[50px] h-[50px]  bg-orange-500 flex justify-center items-center text-white mb-[5%]">
                <ion-icon class="text-[28px]" name="send"></ion-icon>
            </div>
            <p class="text-white font-inter font-bold text-sm ">Kirim Laporan</p>
        </div>
    </div>

    <div class="w-full flex justify-center items-center mb-20">
        <a href="buat-aduan" class="bg-customblue text-white rounded-[16px] text-inter font-bold px-5 py-3 w-fit">Buat Pengaduan Sekarang</a>
    </div>
</section>

<section class="my-langkah-sm bg-customgray bg-opacity-40 mt-20 px-[10%] sm:px-[5%] flex justify-center items-center flex-col lg:hidden md:hidden">
    <h1 class="text-3xl sm:text-2xl font-bold font-inter text-customblue text-center mt-20 my-4">Langkah Langkah Melakukan Pengaduan</h1>
    <div class="w-full mt-4 mb-8 p-[5%] flex flex-wrap flex-col justify-around items-center ">
        <!-- content 1 -->
        <div class="bg-customblue flex gap-2 rounded-[25px] items-center w-full mb-2">
            <div class="rounded-full w-[40px] h-[40px] bg-orange-500 flex justify-center items-center text-white text-bold">
                <p class="text-bold">1</p>
            </div>
            <p class="text-white font-inter font-bold text-sm sm:text-xs">Isi Formulir</p>
        </div>
        <div class="bg-customblue flex gap-2 rounded-[25px] items-center w-full mb-2">
            <div class="rounded-full w-[40px] h-[40px] bg-orange-500 flex justify-center items-center text-white text-bold">
                <p class="text-bold">2</p>
            </div>
            <p class="text-white font-inter font-bold text-sm sm:text-xs">Isi Formulir</p>
        </div>
        <div class="bg-customblue flex gap-2 rounded-[25px] items-center w-full mb-2">
            <div class="rounded-full w-[40px] h-[40px] bg-orange-500 flex justify-center items-center text-white text-bold">
                <p class="text-bold">3</p>
            </div>
            <p class="text-white font-inter font-bold text-sm sm:text-xs">Isi Formulir</p>
        </div>
        <div class="bg-customblue flex gap-2 rounded-[25px] items-center w-full mb-2">
            <div class="rounded-full w-[40px] h-[40px] bg-orange-500 flex justify-center items-center text-white text-bold">
                <p class="text-bold">4</p>
            </div>
            <p class="text-white font-inter font-bold text-sm sm:text-xs">Isi Formulir</p>
        </div>
        <div class="bg-customblue flex gap-2 rounded-[25px] items-center w-full mb-2">
            <div class="rounded-full w-[40px] h-[40px] bg-orange-500 flex justify-center items-center text-white text-bold">
                <p class="text-bold">5</p>
            </div>
            <p class="text-white font-inter font-bold text-sm sm:text-xs">Isi Formulir</p>
        </div>
        <div class="bg-customblue flex gap-2 rounded-[25px] items-center w-full mb-2">
            <div class="rounded-full w-[40px] h-[40px] bg-orange-500 flex justify-center items-center text-white text-bold">
                <p class="text-bold">6</p>
            </div>
            <p class="text-white font-inter font-bold text-sm sm:text-xs">Isi Formulir</p>
        </div>
    </div>

    <div class="w-full flex justify-center items-center mb-20">
        <p class="bg-customblue text-white rounded-[16px] text-inter font-bold px-5 py-3 w-fit text-sm sm:text-xs">Buat Pengaduan Sekarang</p>
    </div>
</section>

<script>
    function closeMessage() {
        const messageBox = document.getElementById('successMessage');
        if (messageBox) {
            messageBox.style.display = 'none';
        }
    }
    function closeErrorSearchMessage() {
        const messageBox = document.getElementById('error-search-message');
        if (messageBox) {
            messageBox.style.display = 'none';
        }
    }
</script>

@include('layouts/components/footer')

@extends('layouts/end_html')