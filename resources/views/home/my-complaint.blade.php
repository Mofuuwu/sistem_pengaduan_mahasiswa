@extends('layouts/start_html')
@include('layouts/components/navbar')

@if (!auth()->check())
    @include('layouts/components/need-login')
@else
<section class="top-content w-full mt-20 relative flex flex-col justify-center items-center">
    <!-- Tombol Filter -->
    <div class="w-full flex justify-center gap-2">
        <button id="btn-filters" onclick="toggleFilter()" class="transition-colors duration-300 ease-in-out text-customblue bg-customgray p-2 rounded-[12px]">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
            </svg>
        </button>
        <button id="btn-my-complaint" onclick="showMyComplaint()" class="transition-colors duration-300 ease-in-out bg-customblue text-white py-2 px-5 rounded-[12px] flex justify-center items-center">
            <p class="font-inter font-bold">Aduan Saya</p>
        </button>
        <button id="btn-supported-complaint" onclick="showSupportedComplaint()" class="transition-colors duration-300 ease-in-out bg-customgray text-customblue py-2 px-5 rounded-[12px] flex justify-center items-center">
            <p class="font-inter font-bold">Aduan Didukung</p>
        </button>
    </div>

    <!-- Tab Filter (Hidden by default) -->
    <form id="filter-section" class="transition-all duration-500 ease-in-out hidden transform w-full md:w-1/2 lg:w-1/2 max-w-[90%] mt-2 bg-customblue rounded-[12px] shadow-md p-4">
        <!-- Filter content (header, checkboxes, labels) -->
        <h1 class="text-center text-white font-inter font-bold">Filter</h1>
        <div class="flex flex-col gap-4">
            <div class="text-white font-inter">
                <h2 class="font-bold">Lokasi</h2>
                <div class="flex gap-2 flex-wrap">
                    <div class="flex items-center text-sm">
                        <input type="checkbox" id="filter1" class="mr-2">
                        <label for="filter1">Toilet</label>
                    </div>
                    <div class="flex items-center text-sm">
                        <input type="checkbox" id="filter2" class="mr-2">
                        <label for="filter2">Aula</label>
                    </div>
                    <div class="flex items-center text-sm">
                        <input type="checkbox" id="filter3" class="mr-2">
                        <label for="filter3">Lapangan</label>
                    </div>
                    <div class="flex items-center text-sm">
                        <input type="checkbox" id="filter4" class="mr-2">
                        <label for="filter4">Lapangan</label>
                    </div>
                    <div class="flex items-center text-sm">
                        <input type="checkbox" id="filter5" class="mr-2">
                        <label for="filter5">Lapangan</label>
                    </div>
                    <div class="flex items-center text-sm">
                        <input type="checkbox" id="filter6" class="mr-2">
                        <label for="filter6">Lapangan</label>
                    </div>
                    <div class="flex items-center text-sm">
                        <input type="checkbox" id="filter7" class="mr-2">
                        <label for="filter7">Lapangan</label>
                    </div>
                </div>
            </div>
            <div class="text-white font-inter">
                <h2 class="font-bold">Status</h2>
                <div class="flex gap-2 flex-wrap">
                    <div class="flex items-center text-sm">
                        <input type="checkbox" id="filter8" class="mr-2">
                        <label for="filter8">Diverivikasi</label>
                    </div>
                    <div class="flex items-center text-sm">
                        <input type="checkbox" id="filter9" class="mr-2">
                        <label for="filter9">Diperbaiki</label>
                    </div>
                    <div class="flex items-center text-sm">
                        <input type="checkbox" id="filter10" class="mr-2">
                        <label for="filter10">Selesai</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex item-center justify-center">
            <button type="submit" class="bg-green-400 px-3 py-1 rounded-[12px] font-inter font-bold text-white mt-4 hover:bg-green-500">Konfirmasi</button>
        </div>
    </form>
</section>

<section id="my-complaint-modal" class="hidden w-full px-[5%] lg:px-[10%] md:px-[10%] mb-20">
@if ($complaints->isNotEmpty())
    <h2 class="text-center font-inter font-bold text-customblue mt-8 my-4">Menampilkan {{ $complaints->count() }} dari {{ $complaints->total() }} Aduan</h2>
    <div class="container-card flex flex-col gap-4">
        @foreach ($complaints as $complaint)
        <a href="aduanku/{{$complaint->id}}" class="w-full bg-customgray2 flex rounded-[16px] overflow-hidden bg-opacity-80 hover:bg-opacity-100 flex-col lg:flex-row md:flex-row relative">
            <div class="img w-full max-h-[200px] md:w-1/3 md:h-auto flex justify-center items-center overflow-hidden">
            @php
                $firstAttachment = $complaint->attachments->first(); // Ambil attachment pertama, atau null jika kosong
            @endphp

            @if($firstAttachment)
                <img class="object-cover w-full h-full bg-red-500" 
                    src="{{$firstAttachment->file_type == 'pdf' ? 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSXHQMBA2g77jAGv-GHfYOMYae4yuAwYcsAzg&s' : $firstAttachment->path_file}}" 
                    alt="gambar">
            @else
                <p>No attachments available</p>
            @endif
            </div>
            <div class="w-full md:w-2/3 p-5 flex flex-col justify-between gap-2 md:gap-0">
                <div class="flex flex-col">
                    <div class="flex justify-between md:gap-0 gap-2">
                        <p class="font-inter font-bold text-customblue md:text-lg">{{$complaint->id}}</p>
                        <p class="font-inter font-bold text-white bg-green-500 py-[1%] px-[3%] md:py-1 md:px-3 rounded-sm md:text-sm text-[12px] w-fit absolute right-0 top-0 md:relative md:rounded-none rounded-bl-[12px]">{{$complaint->supports->count()}} Dukungan</p>
                    </div>
                    <p class="font-inter font-medium text-[14px] text-customblue opacity-70">{{$complaint->location_id}} - {{ \Carbon\Carbon::parse($complaint->created_at)->translatedFormat('d F Y') }}</p>
                </div>
                <p class="font-inter font-medium text-customblue opacity-70">{{ \Str::limit($complaint->description, 100)}}</p>
                <div class="flex justify-between items-center">
                    <p class="font-inter font-bold text-white bg-green-500 py-1 px-3 rounded-sm text-md">  {{ $complaint->logs()->latest()->first()->name ?? 'belum ada logs' }}</p>
                </div>
            </div>
        </a>
        @endforeach

        <div class="flex justify-center mt-4 items-center w-full">
            <!-- Custom Styling Pagination -->
            {{ $complaints->links('vendor.pagination.custom-pagination') }}
        </div>



        <!-- <a href="#" class="w-full bg-customgray2 flex rounded-[16px] overflow-hidden bg-opacity-80 hover:bg-opacity-100 flex-col lg:flex-row md:flex-row relative">
            <div class="img w-full h-[150px] md:w-1/3 md:h-auto flex justify-center items-center overflow-hidden">
                <img class="object-cover w-full h-full" src="https://i.pinimg.com/736x/ea/7a/30/ea7a300c2990158aea798402e5739c81.jpg" alt="gambar">
            </div>
            <div class="w-full md:w-2/3 p-5 flex flex-col justify-between gap-2 md:gap-0">
                <div class="flex flex-col">
                    <div class="flex justify-between md:gap-0 gap-2">
                        <p class="font-inter font-bold text-customblue md:text-lg">XAGSHAJSKAHSKS</p>
                        <p class="font-inter font-bold text-white bg-green-500 py-[1%] px-[3%] md:py-1 md:px-3 rounded-sm md:text-sm text-[12px] w-fit absolute right-0 top-0 md:relative md:rounded-none rounded-bl-[12px]">50 Orang Mendukung</p>
                    </div>
                    <p class="font-inter font-medium text-[14px] text-customblue opacity-70">Toilet - 1 Januari 2025</p>
                </div>
                <p class="font-inter font-medium text-customblue opacity-70">bolak balik bolak balik Jepara pak, Jepara pak bupati, yg terhormat bapak Bupati, saluran air di bolak balik bolak balik Jepara pak, Jepara pak bupati, yg terhormat bapak Bupati, saluran air di.....</p>
                <div class="flex justify-between items-center">
                    <p class="font-inter font-bold text-white bg-green-500 py-1 px-3 rounded-sm text-md">Verifikasi</p>
                </div>
            </div>
        </a> -->
    </div>
    @else
    @include('/layouts/components/empty-complaint')
    @endif
</section>

<section id="supported-complaint-modal" class="hidden w-full px-[5%] lg:px-[10%] md:px-[10%] mb-20">
@if ($supported_complaints->isNotEmpty())
    <h2 class="text-center font-inter font-bold text-customblue mt-8 my-4">Menampilkan {{ $supported_complaints->count() }} dari {{ $supported_complaints->total() }} Aduan</h2>
    <div class="container-card flex flex-col gap-4">
        @foreach ($supported_complaints as $complaint)
        <a href="aduanku/{{$complaint->id}}" class="w-full bg-customgray2 flex rounded-[16px] overflow-hidden bg-opacity-80 hover:bg-opacity-100 flex-col lg:flex-row md:flex-row relative">
            <div class="img w-full max-h-[200px] md:w-1/3 md:h-auto flex justify-center items-center overflow-hidden">
            @php
                $firstAttachment = $complaint->attachments->first(); 
            @endphp

            @if($firstAttachment)
                <img class="object-cover w-full h-full bg-red-500" 
                    src="{{$firstAttachment->file_type == 'pdf' ? 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSXHQMBA2g77jAGv-GHfYOMYae4yuAwYcsAzg&s' : $firstAttachment->path_file}}" 
                    alt="gambar">
            @else
                <p>No attachments available</p>
            @endif
            </div>
            <div class="w-full md:w-2/3 p-5 flex flex-col justify-between gap-2 md:gap-0">
                <div class="flex flex-col">
                    <div class="flex justify-between md:gap-0 gap-2">
                        <p class="font-inter font-bold text-customblue md:text-lg">{{$complaint->id}}</p>
                        <p class="font-inter font-bold text-white bg-green-500 py-[1%] px-[3%] md:py-1 md:px-3 rounded-sm md:text-sm text-[12px] w-fit absolute right-0 top-0 md:relative md:rounded-none rounded-bl-[12px]">{{$complaint->supports->count()}} Dukungan</p>
                    </div>
                    <p class="font-inter font-medium text-[14px] text-customblue opacity-70">{{$complaint->location_id}} - {{ \Carbon\Carbon::parse($complaint->created_at)->translatedFormat('d F Y') }}</p>
                </div>
                <p class="font-inter font-medium text-customblue opacity-70">{{ \Str::limit($complaint->description, 100)}}</p>
                <div class="flex justify-between items-center">
                    <p class="font-inter font-bold text-white bg-green-500 py-1 px-3 rounded-sm text-md">  {{ $complaint->logs()->latest()->first()->name ?? 'belum ada logs' }}</p>
                </div>
            </div>
        </a>
        @endforeach

        <div class="flex justify-center mt-4 items-center w-full">
            <!-- Custom Styling Pagination -->
            {{ $supported_complaints->links('vendor.pagination.custom-pagination') }}
        </div>



        <!-- <a href="#" class="w-full bg-customgray2 flex rounded-[16px] overflow-hidden bg-opacity-80 hover:bg-opacity-100 flex-col lg:flex-row md:flex-row relative">
            <div class="img w-full h-[150px] md:w-1/3 md:h-auto flex justify-center items-center overflow-hidden">
                <img class="object-cover w-full h-full" src="https://i.pinimg.com/736x/ea/7a/30/ea7a300c2990158aea798402e5739c81.jpg" alt="gambar">
            </div>
            <div class="w-full md:w-2/3 p-5 flex flex-col justify-between gap-2 md:gap-0">
                <div class="flex flex-col">
                    <div class="flex justify-between md:gap-0 gap-2">
                        <p class="font-inter font-bold text-customblue md:text-lg">XAGSHAJSKAHSKS</p>
                        <p class="font-inter font-bold text-white bg-green-500 py-[1%] px-[3%] md:py-1 md:px-3 rounded-sm md:text-sm text-[12px] w-fit absolute right-0 top-0 md:relative md:rounded-none rounded-bl-[12px]">50 Orang Mendukung</p>
                    </div>
                    <p class="font-inter font-medium text-[14px] text-customblue opacity-70">Toilet - 1 Januari 2025</p>
                </div>
                <p class="font-inter font-medium text-customblue opacity-70">bolak balik bolak balik Jepara pak, Jepara pak bupati, yg terhormat bapak Bupati, saluran air di bolak balik bolak balik Jepara pak, Jepara pak bupati, yg terhormat bapak Bupati, saluran air di.....</p>
                <div class="flex justify-between items-center">
                    <p class="font-inter font-bold text-white bg-green-500 py-1 px-3 rounded-sm text-md">Verifikasi</p>
                </div>
            </div>
        </a> -->
    </div>
    @else
    @include('/layouts/components/empty-complaint')
    @endif
</section>


@include('/layouts/components/footer')
@endif

@extends('layouts/end_html')
<script>
    function toggleFilter() {
        const filterSection = document.getElementById('filter-section');
        const filterButton = document.getElementById('btn-filters');
        filterSection.classList.toggle('hidden');
        if (!filterSection.classList.contains('hidden')) {
            filterSection.classList.remove('opacity-0');
            filterSection.classList.add('opacity-100');
        } else {
            filterSection.classList.remove('opacity-100');
            filterSection.classList.add('opacity-0');
        }

        if (filterSection.classList.contains('hidden')) {
            filterButton.classList.remove('bg-customblue', 'text-white');
            filterButton.classList.add('text-customblue', 'bg-customgray');
        } else {
            filterButton.classList.add('bg-customblue', 'text-white');
            filterButton.classList.remove('text-customblue', 'bg-customgray');
        }
    }

    window.addEventListener('click', function(event) {
        const filterSection = document.getElementById('filter-section');
        const filterButton = document.getElementById('btn-filters');

        if (!filterSection.contains(event.target) && !filterButton.contains(event.target)) {
            filterSection.classList.add('hidden');
            filterButton.classList.remove('bg-customblue', 'text-white');
            filterButton.classList.add('text-customblue', 'bg-customgray');
        }
    });


    // Fungsi untuk menampilkan "Aduan Saya" modal dan sembunyikan "Aduan Didukung"
    function showMyComplaint() {
        document.getElementById('my-complaint-modal').classList.remove('hidden');
        document.getElementById('supported-complaint-modal').classList.add('hidden');
        document.getElementById('btn-my-complaint').classList.add('bg-customblue', 'text-white');
        document.getElementById('btn-my-complaint').classList.remove('bg-customgray', 'text-customblue');
        document.getElementById('btn-supported-complaint').classList.add('bg-customgray', 'text-customblue');
        document.getElementById('btn-supported-complaint').classList.remove('bg-customblue', 'text-white');
    }

    // Fungsi untuk menampilkan "Aduan Didukung" modal dan sembunyikan "Aduan Saya"
    function showSupportedComplaint() {
        document.getElementById('supported-complaint-modal').classList.remove('hidden');
        document.getElementById('my-complaint-modal').classList.add('hidden');
        document.getElementById('btn-supported-complaint').classList.add('bg-customblue', 'text-white');
        document.getElementById('btn-supported-complaint').classList.remove('bg-customgray', 'text-customblue');
        document.getElementById('btn-my-complaint').classList.add('bg-customgray', 'text-customblue');
        document.getElementById('btn-my-complaint').classList.remove('bg-customblue', 'text-white');
    }

    // Pastikan "Aduan Saya" modal muncul saat halaman dimuat
    window.onload = function() {
        showMyComplaint(); // Secara otomatis menampilkan modal "Aduan Saya"
    }
</script>