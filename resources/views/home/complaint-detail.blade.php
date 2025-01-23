@extends('layouts/start_html')

@include('layouts/components/navbar')

@if (session('success'))
<div id="successMessage" class=" z-[1000] w-full flex justify-center items-center my-4">
    <div class="bg-green-500 px-5 py-2 rounded-md text-white font-inter font-bold flex justify-between items-center">
        <span>{{session('success')}}</span>
        <button onclick="closeMessage()" class="ml-4 text-white text-lg font-bold">
            &times; <!-- Simbol 'x' -->
        </button>
    </div>
</div>
@endif

<div id="loginModal" class="font-inter fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-lg w-96 p-6">
        <h2 class="text-xl font-bold text-gray-800">Login Diperlukan</h2>
        <p class="mt-4 text-gray-600">Anda perlu login untuk mendukung aduan ini.</p>
        <div class="mt-6 flex justify-end gap-2">
            <button
                onclick="hideLoginModal()"
                class="bg-gray-300 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-400">
                Batal
            </button>
            <a
                href="{{ route('user-login') }}"
                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                Login
            </a>
        </div>
    </div>
</div>

<h1 class="text-3xl font-bold font-inter text-customblue text-center mt-20">Detail Aduan</h1>

<section class="mt-8 mb-20 px-[5%]">
    <div class="flex flex-col md:flex-row w-full rounded-[12px] overflow-hidden gap-4">
        <!-- Left Section -->
        <div class="border-gray-300 bg-customgray md:w-[70%] w-full">
            <div class="flex justify-between items-center px-5 py-3">
                <div class="">
                    <p class="text-customblue font-bold font-inter">Rincian Aduan : {{$complaint->id}}</p>
                </div>
                <p class="bg-green-400 w-fit h-fit text-white font-bold font-inter px-2 py-1 rounded-md">{{ $complaint->logs()->latest()->first()->name ?? 'belum ada logs' }}</p>
            </div>
            <hr class="border-[1px] border-customgray2">
            <div class="flex-2 p-5">
                <div class="grid grid-cols-3 gap-4 mb-5">
                    @foreach ($complaint->attachments as $attachment)
                    @if ($attachment->file_type == 'pdf')
                    <div class="w-24 h-auto bg-gray-200 rounded-lg overflow-hidden">
                        <!-- <embed src="{{ $attachment->path_file }}" type="application/pdf" class="w-full h-full" /> -->
                        <div class="flex flex-col justify-center items-center overflow-hidden">
                            <img src="https://cdn-icons-png.freepik.com/256/16425/16425681.png?semt=ais_hybrid" alt="">
                            <a href="{{ route('attachments.download', $attachment->id) }}" class="bg-blue-400 p-1 font-inter font-semibold text-white rounded-lg px-3 py-1">Download</a>
                        </div>
                    </div>
                    @else
                    <img src="{{ $attachment->path_file }}" alt="Image" class="bg-red-500 w-full h-32 object-cover rounded-lg cursor-pointer hover:scale-105 transition-transform" onclick="showImageModal(this)">
                    @endif
                    @endforeach
                </div>
                <div class="bg-customgray2 p-4 rounded-lg shadow">
                    <p class="text-customblue opacity-70 font-inter font-medium">{{$complaint->location_id}} - {{ \Carbon\Carbon::parse($complaint->created_at)->translatedFormat('d F Y') }}</p>
                    <p class="font-inter text-customblue">{{$complaint->description}}</p>
                </div>
            </div>
            <hr class="border-[1px] border-customgray2">
            <div class="flex lg:justify-between lg:items-center gap-1 lg:gap-0 px-5 py-3 flex-col lg:flex-row">
                <button class="flex justify-center items-center gap-1 bg-red-400 w-fit h-fit text-white font-bold font-inter px-2 py-1 rounded-md">
                    <ion-icon name="share"></ion-icon>
                    <p>Bagikan</p>
                </button>
                @if (Auth::check())
                @if ($supported)
                <form action="{{$complaint->id}}/del-support" method="post">
                    @csrf
                    <button type="submit" class="flex justify-center items-center gap-1 bg-green-600 w-fit h-fit text-white font-bold font-inter px-2 py-1 rounded-md">
                        <ion-icon class="text-sm" name="bookmark"></ion-icon>
                        <p>{{$complaint->supports->count()}} Orang Mendukung</p>
                    </button>
                </form>
                @else
                <form action="{{$complaint->id}}/add-support" method="post">
                    @csrf
                    <button type="submit" class="flex justify-center items-center gap-1 bg-green-400 w-fit h-fit text-white font-bold font-inter px-2 py-1 rounded-md">
                        <ion-icon class="text-sm" name="bookmark"></ion-icon>
                        <p>{{$complaint->supports->count()}} Orang Mendukung</p>
                    </button>
                </form>
                @endif
                @else
                <button onclick="showLoginModal()" type="button" class="flex justify-center items-center gap-1 bg-green-400 w-fit h-fit text-white font-bold font-inter px-2 py-1 rounded-md">
                    <ion-icon class="text-sm" name="bookmark"></ion-icon>
                    <p>{{$complaint->supports->count()}} Orang Mendukung</p>
                </button>
                @endif

            </div>
        </div>

        <!-- Right Section -->
        <div class="flex-1 p-5 bg-customgray font-inter md:w-[30%] w-full">
            <div class="mb-5">
                <h3 class="text-lg font-semibold mb-3 text-customblue">Progress Aduan</h3>
                <div class="text-sm flex flex-col gap-2">
                    @foreach($complaint->logs as $log)
                    @php
                    $bgColor = '';
                    $textColor = 'text-black'; 

                    switch ($log->name) {
                    case 'dikirim':
                    $bgColor = 'bg-blue-500';
                    $textColor = 'text-white';
                    break;
                    case 'diterima':
                    $bgColor = 'bg-green-500';
                    $textColor = 'text-white';
                    break;
                    case 'ditinjau':
                    $bgColor = 'bg-yellow-500';
                    $textColor = 'text-black';
                    break;
                    case 'diproses':
                    $bgColor = 'bg-orange-500';
                    $textColor = 'text-white';
                    break;
                    case 'selesai':
                    $bgColor = 'bg-teal-500';
                    $textColor = 'text-white';
                    break;
                    case 'ditolak':
                    $bgColor = 'bg-red-500';
                    $textColor = 'text-white';
                    break;
                    case 'dibatalkan':
                    $bgColor = 'bg-gray-500';
                    $textColor = 'text-white';
                    break;
                    case 'ditangguhkan':
                    $bgColor = 'bg-purple-500';
                    $textColor = 'text-white';
                    break;
                    default:
                    $bgColor = 'bg-white';
                    $textColor = 'text-black';
                    break;
                    }
                    @endphp

                    <div class="px-3 py-1 rounded-md flex justify-between items-center {{$bgColor}}">
                        <div class="">
                            <div class="flex gap-2">
                                <p class="font-semibold {{$textColor}}">{{ ucfirst($log->name) }}</p>
                                @if ($log->employee_id)
                                <p class="{{$textColor}}">-</p>
                                <p class="font-semibold {{$textColor}}">{{$log->employee->user->name}}</p>
                                @endif
                            </div>
                            <p class="text-sm {{ $textColor }}">{{ \Carbon\Carbon::parse($log->created_at)->translatedFormat('d F Y') }}</p>
                        </div>
                        @if ($log->path_file)
                        <div class="">
                            <img class="w-10 cursor-pointer" onclick="showImageModal(this)" src="{{asset('BrandLogo.jpg')}}" alt="">
                        </div>
                        @else
                        <div class="">
                            <p class="font-inter text-sm {{ $textColor }}">Tidak ada gambar</p>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center" id="modal-overlay" onclick="closeImageModal()">
        <div class="p-4 rounded-lg shadow">
            <img src="" alt="Modal Image" id="modal-image" class="max-w-full max-h-screen">
        </div>
    </div>
</section>

<script>
    function showImageModal(image) {
        const modalImage = document.getElementById('modal-image');
        const modalOverlay = document.getElementById('modal-overlay');
        modalImage.src = image.src;
        modalOverlay.classList.remove('hidden');
    }

    function closeImageModal() {
        const modalOverlay = document.getElementById('modal-overlay');
        modalOverlay.classList.add('hidden');
    }

    function showLoginModal() {
        document.getElementById('loginModal').classList.remove('hidden');
    }

    function hideLoginModal() {
        document.getElementById('loginModal').classList.add('hidden');
    }

    function closeMessage() {
        const messageBox = document.getElementById('successMessage');
        if (messageBox) {
            messageBox.style.display = 'none';
        }
    }
</script>

@include('layouts/components/footer')

@extends('layouts/end_html')